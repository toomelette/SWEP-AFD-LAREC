<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeInterface;

use App\Models\EmployeeAddress;
use App\Models\EmployeeChildren;
use App\Models\EmployeeEducationalBackground;
use App\Models\EmployeeEligibility;
use App\Models\EmployeeExperience;
use App\Models\EmployeeFamilyDetail;
use App\Models\EmployeeOrganization;
use App\Models\EmployeeOtherQuestion;
use App\Models\EmployeeRecognition;
use App\Models\EmployeeReference;
use App\Models\EmployeeSpecialSkill;
use App\Models\EmployeeVoluntaryWork;
use App\Models\EmployeeHealthDeclaration;
use App\Models\EmployeeMedicalHistory;
use App\Models\Employee;


class EmployeeRepository extends BaseRepository implements EmployeeInterface {
	



    protected $employee;

	public function __construct(Employee $employee){
        $this->employee = $employee;
        parent::__construct();
    }


    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;
        $employee = $this->employee->newQuery();

        if(isset($request->q)){
            $this->search($employee, $request->q);
        }

        if(isset($request->d)){
            $employee->whereDepartmentId($request->d);
        }

        if(isset($request->a)){
            $employee->whereIsActive($request->a);
        }

        return $this->populate($employee, $entries);
//        $employees = $this->cache->remember('employees:fetch:' . $key, 240, function() use ($request, $entries){
//
//            $employee = $this->employee->newQuery();
//
//            if(isset($request->q)){
//                $this->search($employee, $request->q);
//            }
//
//            if(isset($request->d)){
//                $employee->whereDepartmentId($request->d);
//            }
//
//            if(isset($request->a)){
//                $employee->whereIsActive($request->a);
//            }
//
//            return $this->populate($employee, $entries);
//
//        });

        return $employees;
        
    }






    public function store($request){

        $employee = new Employee;
        $employee->slug = $this->str->random(16);
        $employee->project_id = $request->project_id;
        $employee->department_id = $request->department_id;
        $employee->department_unit_id = $request->department_unit_id;
        $employee->employee_no = $request->employee_no;
        $employee->lastname = $request->lastname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->name_ext = $request->name_ext;
        $employee->fullname = $this->getRequestFullname($request);
        $employee->date_of_birth = $this->__dataType->date_parse($request->date_of_birth);
        $employee->place_of_birth = $request->place_of_birth;
        $employee->sex = $request->sex;
        $employee->civil_status = $request->civil_status;
        $employee->height = $request->height;
        $employee->weight = $request->weight;
        $employee->blood_type = $request->blood_type;
        $employee->citizenship = $request->citizenship;
        $employee->citizenship_type = $request->citizenship_type;
        $employee->dual_citizenship_country = $request->dual_citizenship_country;
        $employee->tel_no = $request->tel_no;
        $employee->cell_no = $request->cell_no;
        $employee->email = $request->email;
        $employee->agency_no = $request->agency_no;
        $employee->gov_id = $request->gov_id;
        $employee->license_passport_no = $request->license_passport_no;
        $employee->id_date_issue = $request->id_date_issue;
        $employee->gsis = $request->gsis;
        $employee->philhealth = $request->philhealth;
        $employee->sss = $request->sss;
        $employee->tin = $request->tin;
        $employee->hdmf = $request->hdmf;
        $employee->hdmfpremiums = $this->__dataType->string_to_num($request->hdmfpremiums);
        $employee->appointment_status = $request->appointment_status;
        $employee->position = $request->position;
        $employee->item_no = $request->item_no;
        $employee->salary_grade = $request->salary_grade;
        $employee->step_inc = $request->step_inc;
        $employee->monthly_basic = $this->__dataType->string_to_num($request->monthly_basic);
        $employee->aca = $this->__dataType->string_to_num($request->aca);
        $employee->pera = $this->__dataType->string_to_num($request->pera);
        $employee->food_subsidy = $this->__dataType->string_to_num($request->food_subsidy);
        $employee->ra = $this->__dataType->string_to_num($request->ra);
        $employee->ta = $this->__dataType->string_to_num($request->ta);
        $employee->firstday_gov = $this->__dataType->date_parse($request->firstday_gov);
        $employee->firstday_sra = $this->__dataType->date_parse($request->firstday_sra);
        $employee->appointment_date = $this->__dataType->date_parse($request->appointment_date);
        $employee->adjustment_date = $this->__dataType->date_parse($request->adjustment_date);
        $employee->is_active = $request->is_active;
        $employee->created_at = $this->carbon->now();
        $employee->updated_at = $this->carbon->now();
        $employee->ip_created = request()->ip();
        $employee->ip_updated = request()->ip();
        $employee->user_created = $this->auth->user()->user_id;
        $employee->user_updated = $this->auth->user()->user_id;
        $employee->biometric_user_id = 0;
        $employee->locations = $request->locations;
        $employee->assignment = $request->assignment;
        $employee->assignment_details = $request->assignment_details;
        $employee->station = $request->station;
        $employee->save();

        return $employee;

    }






    public function update($request, $slug){

        $employee = $this->findBySlug($slug);
        $employee->project_id = $request->project_id;
        $employee->department_id = $request->department_id;
        $employee->department_unit_id = $request->department_unit_id;
        $employee->employee_no = $request->employee_no;
        $employee->lastname = $request->lastname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->name_ext = $request->name_ext;
        $employee->fullname = $this->getRequestFullname($request);
        $employee->date_of_birth = $this->__dataType->date_parse($request->date_of_birth);
        $employee->place_of_birth = $request->place_of_birth;
        $employee->sex = $request->sex;
        $employee->civil_status = $request->civil_status;
        $employee->height = $request->height;
        $employee->weight = $request->weight;
        $employee->blood_type = $request->blood_type;
        $employee->citizenship = $request->citizenship;
        $employee->citizenship_type = $request->citizenship_type;
        $employee->dual_citizenship_country = $request->dual_citizenship_country;
        $employee->tel_no = $request->tel_no;
        $employee->cell_no = $request->cell_no;
        $employee->email = $request->email;
        $employee->agency_no = $request->agency_no;
        $employee->gov_id = $request->gov_id;
        $employee->license_passport_no = $request->license_passport_no;
        $employee->id_date_issue = $request->id_date_issue;
        $employee->gsis = $request->gsis;
        $employee->philhealth = $request->philhealth;
        $employee->sss = $request->sss;
        $employee->tin = $request->tin;
        $employee->hdmf = $request->hdmf;
        $employee->hdmfpremiums = $this->__dataType->string_to_num($request->hdmfpremiums);
        $employee->appointment_status = $request->appointment_status;
        $employee->position = $request->position;
        $employee->item_no = $request->item_no;
        $employee->salary_grade = $request->salary_grade;
        $employee->step_inc = $request->step_inc;
        $employee->monthly_basic = $this->__dataType->string_to_num($request->monthly_basic);
        $employee->aca = $this->__dataType->string_to_num($request->aca);
        $employee->pera = $this->__dataType->string_to_num($request->pera);
        $employee->food_subsidy = $this->__dataType->string_to_num($request->food_subsidy);
        $employee->ra = $this->__dataType->string_to_num($request->ra);
        $employee->ta = $this->__dataType->string_to_num($request->ta);
        $employee->firstday_gov = $this->__dataType->date_parse($request->firstday_gov);
        $employee->firstday_sra = $this->__dataType->date_parse($request->firstday_sra);
        $employee->appointment_date = $this->__dataType->date_parse($request->appointment_date);
        $employee->adjustment_date = $this->__dataType->date_parse($request->adjustment_date);
        $employee->is_active = $request->is_active;
        $employee->updated_at = $this->carbon->now();
        $employee->ip_updated = request()->ip();
        $employee->user_updated = $this->auth->user()->user_id;
        $employee->locations = $request->locations;
        $employee->assignment = $request->assignment;
        $employee->assignment_details = $request->assignment_details;
        $employee->station = $request->station;
        $employee->save();

        $this->destroyDependencies($employee);

        return $employee; 

    }






    public function destroy($slug){

        $employee = $this->findBySlug($slug);
        $employee->delete();
        $employee->employeeServiceRecord()->delete();
        $employee->employeeTraining()->delete();
        
        $this->destroyDependencies($employee);

        return $employee;

    }






    public function findBySlug($slug){

        $employee =  $this->employee->where('slug', $slug)
                                  ->with('employeeAddress',
                                         'employeeFamilyDetail',
                                         'employeeOtherQuestion',
                                         'employeeTraining', 
                                         'employeeChildren', 
                                         'employeeEducationalBackground', 
                                         'employeeEligibility',
                                         'employeeExperience',
                                         'employeeOrganization',
                                         'employeeRecognition',
                                         'employeeReference',
                                         'employeeSpecialSkill',
                                         'employeeVoluntaryWork',
                                         'employeeServiceRecord',
                                         'employeeMatrix',
                                         'permissionSlip',
                                         'leaveCard')
                                    ->first();

        
        if(empty($employee)){
            abort(404);
        }

        return $employee;

    }






    public function findByUserId($user_id){

        $employee =  $this->employee->where('user_id', $user_id)->first();

        if(empty($employee)){
            abort(404);
        }

        return $employee;

    }






    public function findByEmployeeNo($employee_no){

        $employee = $this->employee->where('employee_no', $employee_no)->first();


        if(empty($employee)){
            abort(404);
        }

        return $employee;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('employee_no', 'LIKE', '%'. $key .'%')
                      ->orwhere('lastname', 'LIKE', '%'. $key .'%')
                      ->orwhere('firstname', 'LIKE', '%'. $key .'%')
                      ->orwhere('fullname', 'LIKE', '%'. $key .'%')
                      ->orwhere('employee_no', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model, $entries){

        return $model->select('employee_no', 'fullname', 'position', 'email' ,  'slug','biometric_user_id')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }





    public function getRequestFullname($request){

       return $request->lastname .', '.$request->firstname . " " . substr($request->middlename , 0, 1) . ". " ;

    }





    public function getAll(){
        return $this->employee->select('slug', 'employee_no', 'fullname', 'email')
            ->where('is_active', 'ACTIVE')
            ->orderBy('lastname', 'ASC')
            ->get();
        $employees = $this->cache->remember('employees:getAll', 240, function(){
            return $this->employee->select('slug', 'employee_no', 'fullname', 'email')
                                  ->where('is_active', 'ACTIVE')
                                  ->orderBy('lastname', 'ASC')
                                  ->get();
        });
        
        return $employees;

    }





    public function getBySlug($slug){

        $employee = $this->employee->where('slug', $slug)->get();

        return $employee;

    }






    public function getByIsActive($status){

        $employee = $this->employee->newQuery();

        return $employee->select('employee_no', 'fullname', 'position', 'department_id', 'department_unit_id', 'monthly_basic')
            ->where('is_active', $status)
            ->with('leaveCard', 'department')
            ->orderBy('lastname', 'ASC')
            ->get();

        $employees = $this->cache->remember('employees:getByIsActive:' . $status, 240, function() use ($status){

            $employee = $this->employee->newQuery();

            return $employee->select('employee_no', 'fullname', 'position', 'department_id', 'department_unit_id', 'monthly_basic')
                            ->where('is_active', $status)
                            ->with('leaveCard', 'department')
                            ->orderBy('lastname', 'ASC')
                            ->get();

        });

        return $employees;
        
    }






    public function getBySex($sex){
        return $this->employee->where('is_active', 'ACTIVE')
            ->where('sex', $sex)
            ->get();
        $employees = $this->cache->remember('employees:getBySex:' . $sex, 240, function() use ($sex){

            return $this->employee->where('is_active', 'ACTIVE')
                                  ->where('sex', $sex)
                                  ->get();

        });

        return $employees;
        
    }






    public function getByDepartmentId($dept){
        return $this->employee->where('is_active', 'ACTIVE')
            ->where('department_id', $dept)
            ->get();
        $employees = $this->cache->remember('employees:getByDepartmentId:' . $dept, 240, function() use ($dept){

            return $this->employee->where('is_active', 'ACTIVE')
                                  ->where('department_id', $dept)
                                  ->get();

        });

        return $employees;
        
    }


    public function getAllByResidentialAddressCity(){
        return $this->employee->where('is_active','ACTIVE')->get();
    }



    // Dependencies

    public function storeAddress($request, $employee){

        $employee_address = new EmployeeAddress;
        $employee_address->employee_no = $employee->employee_no;
        $employee_address->res_address_block = $request->res_address_block;
        $employee_address->res_address_street = $request->res_address_street;
        $employee_address->res_address_village = $request->res_address_village;
        $employee_address->res_address_barangay = $request->res_address_barangay;
        $employee_address->res_address_city = $request->res_address_city;
        $employee_address->res_address_province = $request->res_address_province;
        $employee_address->res_address_zipcode = $request->res_address_zipcode;
        $employee_address->perm_address_block = $request->perm_address_block;
        $employee_address->perm_address_street = $request->perm_address_street;
        $employee_address->perm_address_village = $request->perm_address_village;
        $employee_address->perm_address_barangay = $request->perm_address_barangay;
        $employee_address->perm_address_city = $request->perm_address_city;
        $employee_address->perm_address_province = $request->perm_address_province;
        $employee_address->perm_address_zipcode = $request->perm_address_zipcode;
        $employee_address->save();
        
    }






    public function storeChildren($data, $employee){

        $employee_children = new EmployeeChildren;
        $employee_children->employee_no = $employee->employee_no;
        $employee_children->fullname = $data['fullname'];
        $employee_children->date_of_birth = $this->__dataType->date_parse($data['date_of_birth']);
        $employee_children->save();
        
    }






    public function storeEducationalBackground($data, $employee){
        
        $employee_eb = new EmployeeEducationalBackground;
        $employee_eb->employee_no = $employee->employee_no;
        $employee_eb->level = $data['level'];
        $employee_eb->school_name = $data['school_name'];
        $employee_eb->course = $data['course'];
        $employee_eb->date_from = $data['date_from'];
        $employee_eb->date_to = $data['date_to'];
        $employee_eb->units = $data['units'];
        $employee_eb->graduate_year = $data['graduate_year'];
        $employee_eb->scholarship = $data['scholarship'];
        $employee_eb->save();

    }  






    public function storeEligibility($data, $employee){

        $employee_elig = new EmployeeEligibility;
        $employee_elig->employee_no = $employee->employee_no;
        $employee_elig->eligibility = $data['eligibility'];
        $employee_elig->level = $data['level'];
        $employee_elig->rating = $data['rating'];
        $employee_elig->exam_place = $data['exam_place'];
        $employee_elig->exam_date = $this->__dataType->date_parse($data['exam_date']);
        $employee_elig->license_no = $data['license_no'];
        $employee_elig->license_validity = $this->__dataType->date_parse($data['license_validity']);
        $employee_elig->save();

    }






    public function storeExperience($data, $employee){

        $employee_exp = new EmployeeExperience;
        $employee_exp->employee_no = $employee->employee_no;
        $employee_exp->date_from = $this->__dataType->date_parse($data['date_from']);
        $employee_exp->date_to = $this->__dataType->date_parse($data['date_to']);
        $employee_exp->position = $data['position'];
        $employee_exp->company = $data['company'];
        $employee_exp->salary = $this->__dataType->string_to_num($data['salary']);
        $employee_exp->salary_grade = $data['salary_grade'];
        $employee_exp->appointment_status = $data['appointment_status'];
        $employee_exp->is_gov_service =  $this->__dataType->string_to_boolean($data['is_gov_service']);
        $employee_exp->save();

    }






    public function storeFamilyDetails($request, $employee){

        $employee_family_details = new EmployeeFamilyDetail;
        $employee_family_details->employee_no = $employee->employee_no;
        $employee_family_details->spouse_lastname = $request->spouse_lastname;
        $employee_family_details->spouse_firstname = $request->spouse_firstname;
        $employee_family_details->spouse_middlename = $request->spouse_middlename;
        $employee_family_details->spouse_name_ext = $request->spouse_name_ext;
        $employee_family_details->spouse_occupation = $request->spouse_occupation;
        $employee_family_details->spouse_employer = $request->spouse_employer;
        $employee_family_details->spouse_business_address = $request->spouse_business_address;
        $employee_family_details->spouse_tel_no = $request->spouse_tel_no;
        $employee_family_details->father_lastname = $request->father_lastname;
        $employee_family_details->father_firstname = $request->father_firstname;
        $employee_family_details->father_middlename = $request->father_middlename;
        $employee_family_details->father_name_ext = $request->father_name_ext;
        $employee_family_details->mother_lastname = $request->mother_lastname;
        $employee_family_details->mother_firstname = $request->mother_firstname;
        $employee_family_details->mother_middlename = $request->mother_middlename;
        $employee_family_details->mother_name_ext = $request->mother_name_ext;
        $employee_family_details->save();
        
    }






    public function storeOrganization($data, $employee){

        $employee_org = new EmployeeOrganization;
        $employee_org->employee_no = $employee->employee_no;
        $employee_org->name = $data['name'];
        $employee_org->save();

    }






    public function storeQuestions($request, $employee){

        $employee_oq = new EmployeeOtherQuestion;
        $employee_oq->employee_no = $employee->employee_no;
        $employee_oq->q_34_a = $this->__dataType->string_to_boolean($request->q_34_a);
        $employee_oq->q_34_b = $this->__dataType->string_to_boolean($request->q_34_b);
        $employee_oq->q_34_b_yes_details = $request->q_34_b_yes_details;
        $employee_oq->q_35_a = $this->__dataType->string_to_boolean($request->q_35_a);
        $employee_oq->q_35_a_yes_details = $request->q_35_a_yes_details;
        $employee_oq->q_35_b = $this->__dataType->string_to_boolean($request->q_35_b);
        $employee_oq->q_35_b_yes_details_1 = $request->q_35_b_yes_details_1;
        $employee_oq->q_35_b_yes_details_2 = $request->q_35_b_yes_details_2;
        $employee_oq->q_36 = $this->__dataType->string_to_boolean($request->q_36);
        $employee_oq->q_36_yes_details = $request->q_36_yes_details;
        $employee_oq->q_37 = $this->__dataType->string_to_boolean($request->q_37);
        $employee_oq->q_37_yes_details = $request->q_37_yes_details;
        $employee_oq->q_38_a = $this->__dataType->string_to_boolean($request->q_38_a);
        $employee_oq->q_38_a_yes_details = $request->q_38_a_yes_details;
        $employee_oq->q_38_b = $this->__dataType->string_to_boolean($request->q_38_b);
        $employee_oq->q_38_b_yes_details = $request->q_38_b_yes_details;
        $employee_oq->q_39 = $this->__dataType->string_to_boolean($request->q_39);
        $employee_oq->q_39_yes_details = $request->q_39_yes_details;
        $employee_oq->q_40_a = $this->__dataType->string_to_boolean($request->q_40_a);
        $employee_oq->q_40_a_yes_details = $request->q_40_a_yes_details;
        $employee_oq->q_40_b = $this->__dataType->string_to_boolean($request->q_40_b);
        $employee_oq->q_40_b_yes_details = $request->q_40_b_yes_details;
        $employee_oq->q_40_c = $this->__dataType->string_to_boolean($request->q_40_c);
        $employee_oq->q_40_c_yes_details = $request->q_40_c_yes_details;
        $employee_oq->save();
        
    }






    public function storeRecognition($data, $employee){

        $employee_recog = new EmployeeRecognition;
        $employee_recog->employee_no = $employee->employee_no;
        $employee_recog->title = $data['title'];
        $employee_recog->save();

    }






    public function storeReference($data, $employee){

        $employee_reference = new EmployeeReference;
        $employee_reference->employee_no = $employee->employee_no;
        $employee_reference->fullname = $data['fullname'];
        $employee_reference->address = $data['address'];
        $employee_reference->tel_no = $data['tel_no'];
        $employee_reference->save();

    }






    public function storeSpecialSkill($data, $employee){

        $employee_ss = new EmployeeSpecialSkill;
        $employee_ss->employee_no = $employee->employee_no;
        $employee_ss->description = $data['description'];
        $employee_ss->save();

    }





    public function storeVoluntaryWork($data, $employee){

        $employee_vw = new EmployeeVoluntaryWork;
        $employee_vw->employee_no = $employee->employee_no;
        $employee_vw->name = $data['name'];
        $employee_vw->address = $data['address'];
        $employee_vw->date_from = $this->__dataType->date_parse($data['date_from']);
        $employee_vw->date_to = $this->__dataType->date_parse($data['date_to']);
        $employee_vw->hours = $data['hours'];
        $employee_vw->position = $data['position'];
        $employee_vw->save();

    }



    public function storeHealthDeclaration($request, $employee){

        $employee_hd = new EmployeeHealthDeclaration;
        $employee_hd->employee_no = $employee->employee_no;
        $employee_hd->family_doctor = $request->family_doctor;
        $employee_hd->contact_person = $request->contact_person;
        $employee_hd->contact_person_phone = $request->contact_person_phone;
        $employee_hd->cities_ecq = $request->cities_ecq;
        $employee_hd->been_sick = $request->been_sick;
        $employee_hd->been_sick_yes_details = $request->been_sick_yes_details;
        $employee_hd->fever_colds = $request->fever_colds;
        $employee_hd->fever_colds_yes_details = $request->fever_colds_yes_details;
        $employee_hd->smoking = $request->smoking;
        $employee_hd->smoking_yes_details = $request->smoking_yes_details;
        $employee_hd->drinking = $request->drinking;
        $employee_hd->drinking_yes_details = $request->drinking_yes_details;
        $employee_hd->taking_drugs = $request->taking_drugs;
        $employee_hd->taking_drugs_yes_details = $request->taking_drugs_yes_details;
        $employee_hd->taking_vitamins = $request->taking_vitamins;
        $employee_hd->taking_vitamins_yes_details = $request->taking_vitamins_yes_details;
        $employee_hd->eyeglasses = $request->eyeglasses;
        $employee_hd->eyeglasses_yes_details = $request->eyeglasses_yes_details;
        $employee_hd->exercise = $request->exercise;
        $employee_hd->exercise_yes_details = $request->exercise_yes_details;
        $employee_hd->being_treated = $request->being_treated;
        $employee_hd->being_treated_yes_details = $request->being_treated_yes_details;
        $employee_hd->chronic_injuries = $request->chronic_injuries;
        $employee_hd->chronic_injuries_yes_details = $request->chronic_injuries_yes_details;
        $employee_hd->save();
    }


    public function storeMedicalHistory($medical_history, $medication, $employee){

        $employee_mh = new EmployeeMedicalHistory;
        $employee_mh->employee_no = $employee->employee_no;
        $employee_mh->medical_history = $medical_history;
        $employee_mh->medication = $medication; 
        $employee_mh->save();
    }


    public function destroyDependencies($employee){

        $employee->employeeAddress()->delete();
        $employee->employeeFamilyDetail()->delete();
        $employee->employeeOtherQuestion()->delete();
        $employee->employeeChildren()->delete();
//        $employee->employeeEducationalBackground()->delete();
//        $employee->employeeEligibility()->delete();
//        $employee->employeeExperience()->delete();
        $employee->employeeOrganization()->delete();
        $employee->employeeRecognition()->delete();
        $employee->employeeReference()->delete();
        $employee->employeeSpecialSkill()->delete();
        $employee->employeeVoluntaryWork()->delete();
        $employee->employeeHealthDeclaration()->delete();
        $employee->employeeMedicalHistories()->delete();
    }







}