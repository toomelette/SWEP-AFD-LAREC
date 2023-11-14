@extends('layouts.admin-master')

@section('content')

  <section class="content-header">
      <h1>Create Employee</h1>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div>
      </div>


      <form id="add_employee_form" role="form" method="POST" autocomplete="off" action="{{ route('dashboard.employee.store') }}">

        @csrf

        <div class="box-body">


          @if($errors->all())
            {!! __html::alert('danger', '<i class="icon fa fa-ban"></i> Oops!', 'Please check if there are errors on other fields.') !!}
          @endif


          {{-- Navigation --}}
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pi" data-toggle="tab">Personal Info</a></li>
              <li><a href="#fi" data-toggle="tab">Family Information</a></li>
              <li><a href="#ad" data-toggle="tab">Appointment Details</a></li>
{{--              <li><a href="#cre" data-toggle="tab">Credentials</a></li>--}}
              <li><a href="#ot" data-toggle="tab">Others Records</a></li>
              <li><a href="#q" data-toggle="tab">Questions</a></li>
            </ul>

            <div class="tab-content">


              {{-- Personal Info --}}
              <div class="tab-pane active" id="pi">
                <div class="panel">
                  <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border">
                      <p class="no-margin">Personal Information</p>
                    </div>
                    <div class="box-body" style="">
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('lastname',[
                        'label' => 'Last Name:',
                        'cols' => 3,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('firstname',[
                          'label' => 'First Name:',
                          'cols' => 3,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('middlename',[
                          'label' => 'Middle Name:',
                          'cols' => 2,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('name_ext',[
                          'label' => 'Name Ext.:',
                          'cols' => 1,
                          'options' => \App\Swep\Helpers\Arrays::name_extensions(),
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_birth',[
                          'label' => 'Birthday:',
                          'cols' => 3,
                          'type' => 'date',
                        ]) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('sex',[
                          'label' => 'Sex:',
                          'cols' => 1,
                          'options' => \App\Swep\Helpers\Arrays::sex(),
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('place_of_birth',[
                          'label' => 'Place of Birth:',
                          'cols' => 5,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('civil_status',[
                          'label' => 'Civil Status:',
                          'cols' => 2,
                          'options' => \App\Swep\Helpers\Arrays::civil_status(),
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('height',[
                          'label' => 'Height:',
                          'cols' => 1,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('height',[
                          'label' => 'Weight:',
                          'cols' => 1,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('blood_type',[
                          'label' => 'Blood Type:',
                          'cols' => 2,
                        ]) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('tel_no',[
                          'label' => 'Telephone No.:',
                          'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('cell_no',[
                          'label' => 'Cellphone No.:',
                          'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('email',[
                          'label' => 'Email Address:',
                          'cols' => 3,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('citizenship',[
                          'label' => 'Ctznship:',
                          'cols' => 1,
                          'options' => ['Filipino' => 'Filipino', 'Dual Citizenship' => 'Dual Citizenship'],
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::select('citizenship_type',[
                          'label' => 'Ctznship Type:',
                          'cols' => 2,
                          'options' => ['BB' => 'by birth', 'BN' => 'by naturalization'],
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('dual_citizenship_country',[
                         'label' => 'If (Dual Citizenship):',
                         'cols' => 2,
                         'placeholder' => ' Pls. Indicate Country',
                        ]) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('agency_no',[
                         'label' => 'Agency Employee No.:',
                         'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('gov_id',[
                         'label' => 'Government Issued ID:',
                         'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('license_passport_no',[
                         'label' => 'ID/License/Passport No.:',
                         'cols' => 2,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('id_date_issue',[
                         'label' => 'Date/Place of Issuance:',
                         'cols' => 2,
                        ]) !!}
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel">
                  <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border">
                      <p class="no-margin">Address</p>
                    </div>
                    <div class="box-body" style="">
                      <div class="row">
                        <div class="col-md-6">
                            <p class="page-header-sm text-info text-strong" style="border-bottom: 1px solid #cedbe1">
                                Residential Address
                            </p>
                            <fieldset id="residential_fieldset">
                              <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_block',[
                                 'label' => 'Block:',
                                 'cols' => 2,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_street',[
                                 'label' => 'Street:',
                                 'cols' => 5,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_village',[
                                 'label' => 'Village:',
                                 'cols' => 5,
                                ]) !!}
                              </div>
                              <div class="row">
                                {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_barangay',[
                                 'label' => 'Barangay:',
                                 'cols' => 6,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_city',[
                                 'label' => 'City:',
                                 'cols' => 6,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_province',[
                                 'label' => 'Province:',
                                 'cols' => 6,
                                ]) !!}
                                {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_zipcode',[
                                 'label' => 'Zipcode:',
                                 'cols' => 3,
                                ]) !!}
                              </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                          <p class="page-header-sm text-success text-strong" style="border-bottom: 1px solid #cedbe1">
                            Permanent Address

                            <span class="checkbox pull-right no-margin">
                              <label>
                                <input type="checkbox" id="fill_perm" value=""> the same as Residential Address
                              </label>
                            </span>
                          </p>
                          <fieldset id="permanent_fieldset">
                            <div class="row">
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_block',[
                               'label' => 'Block:',
                               'cols' => 2,
                              ]) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_street',[
                               'label' => 'Street:',
                               'cols' => 5,
                              ]) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_village',[
                               'label' => 'Village:',
                               'cols' => 5,
                              ]) !!}
                            </div>
                            <div class="row">
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_barangay',[
                               'label' => 'Barangay:',
                               'cols' => 6,
                              ]) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_city',[
                               'label' => 'City:',
                               'cols' => 6,
                              ]) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_province',[
                               'label' => 'Province:',
                               'cols' => 6,
                              ]) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_zipcode',[
                               'label' => 'Zipcode:',
                               'cols' => 3,
                              ]) !!}
                            </div>
                          </fieldset>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>






              {{-- Family Info --}}
              <div class="tab-pane" id="fi">

                <div class="panel">
                  <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border">
                      <p class="no-margin">Parents Information</p>
                    </div>
                    <div class="box-body" style="">
                      <div class="row">
                        <div class="col-md-6">
                          <p class="page-header-sm text-info text-strong" style="border-bottom: 1px solid #cedbe1">
                            Father's Information
                          </p>
                          <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('father_lastname',[
                               'label' => 'Last name:',
                               'cols' => 3,
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('father_firstname',[
                               'label' => 'First name:',
                               'cols' => 4,
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('father_middlename',[
                               'label' => 'Middle name:',
                               'cols' => 3,
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::select('father_name_ext',[
                               'label' => 'Name ext:',
                               'cols' => 2,
                               'options' => \App\Swep\Helpers\Arrays::name_extensions(),
                            ]) !!}
                          </div>
                        </div>

                        <div class="col-md-6">
                          <p class="page-header-sm text-info text-strong" style="border-bottom: 1px solid #cedbe1">
                            Mother's Information (Maiden Name)
                          </p>
                          <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('mother_lastname',[
                               'label' => 'Last name:',
                               'cols' => 3,
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('mother_firstname',[
                               'label' => 'First name:',
                               'cols' => 4,
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('mother_middlename',[
                               'label' => 'Middle name:',
                               'cols' => 3,
                            ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::select('mother_name_ext',[
                               'label' => 'Name ext:',
                               'cols' => 2,
                               'options' => \App\Swep\Helpers\Arrays::name_extensions(),
                            ]) !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="panel">
                      <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border">
                          <p class="no-margin">Spouse's Information</p>
                        </div>
                        <div class="box-body" style="">
                          <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_lastname',[
                                'label' => 'Last name:',
                                'cols' => 4,
                             ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_firstname',[
                                'label' => 'First name:',
                                'cols' => 4,
                             ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_middlename',[
                                'label' => 'Middle name:',
                                'cols' => 4,
                             ]) !!}
                          </div>
                          <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::select('spouse_name_ext',[
                              'label' => 'Name ext:',
                              'cols' => 3,
                              'options' => \App\Swep\Helpers\Arrays::name_extensions(),
                           ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_occupation',[
                                'label' => 'Occupation:',
                                'cols' => 4,
                             ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_employer',[
                                'label' => 'Employer/Business Name:',
                                'cols' => 5,
                             ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_business_address',[
                                'label' => 'Business Address:',
                                'cols' => 6,
                             ]) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_tel_no',[
                               'label' => 'Telephone No.:',
                               'cols' => 6,
                            ]) !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="panel">
                      <div class="box box-sm box-default box-solid">
                        <div class="box-header with-border">
                          Children Information
                          <button id="children_add_row" type="button" class="btn btn-xs bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
                        </div>
                        <div class="box-body" style="">
                          <table class="table table-bordered">
                            <tr>
                              <th>Fullname *</th>
                              <th>Date of Birth *</th>
                              <th style="width: 40px"></th>
                            </tr>
                            <tbody id="children_table_body">
                              @if(old('row_children'))
                                @foreach(old('row_children') as $key => $value)
                                  <tr>

                                    <td>
                                      {!! __form::textbox_for_dt(
                                        'row_children['. $key .'][fullname]', 'Fullname', $value['fullname'], $errors->first('row_children.'. $key .'.fullname')
                                      ) !!}
                                    </td>
                                    <td>
                                      {!! __form::datepicker_for_dt(
                                        'row_children['. $key .'][date_of_birth]', $value['date_of_birth'], $errors->first('row_children.'. $key .'.date_of_birth')
                                      ) !!}
                                    </td>
                                    <td>
                                      <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                                    </td>
                                  </tr>
                                @endforeach
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>






              {{-- Appointment Details --}}
              <div class="tab-pane" id="ad">

                <div class="panel">
                  <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border">
                      <p class="no-margin">Appointment Details</p>
                    </div>
                    <div class="box-body" style="">
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('employee_no',[
                         'label' => 'Employee No. *:',
                         'cols' => 2,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('item_no',[
                         'label' => 'Item No.:',
                         'cols' => 3,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('position',[
                         'label' => 'Position *:',
                         'cols' => 3,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('appointment_status',[
                         'label' => 'Appt. Status *:',
                         'cols' => 2,
                         'options' => \App\Swep\Helpers\Helper::populateOptionsFromObjectAsArray(\App\Models\SuOptions::employeeApptStatus(),'option','value'),
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('salary_grade',[
                         'label' => 'SG *:',
                         'cols' => 1,
                         'placeholder' => 'Salagry Grade',
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('step_inc',[
                         'label' => 'SI *:',
                         'cols' => 1,
                         'placeholder' => 'Step Increment',
                        ]) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('resp_center',[
                         'label' => 'Responsibility Center:',
                         'cols' => 4,
                         'options' => \App\Swep\Helpers\Arrays::groupedRespCodes(),
                          'id' => 'resp_center',
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('monthly_basic',[
                         'label' => 'Monthly Basic:',
                         'cols' => 2,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('food_subsidy',[
                         'label' => 'Food Subsidy:',
                         'cols' => 2,
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('firstday_gov',[
                         'label' => 'First Day to serve Government:',
                         'cols' => 2,
                         'type' => 'date',
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('firstday_sra',[
                         'label' => 'First Day in SRA:',
                         'cols' => 2,
                         'type' => 'date',
                        ]) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('appointment_date',[
                         'label' => 'Appointment Date:',
                         'cols' => 2,
                         'type' => 'date',
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('adjustment_date',[
                         'label' => 'Adjustment Date:',
                         'cols' => 2,
                         'type' => 'date',
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::select('station',[
                         'label' => 'Station:',
                         'cols' => 2,
                         'options' => ['QC' => 'QC', 'VIS' => 'VIS'],
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::select('is_active',[
                         'label' => 'Status *:',
                         'cols' => 2,
                         'options' => \App\Swep\Helpers\Helper::populateOptionsFromObjectAsArray(\App\Models\SuOptions::employeeStatus(),'option','value'),
                        ]) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('locations',[
                         'label' => 'Groupings *:',
                         'cols' => 2,
                         'options' => \App\Swep\Helpers\Helper::populateOptionsFromObjectAsArray(\App\Models\SuOptions::employeeGroupings(),'option','value'), $errors->has('locations'),
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::select('assignment',[
                          'label' => 'Assignment:',
                          'cols' => 2,
                          'options' => \App\Swep\Helpers\Arrays::employeeAssignments()
                        ], $employee ?? null) !!}
                      </div>
                    </div>
                  </div>

                  <div class="panel">
                    <div class="box box-sm box-default box-solid">
                      <div class="box-header with-border">
                        <p class="no-margin">Personal IDs</p>
                      </div>
                      <div class="box-body" style="">
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('gsis',[
                         'label' => 'GSIS:',
                         'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('philhealth',[
                         'label' => 'PHILHEALTH:',
                         'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('tin',[
                         'label' => 'TIN:',
                         'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('sss',[
                         'label' => 'SSS:',
                         'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('hdmf',[
                         'label' => 'HDMF:',
                         'cols' => 2,
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('hdmfpremiums',[
                         'label' => 'HDMF Premiums:',
                         'cols' => 2,
                        ]) !!}
                      </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>













              {{-- Others --}}
              <div class="tab-pane" id="ot">

                {{-- Voluntary Works --}}
                <div class="panel">
                  <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border">
                      Voluntary Works
                      <button id="vw_add_row" type="button" class="btn btn-xs bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
                    </div>
                    <div class="box-body" style="">
                      <table class="table table-bordered">

                        <tr>
                          <th>Name of Organization *</th>
                          <th>Address</th>
                          <th>Date from *</th>
                          <th>Date to *</th>
                          <th>Hours</th>
                          <th>Position</th>
                          <th style="width: 40px"></th>
                        </tr>
                        <tbody id="vw_table_body">
                        @if(old('row_vw'))
                          @foreach(old('row_vw') as $key => $value)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_vw['. $key .'][name]', 'Name of Organization', $value['name'], $errors->first('row_vw.'. $key .'.name')
                                ) !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_vw['. $key .'][address]', 'Address of Organization', $value['address'], $errors->first('row_vw.'. $key .'.address')
                                ) !!}
                              </td>
                              <td>
                                {!! __form::datepicker_for_dt(
                                  'row_vw['. $key .'][date_from]', $value['date_from'], $errors->first('row_vw.'. $key .'.date_from')
                                ) !!}
                              </td>
                              <td>
                                {!! __form::datepicker_for_dt(
                                  'row_vw['. $key .'][date_to]', $value['date_to'], $errors->first('row_vw.'. $key .'.date_to')
                                ) !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_vw['. $key .'][hours]', 'Hours', $value['hours'], $errors->first('row_vw.'. $key .'.hours')
                                ) !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_vw['. $key .'][position]', 'Position', $value['position'], $errors->first('row_vw.'. $key .'.position')
                                ) !!}
                              </td>
                              <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                {{-- Recognitions --}}
                <div class="panel">
                  <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border">
                      Recognitions
                      <button id="recognition_add_row" type="button" class="btn btn-xs bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
                    </div>
                    <div class="box-body" style="">
                      <table class="table table-bordered">
                        <tr>
                          <th>Title *</th>
                          <th style="width: 40px"></th>
                        </tr>
                        <tbody id="recognition_table_body">
                        @if(old('row_recognition'))
                          @foreach(old('row_recognition') as $key => $value)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_recognition['. $key .'][title]', 'Title', $value['title'], $errors->first('row_recognition.'. $key .'.title')
                                ) !!}
                              </td>
                              <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                {{-- Organizations --}}
                <div class="panel">
                  <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border">
                      Organizations
                      <button id="org_add_row" type="button" class="btn btn-xs bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
                    </div>
                    <div class="box-body" style="">
                      <table class="table table-bordered">
                        <tr>
                          <th>Name of Organization *</th>
                          <th style="width: 40px"></th>
                        </tr>
                        <tbody id="org_table_body">
                        @if(old('row_org'))
                          @foreach(old('row_org') as $key => $value)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_org['. $key .'][name]', 'Name of Organization', $value['name'], $errors->first('row_org.'. $key .'.name')
                                ) !!}
                              </td>
                              <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                {{-- Special Skills --}}
                <div class="panel">
                  <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border">
                      Special Skills
                      <button id="ss_add_row" type="button" class="btn btn-xs bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
                    </div>
                    <div class="box-body" style="">
                      <table class="table table-bordered">
                        <tr>
                          <th>Special Skills or Hobies *</th>
                          <th style="width: 40px"></th>
                        </tr>
                        <tbody id="ss_table_body">
                        @if(old('row_ss'))
                          @foreach(old('row_ss') as $key => $value)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_ss['. $key .'][description]', 'Special Skills or Hobies', $value['description'], $errors->first('row_ss.'. $key .'.description')
                                ) !!}
                              </td>
                              <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                {{-- References --}}
                <div class="panel">
                  <div class="box box-sm box-default box-solid">
                    <div class="box-header with-border">
                      References
                      <button id="reference_add_row" type="button" class="btn btn-xs bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
                    </div>
                    <div class="box-body" style="">
                      <table class="table table-bordered">
                        <tr>
                          <th>Fullname *</th>
                          <th>Address *</th>
                          <th>Tel No. *</th>
                          <th style="width: 40px"></th>
                        </tr>
                        <tbody id="reference_table_body">
                        @if(old('row_reference'))
                          @foreach(old('row_reference') as $key => $value)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_reference['. $key .'][fullname]', 'Fullname', $value['fullname'], $errors->first('row_reference.'. $key .'.fullname')
                                ) !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_reference['. $key .'][address]', 'Address', $value['address'], $errors->first('row_reference.'. $key .'.address')
                                ) !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt(
                                  'row_reference['. $key .'][tel_no]', 'Telephone No.', $value['tel_no'], $errors->first('row_reference.'. $key .'.tel_no')
                                ) !!}
                              </td>
                              <td>
                                <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>





              {{-- Questions --}}
              <div class="tab-pane" id="q">
                <div class="row">

                  <div class="col-md-12" style="padding-bottom: 10px;">
                    <h3>Please answer the following questions:</h3>
                  </div>


                  <div class="col-md-12">

                    <div class="col-md-12">
                      <p class="text-muted well well-sm no-shadow">
                        Are you related by consanguinity or affinity to the appointing or recommending authority, or to the
                        chief of bureau or office or to the person who has immediate supervision over you in the Office,
                        Bureau or Department where you will be apppointed,
                      </p>
                    </div>

                    <div class="col-md-12">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. within the third degree?</p>
                      {!! __form::select_static(
                      '3', 'q_34_a', '', old('q_34_a'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_34_a'), $errors->first('q_34_a'), '', ''
                      ) !!}

                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. within the fourth degree (for Local Government Unit - Career Employees)?</p>
                      {!! __form::select_static(
                        '6', 'q_34_b', '', old('q_34_b'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_34_b'), $errors->first('q_34_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details: </p>
                      {!! __form::textbox(
                       '12', 'q_34_b_yes_details', 'text', '', '', old('q_34_b_yes_details'), $errors->has('q_34_b_yes_details'), $errors->first('q_34_b_yes_details'), ''
                    ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been found guilty of any administrative offense?</p>
                      {!! __form::select_static(
                        '6', 'q_35_a', '', old('q_35_a'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_35_a'), $errors->first('q_35_a'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details: </p>
                      {!! __form::textbox(
                       '12', 'q_35_a_yes_details', 'text', '', '', old('q_35_a_yes_details'), $errors->has('q_35_a_yes_details'), $errors->first('q_35_a_yes_details'), ''
                    ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. Have you been criminally charged before any court?</p>
                      {!! __form::select_static(
                        '6', 'q_35_b', '', old('q_35_b'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_35_b'), $errors->first('q_35_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-3">
                      <p style="margin-bottom:-10px;">If YES, give details (Date Filled):</p>
                      {!! __form::textbox(
                       '12', 'q_35_b_yes_details_1', 'text', '', '', old('q_35_b_yes_details_1'), $errors->has('q_35_b_yes_details_1'), $errors->first('q_35_b_yes_details_1'), ''
                      ) !!}
                    </div>

                    <div class="col-md-3">
                      <p style="margin-bottom:-10px;">(Status of Case/s):</p>
                      {!! __form::textbox(
                       '12', 'q_35_b_yes_details_2', 'text', '', '', old('q_35_b_yes_details_2'), $errors->has('q_35_b_yes_details_2'), $errors->first('q_35_b_yes_details_2'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</p>
                      {!! __form::select_static(
                        '6', 'q_36', '', old('q_36'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_36'), $errors->first('q_36'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_36_yes_details', 'text', '', '', old('q_36_yes_details'), $errors->has('q_36_yes_details'), $errors->first('q_36_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?</p>
                      {!! __form::select_static(
                        '6', 'q_37', '', old('q_37'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_37'), $errors->first('q_37'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_37_yes_details', 'text', '', '', old('q_37_yes_details'), $errors->has('q_37_yes_details'), $errors->first('q_37_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</p>
                      {!! __form::select_static(
                        '6', 'q_38_a', '', old('q_38_a'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_38_a'), $errors->first('q_38_a'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_38_a_yes_details', 'text', '', '', old('q_38_a_yes_details'), $errors->has('q_38_a_yes_details'), $errors->first('q_38_a_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?</p>
                      {!! __form::select_static(
                        '6', 'q_38_b', '', old('q_38_b'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_38_b'), $errors->first('q_38_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_38_b_yes_details', 'text', '', '', old('q_38_b_yes_details'), $errors->has('q_38_b_yes_details'), $errors->first('q_38_b_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you acquired the status of an immigrant or permanent resident of another country?</p>
                      {!! __form::select_static(
                        '6', 'q_39', '', old('q_39'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_39'), $errors->first('q_39'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details (Country):</p>
                      {!! __form::textbox(
                       '12', 'q_39_yes_details', 'text', '', '', old('q_39_yes_details'), $errors->has('q_39_yes_details'), $errors->first('q_39_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-12">
                      <p class="text-muted well well-sm no-shadow">
                        Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:
                      </p>
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Are you a member of any indigenous group?</p>
                      {!! __form::select_static(
                        '6', 'q_40_a', '', old('q_40_a'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_40_a'), $errors->first('q_40_a'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_40_a_yes_details', 'text', '', '', old('q_40_a_yes_details'), $errors->has('q_40_a_yes_details'), $errors->first('q_40_a_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. Are you a person with disability?</p>
                      {!! __form::select_static(
                        '6', 'q_40_b', '', old('q_40_b'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_40_b'), $errors->first('q_40_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details (ID No.):</p>
                      {!! __form::textbox(
                       '12', 'q_40_b_yes_details', 'text', '', '', old('q_40_b_yes_details'), $errors->has('q_40_b_yes_details'), $errors->first('q_40_b_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">c. Are you a solo parent?</p>
                      {!! __form::select_static(
                        '6', 'q_40_c', '', old('q_40_c'), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_40_c'), $errors->first('q_40_c'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details (ID No.):</p>
                      {!! __form::textbox(
                       '12', 'q_40_c_yes_details', 'text', '', '', old('q_40_c_yes_details'), $errors->has('q_40_c_yes_details'), $errors->first('q_40_c_yes_details'), ''
                      ) !!}
                    </div>

                  </div>


                </div>
              </div>




            </div>

          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Save</button>
        </div>

      </form>

    </div>

  </section>

@endsection





@section('modals')

  @if(Session::has('EMPLOYEE_CREATE_SUCCESS'))
    {!! __html::modal('employee', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('EMPLOYEE_CREATE_SUCCESS')) !!}
  @endif

@endsection





@section('scripts')

  <script type="text/javascript">
    $("#resp_center").select2();
    @if(Session::has('EMPLOYEE_CREATE_SUCCESS'))
      $('#employee').modal('show');
    @endif


    {!! __js::ajax_select_to_select(
      'department_id', 'department_unit_id', '/api/department_unit/select_departmentUnit_byDeptId/', 'department_unit_id', 'description'
    ) !!}





    {{-- Children ADD ROW --}}
    $(document).ready(function() {

      $("#children_add_row").on("click", function() {
      var i = $("#children_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group" style="margin-bottom: 0px">' +
                          '<input type="text" name="row_children[' + i + '][fullname]" class="form-control" placeholder="Fullname">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<div class="form-group" style="margin-bottom: 0px">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_children[' + i + '][date_of_birth]" type="date" class="form-control" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#children_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });

      $(this).removeClass('datepicker');

      });

    });







    {{-- EB ADD ROW --}}
    $(document).ready(function() {

      $("#eb_add_row").on("click", function() {
      var i = $("#eb_table_body").children().length;
      var content ='<tr>' +
                    '<td>' +
                      '<div class="form-group">' +
                        '<select name="row_eb[' + i + '][level]" class="form-control">' +
                          '<option value="">Select</option>' +
                          '@foreach(__static::educ_level() as $name => $value)' +
                            '<option value="{{ $value }}">{{ $name }}</option>' +
                          '@endforeach' +
                        '</select>' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][school_name]" class="form-control" placeholder="Name of School">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][course]" class="form-control" placeholder="Course">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][date_from]" class="form-control" placeholder="Date From">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][date_to]" class="form-control" placeholder="Date To">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][units]" class="form-control" placeholder="Units">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][graduate_year]" class="form-control" placeholder="Year">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<div class="form-group">' +
                        '<input type="text" name="row_eb[' + i + '][scholarship]" class="form-control" placeholder="Scholarship">' +
                      '</div>' +
                    '</td>' +

                    '<td>' +
                      '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                    '</td>' +

                  '</tr>';

      $("#eb_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });

      $(this).removeClass('datepicker');

      });

    });







    {{-- Training ADD ROW --}}
    $(document).ready(function() {

      $("#training_add_row").on("click", function() {
      var i = $("#training_table_body").children().length;
      var content ='<tr>' +
                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][title]" class="form-control" placeholder="Title">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][type]" class="form-control" placeholder="Type of L & D">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][conducted_by]" class="form-control" placeholder="Conducted by">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_training[' + i + '][date_from]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_training[' + i + '][date_to]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][hours]" class="form-control" placeholder="Hours">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][venue]" class="form-control" placeholder="Venue">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_training[' + i + '][remarks]" class="form-control" placeholder="Remarks">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#training_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });

      $(this).removeClass('datepicker');

      });
    });







    {{-- Eligibility ADD ROW --}}
    $(document).ready(function() {

      $("#eligibility_add_row").on("click", function() {
      var i = $("#eligibility_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                         ' <input type="text" name="row_eligibility[' + i + '][eligibility]" class="form-control" placeholder="Eligibility">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_eligibility[' + i + '][level]" class="form-control" placeholder="Level">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_eligibility[' + i + '][rating]" class="form-control" placeholder="Rating">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_eligibility[' + i + '][exam_place]" class="form-control" placeholder="Place of Examination">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_eligibility[' + i + '][exam_date]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_eligibility[' + i + '][license_no]" class="form-control" placeholder="License No">' +
                        '</div>' +
                      '</td>' +


                       '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_eligibility[' + i + '][license_validity]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#eligibility_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });

      $(this).removeClass('datepicker');

      });
    });







    {{-- Experience ADD ROW --}}
    $(document).ready(function() {

      $("#we_add_row").on("click", function() {
      var i = $("#we_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_we[' + i + '][date_from]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_we[' + i + '][date_to]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][company]" class="form-control" placeholder="Company">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][position]" class="form-control" placeholder="Position">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][salary]" class="form-control priceformat" placeholder="Salary">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][salary_grade]" class="form-control" placeholder="Salary Grade">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<input type="text" name="row_we[' + i + '][appointment_status]" class="form-control" placeholder="Appointment Status">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group">' +
                          '<select name="row_we[' + i + '][is_gov_service]" class="form-control">' +
                            '<option value="">Select</option>' +
                              '<option value="true">YES</option>' +
                              '<option value="false">NO</option>' +
                          '</select>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                          '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#we_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });

      // $(".priceformat").priceFormat({
      //   prefix: "",
      //   thousandsSeparator: ",",
      //   clearOnEmpty: true,
      //   allowNegative: true
      // });

      $(this).removeClass('datepicker');

      });
    });







    {{-- Voluntary Works ADD ROW --}}
    $(document).ready(function() {
      {!! \App\Swep\ViewHelpers\__js::autonum() !!}
      $("#vw_add_row").on("click", function() {
      var i = $("#vw_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_vw[' + i + '][name]" class="form-control" placeholder="Name">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_vw[' + i + '][address]" class="form-control" placeholder="Address">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_vw[' + i + '][date_from]" type="date" class="form-control"  placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_vw[' + i + '][date_to]" type="date" class="form-control"  placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_vw[' + i + '][hours]" class="form-control" placeholder="Hours">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_vw[' + i + '][position]" class="form-control" placeholder="Position">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#vw_table_body").append($(content));

      $('.datepicker').each(function(){
          $(this).datepicker({
            autoclose: true,
            dateFormat: "mm/dd/yy",
            orientation: "bottom"
        });
      });

      $(this).removeClass('datepicker');

      });

    });







    {{-- Recognitions ADD ROW --}}
    $(document).ready(function() {

      $("#recognition_add_row").on("click", function() {
      var i = $("#recognition_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_recognition[' + i + '][title]" class="form-control" placeholder="Title">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#recognition_table_body").append($(content));

      });

    });







    {{-- Organizations ADD ROW --}}
    $(document).ready(function() {

      $("#org_add_row").on("click", function() {
      var i = $("#org_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_org[' + i + '][name]" class="form-control" placeholder="Name">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#org_table_body").append($(content));

      });

    });







    {{-- Special Skills ADD ROW --}}
    $(document).ready(function() {

      $("#ss_add_row").on("click", function() {
      var i = $("#ss_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_ss[' + i + '][description]" class="form-control" placeholder="Special Skills or Hobies">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';

      $("#ss_table_body").append($(content));

      });

    });







    {{-- Reference ADD ROW --}}
    $(document).ready(function() {

      $("#reference_add_row").on("click", function() {
      var i = $("#reference_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_reference[' + i + '][fullname]" class="form-control" placeholder="Fullname">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_reference[' + i + '][address]" class="form-control" placeholder="Address">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_reference[' + i + '][tel_no]" class="form-control" placeholder="Telephone No.">' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                      '</td>' +

                    '</tr>';
      if(i < 3){
        $("#reference_table_body").append($(content));
      }

      });

    });



    $("#add_employee_form").submit(function (e) {
      e.preventDefault();
      let form = $(this);
      loading_btn(form);
      $.ajax({
          url : '{{route("dashboard.employee.store")}}',
          data : form.serialize(),
          type: 'POST',
          headers: {
              {!! __html::token_header() !!}
          },
          success: function (res) {
              unmark_required(form)
              form.get(0).reset();
              notify('Employee successfully added.');
              remove_loading_btn(form);
            markTabs(form);
          },
          error: function (res) {
            errored(form,res);
            markTabs(form);
          }
      })
    })




    {{-- Fill Permanent address --}}
    $("#fill_perm").change(function () {
      let prop = $(this).prop('checked');
      if(prop == true){
        $("#residential_fieldset input").each(function () {
          let this_name = $(this).attr('name');
          let perm_counterpart = this_name.replaceAll('res_','perm_');
          $("input[name="+perm_counterpart+"]").val($(this).val());
        })
      }
    })



  </script>

@endsection