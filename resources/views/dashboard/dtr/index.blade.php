@extends('layouts.admin-master')

@section('content')

    <section class="content-header">
        <h1>Manage DTR</h1>
    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Biometric Users</h3>
            </div>
            <div class="box-body">
                <div class="panel">
                    <div class="box box-sm box-default box-solid collapsed-box">
                        <div class="box-header with-border">
                            <p class="no-margin"><i class="fa fa-filter"></i> Advanced Filters <small id="filter-notifier" class="label bg-blue blink"></small></p>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool advanced_filters_toggler" data-widget="collapse"><i class="fa fa-plus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="box-body" style="display: none">
                            <form id="filter_form">
                                <div class="row">
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Status:</label>
                                        <select name="is_active"  class="form-control dt_filter filters">
                                            <option value="">Don't filter</option>
                                            {!! \App\Swep\Helpers\Helper::populateOptionsFromObject(\App\Models\SuOptions::employeeStatus(),'option','value') !!}
                                        </select>
                                    </div>
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Sex:</label>
                                        <select name="sex"  class="form-control dt_filter filter_sex filters select22">
                                            <option value="">Don't filter</option>
                                            <option value="MALE">Male</option>
                                            <option value="FEMALE">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Location:</label>
                                        <select name="locations"  class="form-control dt_filter filter_locations filters select22">
                                            <option value="">Don't filter</option>
                                            {!! \App\Swep\Helpers\Helper::populateOptionsFromObject(\App\Models\SuOptions::employeeGroupings(),'option','value') !!}
                                        </select>
                                    </div>
                                    <div class="col-md-2 dt_filter-parent-div">
                                        <label>Assignment:</label>
                                        <select name="assignment"  class="form-control dt_filter filter_sex filters select22">
                                            <option value="">Don't filter</option>
                                            <option value="OFFICE-BASED">OFFICE-BASED</option>
                                            <option value="FIELD">FIELD</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>


                <div id="dtr_table_container" style="display: none">
                    <div class="table-responsive" >
                        <table class="table table-bordered table-striped table-hover" id="dtr_table" style="width: 100%">
                            <thead>
                            <tr class="bg-green">
                                <th>Name</th>
                                <th>BM Id</th>
                                <th class="w-40">Employee No</th>
                                <th class="th-10">Locations</th>
                                <th class="th-10">Sex</th>
                                <th class="th-10">Last attendance</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <div id="tbl_loader">
                <center>
                    <img style="width: 100px" src="{{asset("images/loader.gif")}}">
                </center>
            </div>
            <!-- /.box-body -->

            </div>
        </div>
    </section>


@endsection


@section('modals')
{!! __html::blank_modal('show_dtr_modal','lg') !!}
{!! __html::blank_modal('dtr_modal','lg') !!}
<div class="modal fade" id="print_dtr_modal" tabindex="-1" role="dialog" aria-labelledby="print_dtr_modal_label">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="print_dtr_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Print DTR</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <input name="month" hidden>
                        <input name="bm_u_id" hidden>
                        {!! \App\Swep\ViewHelpers\__form2::textbox('official_name',[
                            'label' => 'Authorized Official:',
                            'cols' => 12,
                            'required' => 'required',
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('official_position',[
                            'label' => 'Position:',
                            'cols' => 12,
                            'required' => 'required',
                        ]) !!}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function dt_draw() {
            users_table.draw(false);
        }

        function filter_dt() {
            var sex = $(".filter_sex").val();
            var status = $(".filter_status").val();
            dtr_tbl.ajax.url("{{ route('dashboard.dtr.index') }}" + "?sex=" + sex + "&status=" + status).load();

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
        $('#dtr_modal').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });


        //-----DATATABLES-----//
        modal_loader = $("#modal_loader").parent('div').html();
        //Initialize DataTable
        active = '';
        dtr_tbl = $("#dtr_table").DataTable({
          'dom' : 'lBfrtip',
          "processing": true,
          "serverSide": true,
          "ajax" : '{{route('dashboard.dtr.index')}}',
          "columns": [
            { "data": "fullname" },
            { "data": "biometric_user_id" },
            { "data": "employee_no" },
            { "data": "locations"},
            { "data": "sex" },
            { "data": "last_attendance" },
              { "data": "action" }
          ],
          "buttons": [
            {!! __js::dt_buttons() !!}
          ],
          "columnDefs":[

            {
              "targets" : [,3,4],
              // "orderable" : ,
              "class" : 'w-6p'
            },
            {
                "targets" : [1,2],
              "class" : 'action-10p'
            },
            {
              "targets" : 6,
              "orderable" : false,
              "class" : 'action2'
            },
          ],
          "responsive": true,
          "initComplete": function( settings, json ) {
                  setTimeout(function () {
                      $("#filter_form select[name='is_active']").val('ACTIVE');
                      $("#filter_form select[name='is_active']").trigger('change');
                  },100);

                $('#tbl_loader').fadeOut(function(){
                  $("#dtr_table_container").fadeIn();
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
              $("#dtr_table #"+active).addClass('success');
            }
          }
        })

        style_datatable("#dtr_table");

        //Need to press enter to search
        $('#dtr_table_filter input').unbind();
        $('#dtr_table_filter input').bind('keyup', function (e) {
          if (e.keyCode == 13) {
            dtr_tbl.search(this.value).draw();
          }
        });

        $(".dt_filter").change(function () {
            filterDT(dtr_tbl);
        })
        $("body").on("click",'.show_dtr_btn',function () {
            btn = $(this);
            load_modal2(btn);
            url = '{{route("dashboard.dtr.show","slug")}}';
            url = url.replace("slug",btn.attr('data'));
            $.ajax({
                url : url,
                data : '',
                type: 'GET',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    populate_modal2(btn,res);
                    console.log(res);
                },
                error: function (res) {
                    notify('Error','danger');
                    console.log(res);
                }
            })
        })

        $("#print_dtr_form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            let month = form.find('input[name=month]').val();
            let bm_u_id = form.find('input[name=bm_u_id]').val();
            $("#print_frame").attr('src','{{route("dashboard.dtr.download")}}?'+form.serialize());
            Swal.fire({
                icon: 'info',
                title: 'Please wait...',
                html: '<div style="padding: 15px; font-size: larger"><i class="fa fa-spin fa-spinner"></i> Preparing your DTR. . .</div>',
                showConfirmButton : false,
            })
        })
    </script>

@endsection