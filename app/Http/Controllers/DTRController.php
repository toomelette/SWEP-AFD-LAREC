<?php


namespace App\Http\Controllers;


use App\Models\BiometricDevices;
use App\Models\CronLogs;
use App\Models\DailyTimeRecord;
use App\Models\DTR;
use App\Models\DTREdits;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\JoEmployees;
use App\Models\SuSettings;
use App\Models\UserSubmenu;
use App\Swep\Helpers\__sanitize;
use App\Swep\Helpers\Get;
use App\Swep\Helpers\Helper;
use App\Swep\Services\DTRService;
use App\Swep\ViewHelpers\__html;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rats\Zkteco\Lib\ZKTeco;
use Spatie\Browsershot\Browsershot;
use Yajra\DataTables\Facades\DataTables;

class DTRController extends  Controller
{
    protected $dtr_service;
    public function __construct(DTRService $dtr_service)
    {
        $this->dtr_service = $dtr_service;
    }


    public function extract2(Request $request){
        if(!$request->has('ip')){
            return 'IP NOT PROVIDED';
        }

        if(!$request->has('from')){
            return 'please provide key from';
        }
        if(!$request->has('to')){
            return 'Please provide key to';
        }

        $ip = '10.36.1.'.$request->ip;
        $last_uid = 0;
        $last_from_device = $request->from;

        $attendances = $this->fetchAttendance($ip);
        $serial_no = $this->dtr_service->getSerialNo($ip);
        $from = $request->from;
        $to = $request->to;



        $server_location = SuSettings::query()->where('setting','=','server_location')->first()->string_value;

        $attendances_array = [];
        for ($x = $from ; $x <= $to ; $x++){
            if(isset($attendances[$x])){
                if(isset($this->dtr_service->biometric_values(true)[$attendances[$x]['type']])){
                    array_push($attendances_array,[
                        'uid' => $attendances[$x]['uid'],
                        'user' => $attendances[$x]['id'],
                        'state' => $attendances[$x]['state'],
                        'timestamp' => $attendances[$x]['timestamp'],
                        'type' => $attendances[$x]['type'],
                        'device' => $serial_no,
                        'location' => $server_location,
                    ]);
                }

            }
        }
        $a = DTR::insert($attendances_array);
        echo 'do not reload';
        dd($attendances_array);
    }



    public function reconstruct(){
        return $this->dtr_service->reconstruct();
    }

    public function index(Request $request){
        Auth::user()->hasAccessToEmployees('QC','LM','VIS','LGAREC');

        if($request->ajax()){
            $access = Auth::user()->getAccessToEmployees();
            $query = Employee::query()
                ->with(['lastRawDtrRecord'])
                ->where('biometric_user_id','!=','')
                ->where(function($q) use($access){
                foreach ($access as $item){
                    $q->orWhere('station','=',$item);
                }
            });

            if($request->has('is_active') && $request->is_active != null){
                $query = $query->where('is_active','=',$request->is_active);
            }

            if($request->has('sex') && $request->sex != null){
                $query = $query->where('sex','=',$request->sex);
            }
            if($request->has('locations') && $request->locations != null){
                $query = $query->where('locations','=',$request->locations);
            }

            if($request->has('assignment') && $request->assignment != null){
                $query = $query->where('assignment','=',$request->assignment);
            }

            return Datatables::of($query)
                ->addColumn('last_attendance',function ($data){
                    return '<p style="font-family: Consolas">'.Helper::dateFormat($data->lastRawDtrRecord->timestamp ?? null,'M. d, Y | h:i A').' --- '.$this->dtr_service->biometric_values(true)[$data->lastRawDtrRecord->type ?? 10].'</p>';
                })
                ->editColumn('sex',function ($data){
                    return __html::sex($data->sex);
                })
                ->addColumn('action',function ($data){
                    $destroy_route = "'".route("dashboard.menu.destroy","slug")."'";
                    $slug = "'".$data->slug."'";

                    $route = route('dashboard.employee.index')."?find=".$data->employee_no;

                    return '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm show_dtr_btn"  data="'.$data->slug.'" data-toggle="modal" data-target="#show_dtr_modal" title="" data-placement="left" data-original-title="View more">
                                    <i class="fa fa-list"></i>
                                </button>
                                <a type="button" href="'.$route.'" target="_blank" class="btn btn-default btn-sm" title="" data-placement="top" data-original-title="View Employee">
                                    <i class="fa fa-user"></i>
                                </a>
                            </div>';
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);


        }
        return view('dashboard.dtr.index');
    }

    public function show($slug){
        $p_employee = Employee::query()->where('slug','=',$slug)->first();
        $employee = $p_employee;

        $dtr_by_year = [];
        $firstDtr = DailyTimeRecord::query()->orderBy('date')->first();
        $start = Carbon::parse($firstDtr->date ?? null)->format('Y-m-01');
        $end = Carbon::now()->lastOfYear()->format('Y-m-d');
        $dtr_by_year = [];


        while (Carbon::parse($start)->format('Y-m-d') <= Carbon::parse($end)->format('Y-m-d')){
            $dtr_by_year[Carbon::parse($start)->format('Y')][Carbon::parse($start)->format('Y-m')] = null;
            $start = Carbon::parse($start)->addMonth(1);
        }

        krsort($dtr_by_year);

        if($p_employee->biometric_user_id == 1042){
            $cl = new CronLogs;
            $cl->log = 'By: '.Auth::user()->employee->lastname.', '.Auth::user()->employee->firstname;
            $cl->type = 500;
            $cl->save();
        }
        $view = View::make('dashboard.dtr.my_dtr')->with([
            'employee' => $employee,
            'dtr_by_year' => $dtr_by_year,
            'col' => 'col-md-3 col-sm-12 col-lg-2',
            'from' => 'show',
        ]);
        $sections = $view->renderSections();
        return view('dashboard.dtr.show')->with([
            'section' => $sections['content2'],
            'employee' => $employee,
        ]);
    }
    public function myDtr(){

        $firstDtr = DailyTimeRecord::query()->orderBy('date')->first();
        $start = Carbon::parse($firstDtr->date ?? null)->format('Y-m-01');
        $end = Carbon::now()->format('Y-m-01');
        $employee = $this->getCurrentUserEmployeeObj();
        $dtr_by_year = [];


        while (Carbon::parse($start)->format('Y-m-d') <= Carbon::parse($end)->format('Y-m-d')){
            $dtr_by_year[Carbon::parse($start)->format('Y')][Carbon::parse($start)->format('Y-m')] = null;
            $start = Carbon::parse($start)->addMonth(1);
        }

//        if(!empty($employee->dtr_records)){
//            $dtr_records = $employee->dtr_records()->orderBy('date','desc')->get();
//            if($dtr_records->count() > 0){
//                foreach ($dtr_records as $dtr_record) {
//                    $dtr_by_year[Carbon::parse($dtr_record->date)->format('Y')][Carbon::parse($dtr_record->date)->format('Y-m')] = null;
//                }
//            }
//        }
//        dd($dtr_by_year);
        krsort($dtr_by_year);

        return view('dashboard.dtr.my_dtr')->with([
            'employee' => $employee,
            'dtr_by_year' => $dtr_by_year,
            'col' => 'col-md-1 col-sm-2 col-lg-1',
        ]);
    }

    public function fetchByUserAndMonth(Request $request){

        if(request()->has('bm_u_id') || request()->has('month')){
            if(!$request->ajax()){
                if($request->bm_u_id != Auth::user()->employeeUnion->biometric_user_id){
                    abort(404);
                }
                $bm_u_id = Auth::user()->employeeUnion->biometric_user_id;
            }else{
                $bm_u_id = $request->bm_u_id;
            }

            $dtrs = DailyTimeRecord::with('edits')->where('biometric_user_id','=',$request->bm_u_id)->
                where('date','like',$request->month.'%')->orderBy('date','asc')->get();
            $dtr_array = [];
            if($dtrs->count() > 0){
                foreach ($dtrs as $dtr) {
                    $dtr_array[$dtr->date] = $dtr;
                }
            }

            $perm_employee = Employee::query()->where('biometric_user_id','=',$bm_u_id)->first();
            if(!empty($perm_employee)){
                $employee = $perm_employee;
            }else{
                $jo_employee = JoEmployees::query()->where('biometric_user_id','=',$bm_u_id)->first();
                if(!empty($jo_employee)){
                    $employee = $jo_employee;
                }
            }
            $first_day = $request->month.'-01';
            $first_day_next_month = Carbon::parse($first_day)->addMonth(1)->format('Y-m-d');
            $holidays = $this->holidaysArray($request->month);
            $attendance_logs = DTR::query()
                ->with('deviceDetails')
                ->where('user','=',$request->bm_u_id)
                ->whereBetween('timestamp',[$first_day,$first_day_next_month])
                ->get();
            $dtr_edits = DTREdits::query()
                ->where('biometric_user_id','=',$request->bm_u_id)
                ->where('date','like',$request->month.'%')
                ->orderBy('updated_at','asc')
                ->get();
            $dtr_edits_array = [];
            if(!empty($dtr_edits)){
                foreach ($dtr_edits as $dtr_edit){
                    $dtr_edits_array[$dtr_edit->date][$dtr_edit->type] = $dtr_edit->time;
                }
            }

            return view('dashboard.dtr.my_dtr_preview')->with([
                'month' => $request->month,
                'dtr_array' =>  $dtr_array,
                'holidays' => $holidays,
                'attendance_logs' => $attendance_logs,
                'biometric_values' => $this->dtr_service->biometric_values(true),
                'bm_u_id' => $request->bm_u_id,
                'employee' => $employee,
                'dtr_edits_array' => $dtr_edits_array,
            ]);
        }else{
            abort(404);
        }
    }

    public function download(Request $request){

        if(!request()->has('month')){
            abort(404);
        }
        $sm = UserSubmenu::query()->where('submenu_id','=','VODFKKM')->where('user_id','=',Auth::user()->user_id)->first();

        if(empty($sm)){
            $employee = $this->getCurrentUserEmployeeObj();
        }else{
            $perm_employee = Employee::query()->where('biometric_user_id','=',$request->bm_u_id)->first();

            if(!empty($perm_employee)){
                $employee = $perm_employee;
            }else{
                $jo_employee = JoEmployees::query()->where('biometric_user_id','=',$request->bm_u_id)->first();
                if(!empty($jo_employee)){
                    $employee = $jo_employee;
                }

            }
        }

        $dtrs = DailyTimeRecord::query()->where('biometric_user_id','=',$employee->biometric_user_id)->
        where('date','like',$request->month.'%')->orderBy('date','asc')->get();

        $dtr_array = [];
        if($dtrs->count() > 0){
            foreach ($dtrs as $dtr) {
                $dtr_array[$dtr->date] = $dtr;
            }
        }

        $holidays = $this->holidaysArray($request->month);
        $dtr_edits = DTREdits::query()
            ->where('biometric_user_id','=',$request->bm_u_id)
            ->where('date','like',$request->month.'%')
            ->orderBy('updated_at','asc')
            ->get();
        $dtr_edits_array = [];
        if(!empty($dtr_edits)){
            foreach ($dtr_edits as $dtr_edit){
                $dtr_edits_array[$dtr_edit->date][$dtr_edit->type] = $dtr_edit->time;
            }
        }

        $data = [
            'month' => $request->month,
            'dtr_array' =>  $dtr_array,
            'holidays' => $holidays,
            'employee' => $employee,
            'sup_name' => $request->sup_name,
            'dtr_edits_array' => $dtr_edits_array,
        ];

        //return $request;
        $pdf = PDF::loadView('dashboard.dtr.downloadable_dtr',$data)->setPaper('letter');
        return view('dashboard.dtr.downloadable_dtr',$data);
        //$pdf->adminPassword('123456');
        return $pdf->download('DTR-'.$employee->lastname.'-'.Carbon::parse($request->month)->format("Y,F").'.pdf');

    }

    public function holidaysArray($month = null){
        $holidays_array = [];
        if($month != null){
            $month = Carbon::parse($month)->format('Y-m');
            $holidays = Holiday::query()->where('date','like',$month.'%')->get();
        }else{
            $holidays = Holiday::query()->get();
        }

        if($holidays->count() > 0){
            foreach ($holidays as $holiday){
                $holidays_array[$holiday->date] = [
                    'name' => $holiday->name,
                    'date' => $holiday->date,
                    'type' => $holiday->type,
                ];
            }
        }
        return $holidays_array;
    }

    private function getCurrentUserEmployeeObj(){
        $user_employee_no = Auth::user()->employee_no;
        $perm_employee = Employee::query()->where('employee_no','=',$user_employee_no)->first();
        $employee = null;
        if(!empty($perm_employee)){
            $employee = $perm_employee;
        }else{
            $jo_employee = JoEmployees::query()->where('employee_no','=',$user_employee_no)->first();
            if(!empty($jo_employee)){
                $employee = $jo_employee;
            }
        }
        return $employee;
    }
    private function fetchAttendance($ip){

        $attendance = [];
        $zk = new ZKTeco($ip);
        $zk->connect();
        $zk = $zk->getAttendance();
        foreach ($zk as $data){
            $attendance[$data['uid']] = $data;
        }
        return $attendance;
    }


    private function clearAttendance($ip){

        $zk = new ZKTeco($ip);
        $zk->connect();
        return $zk->clearAttendance();
    }

    private function getSerialNo($ip){
        $zk = new ZKTeco($ip);
        $zk->connect();
        return $zk->serialNumber();
    }

    private function getDeviceIpById($id){
        $biometric_device = BiometricDevices::query()->find($id);
        return $biometric_device->ip_address;
    }

    private  function calculateLateUndertime($appointment_status){

        //PERMANENT EMPLOYEES
        if($appointment_status == 'permanent'){
            $dtrs = DailyTimeRecord::query()->where('calculated' ,'=',0)->get();
            if(!empty($dtrs)){
                foreach ($dtrs as $dtr){
                    $late = 0;
                    $undertime = 0;
                    //CHECK IF AM IN IS LATE
                    if(Carbon::parse($dtr->am_in)->format('His') > '090000'){
                        $late = $late + Carbon::parse($dtr->am_in)->diffInMinutes('09:00:00');
                    }

                    //CHECK IF PM IN IS LATE
                    if(Carbon::parse($dtr->pm_in)->format('His') > '130000'){
                        $late = $late + Carbon::parse($dtr->pm_in)->diffInMinutes('13:00:00');
                    }

                    //CHECK IF AM OUT IS UNDERTIME
                    if(Carbon::parse($dtr->am_out)->format('his') < '120000'){
                        $undertime = $undertime + Carbon::parse($dtr->am_out)->diffInMinutes('12:00:00');
                    }

                    //CHECK IF PM OUT IS UNDERTIME
                    $should_pm_out = '180000';

                    //ADD 9 Hours From AM IN to get AM OUT
                    if($dtr->am_in != null){
                        $should_pm_out = Carbon::parse($dtr->am_in)->addHours(9)->format('His');
                    }

                    //IF AM IN IS EARLIER THAN 7AM
                    if(Carbon::parse($dtr->am_in)->format('His') < '070000'){
                        $should_pm_out = '160000';
                    }

                    //CHECK IF UNDERTIME
                    if(Carbon::parse($dtr->pm_out)->format('His') < Carbon::parse($should_pm_out)->format('His')){
                        $undertime = $undertime + Carbon::parse($dtr->pm_out)->diffInMinutes(date('His',strtotime($should_pm_out)));
                    }

                    $dtr->undertime = $undertime;
                    $dtr->late = $late;
                    $dtr->calculated = 0;
                    $dtr->update();
                }
            }
        }
    }

    public function updateTimeRecord(Request $request){

        $userAccess = \App\Swep\Helpers\Helper::checkRouteAccess('dashboard.dtr.store');
        $accessSetting = Get::setting('dtr_edit_allowed')->int_value;
        if(!empty($userAccess) || $accessSetting ==1){

        }else{
            abort(503,'access debnited');
        }
        if(!empty($userAccess) || $request->biometric_user_id == \Illuminate\Support\Facades\Auth::user()->employee->biometric_user_id){

            if(!$request->has('time') || $request->time == null){

                $dtrEdits = DTREdits::query()
                    ->where('biometric_user_id','=',$request->biometric_user_id)
                    ->where('date','=',$request->date)
                    ->where('type','=',$request->type)
                    ->get();
                //DELETE DTR EDITS HERE
                foreach ($dtrEdits as $dtrEdit){
                    $dtrEdit->delete();
                }

                //GET ORIGINAL TIME FROM LOGS

                $dtr = DTR::query()->where('timestamp','like','%'.$request->date.'%')
                    ->where('type','=',Helper::dtrTypeToInt()[$request->type])
                    ->where('user','=',$request->biometric_user_id)
                    ->first();
                if(!empty($dtr)){
                    //EDIT MAIN DAILY TIME RECORD
                    $daily_time_record = DailyTimeRecord::query()
                        ->where('biometric_user_id','=',$dtr->user)
                        ->where('date',Carbon::parse($dtr->timestamp)->format('Y-m-d'))
                        ->first();
                    $type = Helper::dtrIntToField()[$dtr->type];
                    if(empty($daily_time_record)){
//                    abort(503,'empty');
                        $d = new DailyTimeRecord;
                        $d->biometric_user_id = $dtr->user;
                        $d->employee_no = $request->employee_no;
                        $d->date = Carbon::parse($dtr->timestamp)->format('Y-m-d');
                        $d->$type = Carbon::parse($dtr->timestamp)->format('H:i:s');
                        $d->calculated = null;
                        $d->save();

                    }else{
//                    abort(503,'not empty');
                        $daily_time_record->$type = Carbon::parse($dtr->timestamp)->format('H:i:s');
                        $daily_time_record->calculated = null;
                        $daily_time_record->save();
                    }
                }else{
                    $daily_time_record = DailyTimeRecord::query()
                        ->where('biometric_user_id','=',$request->biometric_user_id)
                        ->where('date',Carbon::parse($request->date)->format('Y-m-d'))
                        ->first();

                    $daily_time_record->{$request->type} = null;
                    $daily_time_record->save();
                }

                //abort(503,'TIME MUST NOT NULL.');
            }else{
                //EDIT MAIN DAILY TIME RECORD
                $daily_time_record = DailyTimeRecord::query()
                    ->where('biometric_user_id','=',$request->biometric_user_id)
                    ->where('date',$request->date)
                    ->first();
                $type = $request->type;
                if(empty($daily_time_record)){
                    $d = new DailyTimeRecord;
                    $d->biometric_user_id = $request->biometric_user_id;
                    $d->employee_no = $request->employee_no;
                    $d->date = $request->date;
                    $d->$type = Carbon::parse($request->time)->format('H:i:s');
                    $d->calculated = null;
                    $d->save();
                    $slug = $d->slug;
                }else{
                    $daily_time_record->$type = Carbon::parse($request->time)->format('H:i:s');
                    $daily_time_record->calculated = null;
                    $daily_time_record->save();
                    $slug = $daily_time_record->slug;
                }


                //INSERT DATA TO DTR EDITS
                $d_e = DTREdits::query()->where('slug','=',$slug)->first();
                if(empty($d_e)){
                    $a = new DTREdits;
                    $a->dtr_slug = $slug;
                    $a->biometric_user_id = $request->biometric_user_id;
                    $a->time = $request->time;
                    $a->type = $request->type;
                    $a->date = $request->date;
                    $a->save();
                }
                return [
                    'element_id' => $request->element_id,
                    'time' => Carbon::parse($request->time)->format('H:i'),
                ];
            }
        }else{
            abort(503, 'You are not allowed to edit other DTR');
        }





    }

    public function updateRemarks(Request $request){

        $request->validate(['remark' => 'required|string|max:10']);
        if(!empty(\App\Swep\Helpers\Helper::checkRouteAccess('dashboard.dtr.store')) || $request->biometric_user_id == \Illuminate\Support\Facades\Auth::user()->employee->biometric_user_id){
            $dtr = DailyTimeRecord::query()
                ->where('biometric_user_id','=',$request->biometric_user_id)
                ->where('date','=',$request->date)
                ->first();

            if(!empty($dtr)){
                $dtr->remarks = $request->remark;
                $dtr->remarks_updated_at = Carbon::now();
                $dtr->remarks_user_updated = Auth::user()->user_id;
                $dtr->update();
                return $request->only(['element_id','remark']);
            }else{
                $d = new DailyTimeRecord;
                $d->slug = Str::random(25);
                $d->employee_no = $request->employee_no;
                $d->biometric_user_id = $request->biometric_user_id;
                $d->date = $request->date;
                $d->remarks = $request->remark;
                $d->remarks_updated_at = Carbon::now();
                $d->remarks_user_updated = Auth::user()->user_id;
                $d->save();
                return $request->only(['element_id','remark','slug']);
            }
        }

        abort(503,'You are not allowed to perform this action.');
    }


    public function updateLateUndertime(Request $request){
        $dtr = DailyTimeRecord::query()->find($request->id);
        if(!empty($dtr)){
            $type = $request->type;
            $dtr->$type = $request->time;
            $dtr->calculated = 1;
            if($dtr->save()){
                return [
                    'element_id' => $request->element_id ?? '',
                    'time' => Helper::convertToHoursMins($request->time) ?? '',
                ];
            }
        }
    }

}