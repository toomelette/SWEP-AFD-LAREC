<?php
  $medical_history_options = [
    'Hypertension' ,
    'Vertigo/Chronic Headache',
    'Diabetes',
    'High Cholesterol',
    'Asthma',
    'Tuberculosis',
    'EENT Disorder',
    'Chronic Obstructive Pulmonary Disease (COPD)',
    'Heart Disorder',
    'Kidney Disease',
    'Liver/Gallbladder Disease',
    'Peptic Ulcer',
    'UTI',
    'Allergies',
    'Infectious Disease',
    'Stress Disorder',
    'Measles',
    'Chicken Pox',
    'Depression/Anxiety Disorder',
    'Hepatitis',
    'Anemia',
    'Epilepsy'
  ];

?>
@extends('layouts.admin-master')

@section('content')
  <section class="content-header">
      <h1>Edit Employee</h1>
      <div class="pull-right" style="margin-top: -25px;">
       {!! __html::back_button(['dashboard.employee.index', 'dashboard.employee.show']) !!}
      </div>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div>
      </div>


      <form id="edit_employee_form" autocomplete="off">

        @csrf
        <input name="slug" value="{{$employee->slug}}" type="hidden">
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
              <li><a href="#or" data-toggle="tab">Other Records</a></li>
              <li><a href="#oq" data-toggle="tab">Other Questions</a></li>
{{--              <li><a href="#health_declaration" data-toggle="tab">201 File <span class="label label-success">NEW</span></a></li>--}}
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
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('firstname',[
                          'label' => 'First Name:',
                          'cols' => 3,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('middlename',[
                          'label' => 'Middle Name:',
                          'cols' => 2,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('name_ext',[
                          'label' => 'Name Ext.:',
                          'cols' => 1,
                          'options' => \App\Swep\Helpers\Arrays::name_extensions(),
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('date_of_birth',[
                          'label' => 'Birthday:',
                          'cols' => 3,
                          'type' => 'date',
                        ],$employee ?? null) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('sex',[
                          'label' => 'Sex:',
                          'cols' => 1,
                          'options' => \App\Swep\Helpers\Arrays::sex(),
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('place_of_birth',[
                          'label' => 'Place of Birth:',
                          'cols' => 5,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('civil_status',[
                          'label' => 'Civil Status:',
                          'cols' => 2,
                          'options' => \App\Swep\Helpers\Arrays::civil_status(),
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('height',[
                          'label' => 'Height:',
                          'cols' => 1,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('weight',[
                          'label' => 'Weight:',
                          'cols' => 1,
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('blood_type',[
                          'label' => 'Blood Type:',
                          'cols' => 2,
                        ],$employee ?? null) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('tel_no',[
                          'label' => 'Telephone No.:',
                          'cols' => 2,
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('cell_no',[
                          'label' => 'Cellphone No.:',
                          'cols' => 2,
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('email',[
                          'label' => 'Email Address:',
                          'cols' => 3,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('citizenship',[
                          'label' => 'Ctznship:',
                          'cols' => 1,
                          'options' => ['Filipino' => 'Filipino', 'Dual Citizenship' => 'Dual Citizenship'],
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::select('citizenship_type',[
                          'label' => 'Ctznship Type:',
                          'cols' => 2,
                          'options' => ['BB' => 'by birth', 'BN' => 'by naturalization'],
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('dual_citizenship_country',[
                         'label' => 'If (Dual Citizenship):',
                         'cols' => 2,
                         'placeholder' => ' Pls. Indicate Country',
                        ],$employee ?? null) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('agency_no',[
                         'label' => 'Agency Employee No.:',
                         'cols' => 2,
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('gov_id',[
                         'label' => 'Government Issued ID:',
                         'cols' => 2,
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('license_passport_no',[
                         'label' => 'ID/License/Passport No.:',
                         'cols' => 2,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('id_date_issue',[
                         'label' => 'Date/Place of Issuance:',
                         'cols' => 2,
                        ],$employee ?? null) !!}
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
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_street',[
                               'label' => 'Street:',
                               'cols' => 5,
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_village',[
                               'label' => 'Village:',
                               'cols' => 5,
                              ],$employee->employeeAddress ?? null) !!}
                            </div>
                            <div class="row">
                              {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_barangay',[
                               'label' => 'Barangay:',
                               'cols' => 6,
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_city',[
                               'label' => 'City:',
                               'cols' => 6,
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_province',[
                               'label' => 'Province:',
                               'cols' => 6,
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('res_address_zipcode',[
                               'label' => 'Zipcode:',
                               'cols' => 3,
                              ],$employee->employeeAddress ?? null) !!}
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
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_street',[
                               'label' => 'Street:',
                               'cols' => 5,
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_village',[
                               'label' => 'Village:',
                               'cols' => 5,
                              ],$employee->employeeAddress ?? null) !!}
                            </div>
                            <div class="row">
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_barangay',[
                               'label' => 'Barangay:',
                               'cols' => 6,
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_city',[
                               'label' => 'City:',
                               'cols' => 6,
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_province',[
                               'label' => 'Province:',
                               'cols' => 6,
                              ],$employee->employeeAddress ?? null) !!}
                              {!! \App\Swep\ViewHelpers\__form2::textbox('perm_address_zipcode',[
                               'label' => 'Zipcode:',
                               'cols' => 3,
                              ],$employee->employeeAddress ?? null) !!}
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
                            ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('father_firstname',[
                               'label' => 'First name:',
                               'cols' => 4,
                            ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('father_middlename',[
                               'label' => 'Middle name:',
                               'cols' => 3,
                            ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::select('father_name_ext',[
                               'label' => 'Name ext:',
                               'cols' => 2,
                               'options' => \App\Swep\Helpers\Arrays::name_extensions(),
                            ],$employee->employeeFamilyDetail ?? null) !!}
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
                            ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('mother_firstname',[
                               'label' => 'First name:',
                               'cols' => 4,
                            ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('mother_middlename',[
                               'label' => 'Middle name:',
                               'cols' => 3,
                            ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::select('mother_name_ext',[
                               'label' => 'Name ext:',
                               'cols' => 2,
                               'options' => \App\Swep\Helpers\Arrays::name_extensions(),
                            ],$employee->employeeFamilyDetail ?? null) !!}
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
                             ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_firstname',[
                                'label' => 'First name:',
                                'cols' => 4,
                             ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_middlename',[
                                'label' => 'Middle name:',
                                'cols' => 4,
                             ],$employee->employeeFamilyDetail ?? null) !!}
                          </div>
                          <div class="row">
                            {!! \App\Swep\ViewHelpers\__form2::select('spouse_name_ext',[
                              'label' => 'Name ext:',
                              'cols' => 3,
                              'options' => \App\Swep\Helpers\Arrays::name_extensions(),
                           ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_occupation',[
                                'label' => 'Occupation:',
                                'cols' => 4,
                             ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_employer',[
                                'label' => 'Employer/Business Name:',
                                'cols' => 5,
                             ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_business_address',[
                                'label' => 'Business Address:',
                                'cols' => 6,
                             ],$employee->employeeFamilyDetail ?? null) !!}
                            {!! \App\Swep\ViewHelpers\__form2::textbox('spouse_tel_no',[
                               'label' => 'Telephone No.:',
                               'cols' => 6,
                            ],$employee->employeeFamilyDetail ?? null) !!}
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
                            @else
                              @foreach($employee->employeeChildren as $key => $data)
                                <tr>
                                  <td>
                                    {!! __form::textbox_for_dt('row_children['. $key .'][fullname]', 'Fullname', $data->fullname, '') !!}
                                  </td>

                                  <td>
                                    {!! __form::datepicker_for_dt('row_children['. $key .'][date_of_birth]', $data->date_of_birth, '') !!}
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
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('item_no',[
                         'label' => 'Item No.:',
                         'cols' => 3,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('position',[
                         'label' => 'Position *:',
                         'cols' => 3,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('appointment_status',[
                         'label' => 'Appt. Status *:',
                         'cols' => 2,
                         'options' => \App\Swep\Helpers\Helper::populateOptionsFromObjectAsArray(\App\Models\SuOptions::employeeApptStatus(),'option','value'),
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('salary_grade',[
                         'label' => 'SG *:',
                         'cols' => 1,
                         'placeholder' => 'Salagry Grade',
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('step_inc',[
                         'label' => 'SI *:',
                         'cols' => 1,
                         'placeholder' => 'Step Increment',
                        ],$employee ?? null) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('resp_center',[
                         'label' => 'Responsibility Center:',
                         'cols' => 4,
                         'options' => \App\Swep\Helpers\Arrays::groupedRespCodes(),
                          'id' => 'resp_center',
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('monthly_basic',[
                         'label' => 'Monthly Basic:',
                         'cols' => 2,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('food_subsidy',[
                         'label' => 'Food Subsidy:',
                         'cols' => 2,
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('firstday_gov',[
                         'label' => 'First Day to serve Government:',
                         'cols' => 2,
                         'type' => 'date',
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('firstday_sra',[
                         'label' => 'First Day in SRA:',
                         'cols' => 2,
                         'type' => 'date',
                        ],$employee ?? null) !!}
                      </div>
                      <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::textbox('appointment_date',[
                         'label' => 'Appointment Date:',
                         'cols' => 2,
                         'type' => 'date',
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::textbox('adjustment_date',[
                         'label' => 'Adjustment Date:',
                         'cols' => 2,
                         'type' => 'date',
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::select('station',[
                         'label' => 'Station:',
                         'cols' => 2,
                         'options' => ['QC' => 'QC', 'VIS' => 'VIS'],
                        ],$employee ?? null) !!}
                        {!! \App\Swep\ViewHelpers\__form2::select('is_active',[
                         'label' => 'Status *:',
                         'cols' => 2,
                         'options' => \App\Swep\Helpers\Helper::populateOptionsFromObjectAsArray(\App\Models\SuOptions::employeeStatus(),'option','value'),
                        ],$employee ?? null) !!}

                        {!! \App\Swep\ViewHelpers\__form2::select('locations',[
                         'label' => 'Groupings *:',
                         'cols' => 2,
                         'options' => \App\Swep\Helpers\Helper::populateOptionsFromObjectAsArray(\App\Models\SuOptions::employeeGroupings(),'option','value'), $errors->has('locations'),
                        ],$employee ?? null) !!}
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
                          ],$employee ?? null) !!}
                          {!! \App\Swep\ViewHelpers\__form2::textbox('philhealth',[
                           'label' => 'PHILHEALTH:',
                           'cols' => 2,
                          ],$employee ?? null) !!}
                          {!! \App\Swep\ViewHelpers\__form2::textbox('tin',[
                           'label' => 'TIN:',
                           'cols' => 2,
                          ],$employee ?? null) !!}
                          {!! \App\Swep\ViewHelpers\__form2::textbox('sss',[
                           'label' => 'SSS:',
                           'cols' => 2,
                          ],$employee ?? null) !!}
                          {!! \App\Swep\ViewHelpers\__form2::textbox('hdmf',[
                           'label' => 'HDMF:',
                           'cols' => 2,
                          ],$employee ?? null) !!}
                          {!! \App\Swep\ViewHelpers\__form2::textbox('hdmfpremiums',[
                           'label' => 'HDMF Premiums:',
                           'cols' => 2,
                          ],$employee ?? null) !!}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



              {{-- Other Records --}}
              <div class="tab-pane" id="or">
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
                        @else
                          @foreach($employee->employeeVoluntaryWork as $key => $data)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt('row_vw['. $key .'][name]', 'Name of Organization', $data->name, '') !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt('row_vw['. $key .'][address]', 'Address of Organization', $data->address,'') !!}
                              </td>
                              <td>
                                {!! __form::datepicker_for_dt('row_vw['. $key .'][date_from]', $data->date_from,'') !!}
                              </td>
                              <td>
                                {!! __form::datepicker_for_dt('row_vw['. $key .'][date_to]', $data->date_to,'') !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt('row_vw['. $key .'][hours]', 'Hours', $data->hours,'') !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt('row_vw['. $key .'][position]', 'Position', $data->position,'') !!}
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
                        @else
                          @foreach($employee->employeeRecognition as $key => $data)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt('row_recognition['. $key .'][title]', 'Title', $data->title, '') !!}
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
                        @else
                          @foreach($employee->employeeOrganization as $key => $data)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt('row_org['. $key .'][name]', 'Name of Organization', $data->name, '') !!}
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
                        @else
                          @foreach($employee->employeeSpecialSkill as $key => $data)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt('row_ss['. $key .'][description]', 'Special Skills or Hobies', $data->description, '') !!}
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
                        @else
                          @foreach($employee->employeeReference as $key => $data)
                            <tr>
                              <td>
                                {!! __form::textbox_for_dt('row_reference['. $key .'][fullname]', 'Fullname', $data->fullname, '') !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt('row_reference['. $key .'][address]', 'Address', $data->address, '') !!}
                              </td>
                              <td>
                                {!! __form::textbox_for_dt('row_reference['. $key .'][tel_no]', 'Telephone No.', $data->tel_no, '') !!}
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
              <div class="tab-pane" id="oq">
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
                      '3', 'q_34_a', '', old('q_34_a') ? old('q_34_a') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_34_a), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_34_a'), $errors->first('q_34_a'), '', ''
                      ) !!}

                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. within the fourth degree (for Local Government Unit - Career Employees)?</p>
                      {!! __form::select_static(
                        '6', 'q_34_b', '', old('q_34_b') ? old('q_34_b') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_34_b), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_34_b'), $errors->first('q_34_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details: </p>
                      {!! __form::textbox(
                       '12', 'q_34_b_yes_details', 'text', '', '', old('q_34_b_yes_details') ? old('q_34_b_yes_details') : optional($employee->employeeOtherQuestion)->q_34_b_yes_details, $errors->has('q_34_b_yes_details'), $errors->first('q_34_b_yes_details'), ''
                    ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been found guilty of any administrative offense?</p>
                      {!! __form::select_static(
                        '6', 'q_35_a', '', old('q_35_a') ? old('q_35_a') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_35_a), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_35_a'), $errors->first('q_35_a'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details: </p>
                      {!! __form::textbox(
                       '12', 'q_35_a_yes_details', 'text', '', '', old('q_35_a_yes_details') ? old('q_35_a_yes_details') : optional($employee->employeeOtherQuestion)->q_35_a_yes_details, $errors->has('q_35_a_yes_details'), $errors->first('q_35_a_yes_details'), ''
                    ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. Have you been criminally charged before any court?</p>
                      {!! __form::select_static(
                        '6', 'q_35_b', '', old('q_35_b') ? old('q_35_b') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_35_b), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_35_b'), $errors->first('q_35_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-3">
                      <p style="margin-bottom:-10px;">If YES, give details (Date Filed):</p>
                      {!! __form::textbox(
                       '12', 'q_35_b_yes_details_1', 'text', '', '', old('q_35_b_yes_details_1') ? old('q_35_b_yes_details_1') : optional($employee->employeeOtherQuestion)->q_35_b_yes_details_1, $errors->has('q_35_b_yes_details_1'), $errors->first('q_35_b_yes_details_1'), ''
                      ) !!}
                    </div>

                    <div class="col-md-3">
                      <p style="margin-bottom:-10px;">(Status of Case/s):</p>
                      {!! __form::textbox(
                       '12', 'q_35_b_yes_details_2', 'text', '', '', old('q_35_b_yes_details_2') ? old('q_35_b_yes_details_2') : optional($employee->employeeOtherQuestion)->q_35_b_yes_details_2, $errors->has('q_35_b_yes_details_2'), $errors->first('q_35_b_yes_details_2'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?</p>
                      {!! __form::select_static(
                        '6', 'q_36', '', old('q_36') ? old('q_36') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_36), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_36'), $errors->first('q_36'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_36_yes_details', 'text', '', '', old('q_36_yes_details') ? old('q_36_yes_details') : optional($employee->employeeOtherQuestion)->q_36_yes_details, $errors->has('q_36_yes_details'), $errors->first('q_36_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?</p>
                      {!! __form::select_static(
                        '6', 'q_37', '', old('q_37') ? old('q_37') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_37), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_37'), $errors->first('q_37'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_37_yes_details', 'text', '', '', old('q_37_yes_details') ? old('q_37_yes_details') : optional($employee->employeeOtherQuestion)->q_37_yes_details, $errors->has('q_37_yes_details'), $errors->first('q_37_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?</p>
                      {!! __form::select_static(
                        '6', 'q_38_a', '', old('q_38_a') ? old('q_38_a') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_38_a), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_38_a'), $errors->first('q_38_a'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_38_a_yes_details', 'text', '', '', old('q_38_a_yes_details') ? old('q_38_a_yes_details') : optional($employee->employeeOtherQuestion)->q_38_a_yes_details, $errors->has('q_38_a_yes_details'), $errors->first('q_38_a_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?</p>
                      {!! __form::select_static(
                        '6', 'q_38_b', '', old('q_38_b') ? old('q_38_b') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_38_b), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_38_b'), $errors->first('q_38_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_38_b_yes_details', 'text', '', '', old('q_38_b_yes_details') ? old('q_38_b_yes_details') : optional($employee->employeeOtherQuestion)->q_38_b_yes_details, $errors->has('q_38_b_yes_details'), $errors->first('q_38_b_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">a. Have you acquired the status of an immigrant or permanent resident of another country?</p>
                      {!! __form::select_static(
                        '6', 'q_39', '', old('q_39') ? old('q_39') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_39), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_39'), $errors->first('q_39'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details (Country):</p>
                      {!! __form::textbox(
                       '12', 'q_39_yes_details', 'text', '', '', old('q_39_yes_details') ? old('q_39_yes_details') : optional($employee->employeeOtherQuestion)->q_39_yes_details, $errors->has('q_39_yes_details'), $errors->first('q_39_yes_details'), ''
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
                        '6', 'q_40_a', '', old('q_40_a') ? old('q_40_a') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_40_a), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_40_a'), $errors->first('q_40_a'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details:</p>
                      {!! __form::textbox(
                       '12', 'q_40_a_yes_details', 'text', '', '', old('q_40_a_yes_details') ? old('q_40_a_yes_details') : optional($employee->employeeOtherQuestion)->q_40_a_yes_details, $errors->has('q_40_a_yes_details'), $errors->first('q_40_a_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">b. Are you a person with disability?</p>
                      {!! __form::select_static(
                        '6', 'q_40_b', '', old('q_40_b') ? old('q_40_b') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_40_b), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_40_b'), $errors->first('q_40_b'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details (ID No.):</p>
                      {!! __form::textbox(
                       '12', 'q_40_b_yes_details', 'text', '', '', old('q_40_b_yes_details') ? old('q_40_b_yes_details') : optional($employee->employeeOtherQuestion)->q_40_b_yes_details, $errors->has('q_40_b_yes_details'), $errors->first('q_40_b_yes_details'), ''
                      ) !!}
                    </div>

                    <div class="col-md-12"></div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px; font-weight: bold;">c. Are you a solo parent?</p>
                      {!! __form::select_static(
                        '6', 'q_40_c', '', old('q_40_c') ? old('q_40_c') : __dataType::boolean_to_string(optional($employee->employeeOtherQuestion)->q_40_c), ['YES' => 'true', 'NO' => 'false'], $errors->has('q_40_c'), $errors->first('q_40_c'), '', ''
                      ) !!}
                    </div>

                    <div class="col-md-6">
                      <p style="margin-bottom:-10px;">If YES, give details (ID No.):</p>
                      {!! __form::textbox(
                       '12', 'q_40_c_yes_details', 'text', '', '', old('q_40_c_yes_details') ? old('q_40_c_yes_details') : optional($employee->employeeOtherQuestion)->q_40_c_yes_details, $errors->has('q_40_c_yes_details'), $errors->first('q_40_c_yes_details'), ''
                      ) !!}
                    </div>

                  </div>


                </div>
              </div>


              {{-- Health Declaration --}}
              <div class="tab-pane" id="health_declaration">
                <div class="row">

                  <div class="col-md-12" style="padding-bottom: 10px;">
                    <div class="col-md-12">

                      <p class="text-primary well well-sm no-shadow">
                        <i class="fa fa-info-circle"></i>
                        Please be advised that the information below shall only be used in relation to COVID-19 and other medical internal protocols in accordance with Data Privacy Act.
                      </p>
                    </div>
                  </div>


                  <div class="col-md-12">

                    <div class="row">
                      <div class="col-md-12">
                        {!! __form::textbox(
                           '3', 'family_doctor', 'text', 'Family Doctor, if any', 'Family Doctor, if any', old('family_doctor') ? old('family_doctor') : optional($employee->employeeHealthDeclaration)->family_doctor, $errors->has('family_doctor'), $errors->first('family_doctor'), ''
                        ) !!}

                        {!! __form::textbox(
                           '2', 'contact_person', 'text', 'Contact person in case of emergency', 'Contact Person in case of emergency', old('contact_person') ? old('contact_person') : optional($employee->employeeHealthDeclaration)->contact_person, $errors->has('contact_person'), $errors->first('contact_person'), ''
                        ) !!}

                        {!! __form::textbox(
                           '2', 'contact_person_phone', 'text', "Contact person's phone", "Contact person's phone", old('contact_person_phone') ? old('contact_person_phone') : optional($employee->employeeHealthDeclaration)->contact_person_phone, $errors->has('contact_person_phone'), $errors->first('contact_person_phone'), ''
                        ) !!}

                        {!! __form::textbox(
                           '5', 'cities_ecq', 'text', "Cities in the Philippines you have worked, visited, transited in the past 14 days/ECQ period", "Cities in the Philippines you have worked, visited, transited in the past 14 days/ECQ period", old('cities_ecq') ? old('cities_ecq') : optional($employee->employeeHealthDeclaration)->cities_ecq , $errors->has('cities_ecq'), $errors->first('cities_ecq'), ''
                        ) !!}

                        <div class="col-md-12" style="border-top:solid 1px; padding-bottom:15px; color:gray;"></div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-6">
                          <p style="margin-bottom:-10px; font-weight: bold;">Have you been sick in the past 30 days? Hospital visited if any?</p>
                          {!! __form::select_static(
                            '6', 'been_sick', '', old('been_sick') ? old('been_sick') : optional($employee->employeeHealthDeclaration)->been_sick, ['YES' => 'true', 'NO' => 'false'], $errors->has('been_sick'), $errors->first('been_sick'), '', ''
                          ) !!}
                        </div>

                        <div class="col-md-6">
                          <p style="margin-bottom:-10px;">If YES, pls. describe condition: </p>
                          {!! __form::textbox(
                           '12', 'been_sick_yes_details', 'text', '', '', old('been_sick_yes_details') ? old('been_sick_yes_details') : optional($employee->employeeHealthDeclaration)->been_sick_yes_details, $errors->has('been_sick_yes_details'), $errors->first('been_sick_yes_details'), ''
                        ) !!}
                        </div>

                        <div class="col-md-6">
                          <p style="margin-bottom:-10px; font-weight: bold;">In the last 14 days, did you have any of the following: fever, colds, cough, sore throat or difficulty in breating, diarrhea?</p>
                          {!! __form::select_static2(
                            '6', 'fever_colds', '', old('fever_colds') ? old('fever_colds') : optional($employee->employeeHealthDeclaration)->fever_colds , ['YES' => 'true', 'NO' => 'false'], $errors->has('fever_colds'), $errors->first('fever_colds'), '', ''
                          ) !!}
                        </div>

                        <div class="col-md-6">
                          <p style="margin-bottom:-10px;">If YES, pls. describe condition: </p>
                          {!! __form::textbox(
                           '12', 'fever_colds_yes_details', 'text', '', '', old('fever_colds_yes_details') ? old('fever_colds_yes_details') : optional($employee->employeeHealthDeclaration)->fever_colds_yes_details, $errors->has('fever_colds_yes_details'), $errors->first('fever_colds_yes_details'), ''
                        ) !!}
                        </div>
                      </div>
                    </div>


                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;">

                    </div>
                    <div class="form-group col-md-12 ">
                      <label for="family_doctor">Medical history</label>
                      <br>

                      <?php
                      $medical_histories_db = [];
                      if (!empty($employee->employeeMedicalHistories)){
                        foreach ($employee->employeeMedicalHistories as $key => $medical_history) {
                          $medical_histories_db[$medical_history['medical_history']] = $medical_history['medication'];
                        }

                      }
                      ?>
                      <select name="medical_histories[]" id="medical_history" class="form-control select2" multiple="multiple" style="width: 100%">
                        @foreach($medical_history_options as $option)
                          @if(isset($medical_histories_db[$option]))
                            <option value="{{$option}}" selected="">{{$option}}</option>
                          @else
                            <option value="{{$option}}">{{$option}}</option>
                          @endif
                        @endforeach

                      </select>

                      <div class="row">
                        <div class="col-md-12">
                          <br>
                          <table id="medical_history_table" class="table table-bordered table-striped">
                            <thead class="bg-info">
                              <tr>
                                <th>Medical Condition</th>
                                <th>Medication</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($medical_histories_db as $key => $medication_db)
                                <tr>
                                  <td>{{$key}}</td>
                                  <td>
                                    <input class="form-control input-sm" id="med_{{$key}}" name="medications[]" type="text" value="{{$medication_db}}" placeholder="Medication">
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12" style="border-top:solid 2px; padding-bottom:15px; color:gray;">

                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <label style="padding-left: 15px;"><i>SOCIAL HISTORY / CURRENT</i> </label>
                      <hr style="margin-bottom: 10px;margin-top: 0px;">

                      <div class="col-md-6">
                        <p style="margin-bottom:-10px; font-weight: bold;">1. Do you SMOKE/VAPE?</p>
                        {!! __form::select_static2(
                          '6', 'smoking', '', old('smoking') ? old('smoking') : optional($employee->employeeHealthDeclaration)->smoking, ['YES' => 'true', 'NO' => 'false'], $errors->has('smoking'), $errors->first('smoking'), '', ''
                        ) !!}
                      </div>

                      <div class="col-md-6">
                        <p style="margin-bottom:-10px;">If YES, number of packs per day: </p>
                        {!! __form::textbox(
                         '12', 'smoking_yes_details', 'text', '', '', old('smoking_yes_details') ? old('smoking_yes_details') : optional($employee->employeeHealthDeclaration)->smoking_yes_details, $errors->has('smoking_yes_details'), $errors->first('smoking_yes_details'), ''
                      ) !!}
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="col-md-6">
                        <p style="margin-bottom:-10px; font-weight: bold;">2. Do you DRINK ALCOHOL?</p>
                        {!! __form::select_static2(
                          '6', 'drinking', '', old('drinking') ? old('drinking') : optional($employee->employeeHealthDeclaration)->drinking , ['YES' => 'true', 'NO' => 'false'], $errors->has('drinking'), $errors->first('drinking'), '', ''
                        ) !!}
                      </div>

                      <div class="col-md-6">
                        <p style="margin-bottom:-10px;">If YES, how often? </p>
                        {!! __form::textbox(
                         '12', 'drinking_yes_details', 'text', '', '', old('drinking_yes_details') ? old('drinking_yes_details') : optional($employee->employeeHealthDeclaration)->drinking_yes_details, $errors->has('drinking_yes_details'), $errors->first('drinking_yes_details'), ''
                      ) !!}
                      </div>
                    </div>


                    <div class="col-md-12">
                      <div class="col-md-6">
                        <p style="margin-bottom:-10px; font-weight: bold;">3. Do you take prohibited DRUGS?</p>
                        {!! __form::select_static2(
                          '6', 'taking_drugs', '', old('taking_drugs') ? old('taking_drugs') : optional($employee->employeeHealthDeclaration)->taking_drugs , ['YES' => 'true', 'NO' => 'false'], $errors->has('taking_drugs'), $errors->first('taking_drugs'), '', ''
                        ) !!}
                      </div>

                      <div class="col-md-6">
                        <p style="margin-bottom:-10px;">If YES, specify: </p>
                        {!! __form::textbox(
                         '12', 'taking_drugs_yes_details', 'text', '', '', old('taking_drugs_yes_details') ? old('taking_drugs_yes_details') : optional($employee->employeeHealthDeclaration)->taking_drugs_yes_details, $errors->has('taking_drugs_yes_details'), $errors->first('taking_drugs_yes_details'), ''
                      ) !!}
                      </div>
                    </div>

                    <label style="padding-left:30px;"><i>HEALTH ROUTINES</i> </label>

                    <hr style="margin-bottom: 10px;margin-top: 0px;">



                    <div class="col-md-12">
                      <div class="col-md-6">
                        <p style="margin-bottom:-10px; font-weight: bold;">1. Do you take VITAMINS?</p>

                        {!! __form::select_static2(
                          '6', 'taking_vitamins', '', old('taking_vitamins') ? old('taking_vitamins') : optional($employee->employeeHealthDeclaration)->taking_vitamins , ['YES' => 'true', 'NO' => 'false'], $errors->has('taking_vitamins'), $errors->first('taking_vitamins'), '', ''
                        ) !!}
                      </div>

                      <div class="col-md-6">
                        <p style="margin-bottom:-10px;">If YES, specify: </p>
                        {!! __form::textbox(
                         '12', 'taking_vitamins_yes_details', 'text', '', '', old('taking_vitamins_yes_details') ? old('taking_vitamins_yes_details') : optional($employee->employeeHealthDeclaration)->taking_vitamins_yes_details, $errors->has('taking_vitamins_yes_details'), $errors->first('taking_vitamins_yes_details'), ''
                      ) !!}
                      </div>
                    </div>


                    <div class="col-md-12">
                      <div class="col-md-6">
                        <p style="margin-bottom:-10px; font-weight: bold;">2. Do you wear EYEGLASSES?</p>
                        {!! __form::select_static2(
                          '6', 'eyeglasses', '', old('eyeglasses') ? old('eyeglasses') : optional( $employee->employeeHealthDeclaration)->eyeglasses , ['YES' => 'true', 'NO' => 'false'], $errors->has('eyeglasses'), $errors->first('eyeglasses'), '', ''
                        ) !!}
                      </div>

                      <div class="col-md-6">
                        <p style="margin-bottom:-10px;">If YES, specify visual actuality: </p>
                        {!! __form::textbox(
                         '12', 'eyeglasses_yes_details', 'text', '', '', old('eyeglasses_yes_details') ? old('eyeglasses_yes_details') : optional($employee->employeeHealthDeclaration)->eyeglasses_yes_details, $errors->has('eyeglasses_yes_details'), $errors->first('eyeglasses_yes_details'), ''
                      ) !!}
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="col-md-6">
                        <p style="margin-bottom:-10px; font-weight: bold;">3. Do you do Physical Conditioning (Exercise)?</p>
                        {!! __form::select_static2(
                          '6', 'exercise', '', old('exercise') ? old('exercise') : optional($employee->employeeHealthDeclaration)->exercise , ['YES' => 'true', 'NO' => 'false'], $errors->has('exercise'), $errors->first('exercise'), '', ''
                        ) !!}
                      </div>

                      <div class="col-md-6">
                        <p style="margin-bottom:-10px;">If YES, how often? </p>
                        {!! __form::textbox(
                         '12', 'exercise_yes_details', 'text', '', '', old('exercise_yes_details') ? old('exercise_yes_details') : optional($employee->employeeHealthDeclaration)->exercise_yes_details, $errors->has('exercise_yes_details'), $errors->first('exercise_yes_details'), ''
                      ) !!}
                      </div>
                    </div>


                    <label style="padding-left: 30px;"><i>CURRENT MEDICAL CONDITION</i> </label>

                    <hr style="margin-bottom: 10px;margin-top: 0px;">

                    <div class="col-md-12">
                      <div class="col-md-6">
                        <p style="margin-bottom:-10px; font-weight: bold;">Are you currently being treated for any underlying medical conditions? <i>(ie. Diabetes, hypertension, cancer, COPD, etc.)</i></p>
                        {!! __form::select_static2(
                          '6', 'being_treated', '', old('being_treated') ? old('being_treated') : optional($employee->employeeHealthDeclaration)->being_treated , ['YES' => 'true', 'NO' => 'false'], $errors->has('being_treated'), $errors->first('being_treated'), '', ''
                        ) !!}
                      </div>

                      <div class="col-md-6">
                        <p style="margin-bottom:-10px;">If YES, specify: <i><b>(Name, dose and frequency of any medicines)</b></i> </p>
                        {!! __form::textbox(
                         '12', 'being_treated_yes_details', 'text', '', '', old('being_treated_yes_details') ? old('being_treated_yes_details') : optional($employee->employeeHealthDeclaration)->being_treated_yes_details, $errors->has('being_treated_yes_details'), $errors->first('being_treated_yes_details'), ''
                      ) !!}
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="col-md-6">

                        <p style="margin-bottom:-10px; font-weight: bold;">
                          Do you have any chronic illness or injuries that must be pointed out?
                        </p>
                        {!! __form::select_static2(
                          '6',
                          'chronic_injuries',
                          '',
                          old('chronic_injuries') ? old('chronic_injuries') : optional($employee->employeeHealthDeclaration)->chronic_injuries ,
                          ['YES' => 'true', 'NO' => 'false'],
                          $errors->has('chronic_injuries'),
                          $errors->first('chronic_injuries'),
                          '',
                          '') !!}
                      </div>

                      <div class="col-md-6">
                        <p style="margin-bottom:-10px;">If YES, specify: <i><b>(Give details of illness or injuries and their treatment details)</b></i> </p>
                        {!! __form::textbox(
                         '12', 'chronic_injuries_yes_details', 'text', '', '', old('chronic_injuries_yes_details') ? old('chronic_injuries_yes_details') : optional($employee->employeeHealthDeclaration)->chronic_injuries_yes_details, $errors->has('chronic_injuries_yes_details'), $errors->first('chronic_injuries_yes_details'), '') !!}
                      </div>
                    </div>

                  </div>


                </div>
              </div>

            </div>

          </div>

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">
            <i class="fa fa-check"></i> Save
          </button>
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
    @if(\Illuminate\Support\Facades\Request::get("page") != null)
      const page = '{{\Illuminate\Support\Facades\Request::get("page")}}';
    @else
      const page = 0;
    @endif
    $("#edit_employee_form").submit(function (e) {
      e.preventDefault();
      let form = $(this);
      loading_btn(form);
      $.ajax({
        url : '{{ route('dashboard.employee.update', $employee->slug) }}',
        data : form.serialize(),
        type: 'PUT',
        headers: {
          {!! __html::token_header() !!}
        },
        success: function (res) {
          unmark_required(form)
          form.get(0).reset();
          remove_loading_btn(form);
          markTabs(form);
          window.location.replace('{{route("dashboard.employee.index")}}?toPage='+page+'&mark='+res.slug);
        },
        error: function (res) {
          errored(form,res);
          markTabs(form);
        }
      })
    })


    {{-- Medical History --}}
    $(document).ready(function() {


      $("#medical_history").change(function(){
        medical_history_typed = [];

        $.each($(this).val(), function(i,item){
          medical_history_typed["med_"+item] = "";
        });

        $("#medical_history_table tbody input").each(function(){
            medical_history_typed[$(this).attr('id')] = $(this).val() ;
        });


        $("#medical_history_table tbody").html("");
        $.each($(this).val(), function(i,item){

          if(medical_history_typed["med_"+item] != ""){
            $("#medical_history_table tbody").append("<tr><td>"+item+"</td><td><input class='form-control input-sm' id='med_"+item+"' name='medications[]' type='text' value='"+medical_history_typed["med_"+item]+"' placeholder='Medication'></td></tr>");
          }else{
            $("#medical_history_table tbody").append("<tr><td>"+item+"</td><td><input class='form-control input-sm' id='med_"+item+"' name='medications[]' type='text' value='' placeholder='Medication'></td></tr>");
          }

        })
        // console.log(medical_history_typed);
      });


    });



    {{-- Children ADD ROW --}}
    $(document).ready(function() {

      $("#children_add_row").on("click", function() {
      var i = $("#children_table_body").children().length;
      var content ='<tr>' +

                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<input type="text" name="row_children[' + i + '][fullname]" class="form-control" placeholder="Fullname">' +
                        '</div>' +
                      '</td>' +

                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_children[' + i + '][date_of_birth]" type="text" class="form-control datepicker" placeholder="mm/dd/yy">' +
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




    {{-- Voluntary Works ADD ROW --}}
    $(document).ready(function() {

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
                            '<input name="row_vw[' + i + '][date_from]" type="date" class="form-control" placeholder="mm/dd/yy">' +
                          '</div>' +
                        '</div>' +
                      '</td>' +


                      '<td>' +
                        '<div class="form-group no-margin">' +
                          '<div class="input-group">' +
                            '<div class="input-group-addon">' +
                              '<i class="fa fa-calendar"></i>' +
                            '</div>' +
                            '<input name="row_vw[' + i + '][date_to]" type="date" class="form-control" placeholder="mm/dd/yy">' +
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