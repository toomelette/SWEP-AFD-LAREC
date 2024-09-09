@php($days_in_this_month = \Carbon\Carbon::parse($month)->daysInMonth)
<head>
    <style type="text/css">

        @font-face {
            font-family: 'HunDin';
            src: url({{ asset('fonts/print/HunDin.ttf') }}) format('truetype');
            font-weight: 400;
            font-style: normal;
        }


        @font-face {
            font-family: 'OS-Condenesed-Bold';
            src: url({{ asset('fonts/print/OpenSansCondensed-Bold.ttf') }}) format('truetype');
            font-weight: 400;
            font-style: normal;

        }

        @font-face {
            font-family: 'OS-Condenesed-Light';
            src: url({{ asset('fonts/print/OpenSansCondensed-Light.ttf') }}) format('truetype');
            font-style: normal;
        }

        .table-bordered,.table-bordered th,.table-bordered td {
            border: 1px solid grey;
            border-collapse: collapse;
        }
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }

        .text-left{
            text-align: left;
        }
        table td{
            font-family: "HunDin";
            padding: 4px 2px;

            font-size: 12px;
            font-weight: bold;
        }

        thead{
            font-family: "Helvetica";
        }
        p{
            font-size: 16px;
            font-family: "Helvetica";
        }
        .small-margin{
            margin: 5px 0;
        }
        .incomplete{
            color : #1e5ab3;
        }

        @page {
            size: A4 portrait;
            margin: 2%;
        }
         {{--.dtr-table tr  td:nth-child(2),td:nth-child(3),td:nth-child(4),td:nth-child(5),td:nth-child(6),td:nth-child(7) { background: url("{{asset('images/wm.png')}}");}--}}
        .text-blue{
             color: blue;
         }
        .text-red{
            color: red;
        }
    </style>

    <script type="text/javascript" src="{{ asset('template/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('template/plugins/html2canvas/html2canvas.js')}}"></script>
</head>
<div >

</div>
<div id="both"  style=" width: 780px; overflow: auto;">
    <div style="width: 48.5%; float: left; border-right: 1px dashed black">
        <p class="text-left small-margin" style="margin-right: 10px; font-style: italic; font-size: 10px"><b>CSC Form 48</b></p>
        <p class="text-center" style="margin: 5px"><b>SUGAR REGULATORY ADMINISTRATION</b></p>
        <p class="text-center" style="margin: 5px"><b>DAILY TIME RECORD</b></p>
        <br>
        <p class="small-margin" style="font-size: 16px"><b>{{strtoupper($employee->lastname)}}, {{strtoupper($employee->firstname)}} {{strtoupper($employee->name_ext)}}</b></p>
        <p class="small-margin">For the month of <b>{{\Carbon\Carbon::parse($month)->format('F Y')}}</b> </p>
        <table class="table table-bordered table-condensed dtr-table" style="font-size: 11.5px">
            <thead>
            <tr>
                <th rowspan="2">Date</th>
                <th colspan="2">Morning</th>
                <th colspan="2">Afternoon</th>
                <th colspan="2">Overtime</th>
                <th rowspan="2" style="min-width: 30px">Late</th>
                <th rowspan="2" style="min-width: 30px">U/T</th>
                <th rowspan="2">Remarks</th>
            </tr>
            <tr>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>

            </tr>
            </thead>
            <tbody>
            @php($late = 0)
            @php($undertime = 0)
            @php($saturdays= 0)
            @php($sundays = 0)
            @for($a = 1 ; $a <= $days_in_this_month; $a++)

                @php($date = sprintf('%02d', $a))
                @php($fullDate = $month.'-'.$date)
                @if(isset($dtr_array[$month.'-'.$date]))
                    @php($late = $late + $dtr_array[$month.'-'.$date]->late)
                    @php($undertime = $undertime + $dtr_array[$month.'-'.$date]->undertime)
                    @if($dtr_array[$month.'-'.$date]->calculated == -1)
                        @php($italic_op = '<i style="color:#d61900">')
                        @php($italic_cl = '</i>')
                    @else
                        @php($italic_op = '')
                        @php($italic_cl = '')
                    @endif
                    <tr class="text-center">
                        <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                            style="color: red"
                                @endif>
                            {{$date}}
                        </td>

                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['am_in']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['am_in']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_in) !!}
                            @endif
                        </td>
                        <td >
                            @if(isset($dtr_edits_array[$fullDate]['am_out']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['am_out']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_out) !!}
                            @endif

                        </td>
                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['pm_in']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['pm_in']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_in) !!}
                            @endif
                        </td>
                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['pm_out']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['pm_out']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_out) !!}
                            @endif
                        </td>

                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['ot_in']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['ot_in']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_in) !!}
                            @endif
                        </td>
                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['ot_out']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['ot_out']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_out) !!}
                            @endif
                        </td>
                        <td>
                            {!! $italic_op !!}
                            {{$dtr_array[$month.'-'.$date]->late == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->late)}}
                            {!! $italic_cl !!}
                        </td>
                        <td>
                            {!! $italic_op !!}
                                {{$dtr_array[$month.'-'.$date]->undertime == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->undertime)}}
                            {!! $italic_cl !!}
                        </td>
                        <td class="text-left">
                            @if($dtr_array[$month.'-'.$date]->remarks == null)
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                    @php($saturdays++)
                                    SAT
                                @endif
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                    @php($sundays++)
                                    SUN
                                @endif
                                @if(isset($holidays[$month.'-'.$date]))
                                    <b>{{$holidays[$month.'-'.$date]['type']}}</b>
                                @endif
                            @else
                                <span class="text-red">{{$dtr_array[$month.'-'.$date]->remarks}}</span>
                            @endif
                        </td>
                    </tr>
                @else
                    @if(isset($holidays[$month.'-'.$date]))
                        <tr class="text-center">
                            <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                style="color: red"
                                    @endif>
                                {{$date}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-left">{{$holidays[$month.'-'.$date]['name'] ?? ''}}</td>
                            {{--                            <td colspan="9"><b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b></td>--}}
                        </tr>
                    @else
                        <tr class="text-center">
                            <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                style="color: red"
                                    @endif>
                                {{$date}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-left">
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                    @php($saturdays++)
                                    SAT
                                @endif
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                    @php($sundays++)
                                    SUN
                                @endif


                            </td>
                        </tr>
                    @endif
                @endif
            @endfor
            </tbody>
        </table>
        <table style="font-family: 'Helvetica'; font-size: 14px; margin-top: 5px;margin-bottom: 0px;border: 0px; width: 100%">
            <tr>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Late : <span style="font-family: 'HunDin'">{{\App\Swep\Helpers\Helper::convertToHoursMins($late)}}</span></td>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Saturday: <span style="font-family: 'HunDin'">{{number_format($saturdays)}}</span></td>
            </tr>
            <tr>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Undertime : <span style="font-family: 'HunDin'">{{\App\Swep\Helpers\Helper::convertToHoursMins($undertime)}}</span></td>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Sunday: <span style="font-family: 'HunDin'">{{number_format($sundays)}}</span></td>
            </tr>
        </table>

        <div>
            <p style="font-size: 14px; font-family: 'OS-Condenesed-Bold'; margin-top: 35px">I hereby certify that the above records are true and correct</p>

            <div style="float: right; padding-right: 10px; margin-top: 15px">
                ___________________________
                <p class="text-center" style="margin-top: 0">Signature of Employee</p>
            </div>
            <br><br><br>
            <table style="width: 100%;  border-collapse: collapse; border-spacing: 0; margin-bottom: 14px ">
                <tr>
                    <td class="text-center" style=" font-size: 14px;font-family: Arial !important;padding: 0px;">{{request()->get('official_name')}}</td>
                    <td style="width: 40%;padding: 0px;"></td>
                </tr>
                <tr>
                    <td class="text-center" style="font-family: Arial !important;padding: 0px; font-weight: normal; font-style: italic; font-size: 8px">{{request()->get('official_position')}}</td>
                    <td style="width: 40%;padding: 0px;"></td>
                </tr>
                <tr>
                    <td class="text-center" style="border-top: 1px solid black;padding: 0px;font-family: Arial; font-weight: normal; font-size: 14px">Authorized Official</td>
                    <td style="padding: 0px;"></td>
                </tr>
            </table>
        </div>
        <div>
            <p style="font-size: 10px;float: left">2022/PPSPD/MIS | {{Auth::user()->username}} | {{request()->ip()}}</p>
        </div>
    </div>
    <div style="width: 46% ; float: right; margin-right: 20px; ">
        <p class="text-left small-margin" style="margin-right: 10px; font-style: italic; font-size: 10px"><b>CSC Form 48</b></p>
        <p class="text-center" style="margin: 5px"><b>SUGAR REGULATORY ADMINISTRATION</b></p>
        <p class="text-center" style="margin: 5px"><b>DAILY TIME RECORD</b></p>
        <br>
        <p class="small-margin" style="font-size: 16px"><b>{{strtoupper($employee->lastname)}}, {{strtoupper($employee->firstname)}} {{strtoupper($employee->name_ext)}}</b></p>
        <p class="small-margin">For the month of <b>{{\Carbon\Carbon::parse($month)->format('F Y')}}</b> </p>
        <table class="table table-bordered table-condensed dtr-table" style="font-size: 11.5px">
            <thead>
            <tr>
                <th rowspan="2">Date</th>
                <th colspan="2">Morning</th>
                <th colspan="2">Afternoon</th>
                <th colspan="2">Overtime</th>
                <th rowspan="2" style="min-width: 30px">Late</th>
                <th rowspan="2" style="min-width: 30px">U/T</th>
                <th rowspan="2">Remarks</th>
            </tr>
            <tr>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>

            </tr>
            </thead>
            <tbody>
            @php($late = 0)
            @php($undertime = 0)
            @php($saturdays= 0)
            @php($sundays = 0)
            @for($a = 1 ; $a <= $days_in_this_month; $a++)
                @php($date = sprintf('%02d', $a))
                @php($fullDate = $month.'-'.$date)
                @if(isset($dtr_array[$month.'-'.$date]))
                    @php($late = $late + $dtr_array[$month.'-'.$date]->late)
                    @php($undertime = $undertime + $dtr_array[$month.'-'.$date]->undertime)
                    @if($dtr_array[$month.'-'.$date]->calculated == -1)
                        @php($italic_op = '<i style="color:#d61900">')
                        @php($italic_cl = '</i>')
                    @else
                        @php($italic_op = '')
                        @php($italic_cl = '')
                    @endif
                    <tr class="text-center">
                        <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                            style="color: red"
                                @endif>
                            {{$date}}
                        </td>

                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['am_in']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['am_in']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_in) !!}
                            @endif
                        </td>
                        <td >
                            @if(isset($dtr_edits_array[$fullDate]['am_out']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['am_out']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_out) !!}
                            @endif

                        </td>
                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['pm_in']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['pm_in']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_in) !!}
                            @endif
                        </td>
                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['pm_out']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['pm_out']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_out) !!}
                            @endif
                        </td>

                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['ot_in']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['ot_in']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_in) !!}
                            @endif
                        </td>
                        <td>
                            @if(isset($dtr_edits_array[$fullDate]['ot_out']))
                                <span class="text-red"><i>{{$dtr_edits_array[$fullDate]['ot_out']}}</i></span>
                            @else
                                {!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_out) !!}
                            @endif
                        </td>
                        <td>
                            {!! $italic_op !!}
                                {{$dtr_array[$month.'-'.$date]->late == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->late)}}
                            {!! $italic_cl !!}
                        </td>
                        <td>
                            {!! $italic_op !!}
                                {{$dtr_array[$month.'-'.$date]->undertime == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->undertime)}}
                            {!! $italic_cl !!}
                        </td>
                        <td class="text-left">
                            @if($dtr_array[$month.'-'.$date]->remarks == null)
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                    @php($saturdays++)
                                    SAT
                                @endif
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                    @php($sundays++)
                                    SUN
                                @endif
                                @if(isset($holidays[$month.'-'.$date]))
                                    <b>{{$holidays[$month.'-'.$date]['type']}}</b>
                                @endif
                            @else
                                <span class="text-red">{{$dtr_array[$month.'-'.$date]->remarks}}</span>
                            @endif
                        </td>
                    </tr>
                @else
                    @if(isset($holidays[$month.'-'.$date]))
                        <tr class="text-center">
                            <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                style="color: red"
                                    @endif>
                                {{$date}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-left">{{$holidays[$month.'-'.$date]['name'] ?? ''}}</td>
                            {{--                            <td colspan="9"><b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b></td>--}}
                        </tr>
                    @else
                        <tr class="text-center">
                            <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                style="color: red"
                                    @endif>
                                {{$date}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-left">
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                    @php($saturdays++)
                                    SAT
                                @endif
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                    @php($sundays++)
                                    SUN
                                @endif

                            </td>
                        </tr>
                    @endif
                @endif
            @endfor
            </tbody>
        </table>
        <table style="font-family: 'Helvetica'; font-size: 14px; margin-top: 5px;margin-bottom: 0px;border: 0px; width: 100%">
            <tr>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Late : <span style="font-family: 'HunDin'">{{\App\Swep\Helpers\Helper::convertToHoursMins($late)}}</span></td>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Saturday: <span style="font-family: 'HunDin'">{{number_format($saturdays)}}</span></td>
            </tr>
            <tr>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Undertime : <span style="font-family: 'HunDin'">{{\App\Swep\Helpers\Helper::convertToHoursMins($undertime)}}</span></td>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Sunday: <span style="font-family: 'HunDin'">{{number_format($sundays)}}</span></td>
            </tr>
        </table>

        <div>
            <p style="font-size: 14px; font-family: 'OS-Condenesed-Bold'; margin-top: 35px">I hereby certify that the above records are true and correct</p>

            <div style="float: right; padding-right: 10px; margin-top: 15px">
                ___________________________
                <p class="text-center" style="margin-top: 0">Signature of Employee</p>
            </div>
            <br><br><br>
            <table style="width: 100%;  border-collapse: collapse; border-spacing: 0; margin-bottom: 14px ">
                <tr>
                    <td class="text-center" style=" font-size: 14px;font-family: Arial !important;padding: 0px;">{{request()->get('official_name')}}</td>
                    <td style="width: 40%;padding: 0px;"></td>
                </tr>
                <tr>
                    <td class="text-center" style="font-family: Arial !important;padding: 0px; font-weight: normal; font-style: italic; font-size: 8px">{{request()->get('official_position')}}</td>
                    <td style="width: 40%;padding: 0px;"></td>
                </tr>
                <tr>
                    <td class="text-center" style="border-top: 1px solid black;padding: 0px;font-family: Arial; font-weight: normal; font-size: 14px">Authorized Official</td>
                    <td style="padding: 0px;"></td>
                </tr>
            </table>

        </div>
        <div>
            <p style="font-size: 10px;float: left">2022/PPSPD/MIS | {{Auth::user()->username}} | {{request()->ip()}}</p>
        </div>
    </div>
</div>
<button id="cap_btn">Caputre</button>
<div id="frameee">

</div>

<script type="text/javascript">
    $(document).ready(function () {

        html2canvas(document.querySelector("#both"),{
            scale: 3,
        }).then(canvas => {
            $('#frameee').append(canvas);
            $("#both").remove();
            $("#cap_btn").remove();
            setTimeout(function () {
                parent.loaded();
            },1000);
        });


    })


</script>