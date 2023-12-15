@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage Holidays</h1>
    </section>

    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Holiday Lists</h3>

                <div class="btn-group pull-right" role="group" aria-label="Basic example">
                    <button id="fetch_google_btn" type="button" class="btn btn-default"><i class="fa fa-refresh"></i> Sync with Google Calendar</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_holiday_modal"><i class="fa fa-plus"></i> Add</button>
{{--                    <button type="button" class="btn btn-default">Right</button>--}}
                </div>
            </div>
            <div class="box-body">
                <div class="panel">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#advanced_filters" aria-expanded="true" class="">
                                <i class="fa fa-filter"></i>  Advanced Filters <i class=" fa  fa-angle-down"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="advanced_filters" class="panel-collapse collapse in" aria-expanded="true" style="">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-1 col-sm-2 col-lg-2">
                                    @php
                                        $hol = \App\Models\Holiday::select(DB::raw('YEAR(date) as year'))->distinct()->get();
                                        $years = $hol->pluck('year');
                                    @endphp
                                    <label>Year:</label>
                                    <select name="year" aria-controls="scholars_table" class="form-control input-sm filter_year filters">
                                        <option value="">All</option>
                                        @if(count($years) > 0)
                                            @foreach($years as $year)
                                                @if($year == \Carbon\Carbon::now()->format('Y'))
                                                    @php($selected = 'selected')
                                                @else
                                                    @php($selected = '')
                                                @endif
                                                <option value="{{$year}}" {{$selected}}>{{$year}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="holidays_table_container" style="display: none">
                    <table class="table table-bordered table-striped table-hover" id="holidays_table" style="width: 100% !important">
                        <thead>
                        <tr class="">
                            <th class="th-20">Year</th>
                            <th >Name</th>
                            <th class="th-10">Date</th>
                            <th class="th-10">Type</th>
                            <th class="action">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="tbl_loader">
                    <center>
                        <img style="width: 100px" src="{{asset('images/loader.gif')}}">
                    </center>
                </div>


            </div>




        </div>
    </section>


@endsection


@section('modals')
    <div class="modal fade" id="add_holiday_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form id="add_holiday_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Holiday</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('date',[
                                'cols' => '12',
                                'label' =>'Date:',
                                'type' => 'date',
                            ]) !!}

                            {!! \App\Swep\ViewHelpers\__form2::textbox('holiday_name',[
                                'cols' => 12,
                                'label' => 'Name: ',
                            ]) !!}

                            {!! __form::select_static(
                            '12 type', 'type', 'Type', '', \App\Swep\Helpers\Helper::holiday_types(), '', '', '', ''
                            ) !!}


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {!! \App\Swep\ViewHelpers\__html::blank_modal('edit_holiday_modal','sm') !!}
@endsection

@section('scripts')
    <script type="text/javascript">
        function dt_draw() {
            holidays_tbl.draw(false);
        }

        function filter_dt() {
            year = $(".filter_year").val();
            //is_active = $(".filter_account").val();
            holidays_tbl.ajax.url("{{ route('dashboard.holidays.index') }}" + "?year=" + year).load();

            $(".filters").each(function (index, el) {
                if ($(this).val() != '') {
                    $(this).parent("div").addClass('has-success');
                    $(this).siblings('label').addClass('text-green');
                } else {
                    $(this).parent("div").removeClass('has-success');
                    $(this).siblings('label').removeClass('text-green');
                }
            });
        }
    </script>
    <script type="text/javascript">
        modal_loader = $("#modal_loader").parent('div').html();

        active = '';
        slug = "";
        //-----DATATABLES-----//
        //Initialize DataTable
        $('#holidays_table')
            .on('preXhr.dt', function ( e, settings, data ) {

            } )


        holidays_tbl = $("#holidays_table").DataTable({
            'dom' : 'lBfrtip',
            "processing": true,
            "serverSide": true,
            "ajax" : '{{ route("dashboard.holidays.index") }}?year={{\Carbon\Carbon::now()->format("Y")}}',
            "columns": [
                { "data": "year" },
                { "data": "name" },
                {
                    "data": "date",
                    "render": function(data, type, row) {
                        return moment(data).format('MMM DD, YYYY') + '<div class="table-subdetail">' +
                             moment(data).format('dddd')+
                            '</div>';
                    }
                },
                { "data": "type" },
                { "data": "action" }
            ],
            "buttons": [
                {!! __js::dt_buttons() !!}
            ],
            "columnDefs":[
                {
                    "targets" : 0,
                    "orderable" : false,
                    "class" : 'w-10p'
                },

                {
                    "targets" : 4,
                    "orderable" : false,
                    "class" : 'action-10p'
                },
            ],
            "order" : [[2, 'asc'],[1,'asc']],
            "responsive": false,
            "initComplete": function( settings, json ) {
                $('#tbl_loader').fadeOut(function(){
                    $("#holidays_table_container").fadeIn();
                });
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src='{{asset("images/loader.gif")}}'></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#holidays_table #"+active).addClass('success');
                }
            }
        })

        style_datatable("#holidays_table");

        //Need to press enter to search
        $('#holidays_table_filter input').unbind();
        $('#holidays_table_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                holidays_tbl.search(this.value).draw();
            }
        });

        $(".filters").change(function(event) {
            filter_dt();
        });




        $("#fetch_google_btn").click(function () {
            btn = $(this);
            //btn.children('i').addClass('fa-spin');
            btn.attr('disabled','disabled');
            btn.html('<i class="fa fa-refresh fa-spin"></i> Syncing with Google Calendar');
            $.ajax({
                url : '{{route("dashboard.holidays.fetch_google")}}',
                // data : ,
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    btn.removeAttr('disabled');
                    btn.html('<i class="fa fa-refresh"></i> Sync with Google Calendar');
                    Swal.fire(
                        'Sync Finished!',
                        'Holidays are updated',
                        'success'
                    );
                    holidays_tbl.draw(false);
                   // console.log(res);
                },
                error: function (res) {
                    console.log(res);
                }
            })
        })

        $("#add_holiday_form").submit(function (e) {
            e.preventDefault();
            form = $(this);
            loading_btn(form);
            $.ajax({
                url : '{{route("dashboard.holidays.store")}}',
                data : form.serialize(),
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    succeed(form,true,false);
                    active = res.slug;
                    holidays_tbl.draw(false);
                    console.log(res);
                },
                error: function (res) {
                    errored(form,res);
                    console.log(res);
                }
            })
        })

        $("body").on("click",".edit_holiday_btn",function () {
            btn = $(this);
            slug = btn.attr('data');
            load_modal2(btn);
            url = '{{route("dashboard.holidays.edit","slug")}}';
            url = url.replace("slug",slug);
            $.ajax({
                url : url,
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                   populate_modal2(btn, res);
                    console.log(res);
                },
                error: function (res) {
                    notify('Error calling ajax','danger');
                    console.log(res);
                }
            })
        })
    </script>


@endsection