<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeFormRequest extends FormRequest{



    
    public function authorize(){

        return true;
    
    }
    



    public function rules(){
        
//        $rows_children = $this->request->get('row_children');
//        $rows_eb = $this->request->all()['row_eb'];
//        $rows_training = $this->request->get('row_training');
//        $rows_eligibility = $this->request->get('row_eligibility');
//        $rows_we = $this->request->get('row_we');
//        $rows_vw = $this->request->get('row_vw');
//        $rows_recognition = $this->request->get('row_recognition');
//        $rows_org = $this->request->get('row_org');
//        $rows_ss = $this->request->get('row_ss');
//        $rows_reference = $this->request->get('row_reference');

        $rules = [
            
            // Personal Info
            'lastname'=>'required|string|max:90',
            'firstname'=>'required|string|max:90',
            'middlename'=>'nullable|string|max:90',
            'name_ext'=>'nullable|string|max:11',
            'date_of_birth' => 'required|date_format:"Y-m-d"',
            'place_of_birth'=>'nullable|string|max:255',
            'sex'=>'required|string|max:20',
            'civil_status'=>'required|string|max:45',
            'height'=>'nullable|string|max:20',
            'weight'=>'nullable|string|max:20',
            'blood_type'=>'nullable|string|max:11',
            'tel_no'=>'nullable|string|max:20',
            'cell_no'=>'nullable|string|max:20',
            'email'=>'nullable|email|max:90',
            'citizenship'=>'nullable|string|max:20',
            'citizenship_type'=>'nullable|string|max:20',
            'dual_citizenship_country'=>'nullable|string|max:90',
            'agency_no'=>'nullable|string|max:20',
            'gov_id'=>'nullable|string|max:20',
            'license_passport_no'=>'nullable|string|max:20',
            'id_date_issue'=>'nullable|string|max:45',
            'station' => 'required|string',

            // Address
            'res_address_block'=>'nullable|string|max:90',
            'res_address_street'=>'nullable|string|max:90',
            'res_address_village'=>'nullable|string|max:90',
            'res_address_barangay'=>'nullable|string|max:90',
            'res_address_city'=>'nullable|string|max:90',
            'res_address_province'=>'nullable|string|max:90',
            'res_address_zipcode'=>'nullable|string|max:20',
            'perm_address_block'=>'nullable|string|max:90',
            'perm_address_street'=>'nullable|string|max:90',
            'perm_address_village'=>'nullable|string|max:90',
            'perm_address_barangay'=>'nullable|string|max:90',
            'perm_address_city'=>'nullable|string|max:90',
            'perm_address_province'=>'nullable|string|max:90',
            'perm_address_zipcode'=>'nullable|string|max:20',


            // Family Info
            'father_lastname'=>'nullable|string|max:90',
            'father_firstname'=>'nullable|string|max:90',
            'father_middlename'=>'nullable|string|max:90',
            'father_name_ext'=>'nullable|string|max:11',
            'mother_lastname'=>'nullable|string|max:90',
            'mother_firstname'=>'nullable|string|max:90',
            'mother_middlename'=>'nullable|string|max:90',
            'mother_name_ext'=>'nullable|string|max:11',
            'spouse_lastname'=>'nullable|string|max:90',
            'spouse_firstname'=>'nullable|string|max:90',
            'spouse_middlename'=>'nullable|string|max:90',
            'spouse_name_ext'=>'nullable|string|max:11',
            'spouse_occupation'=>'nullable|string|max:90',
            'spouse_employer'=>'nullable|string|max:255',
            'spouse_business_address'=>'nullable|string|max:255',
            'spouse_tel_no'=>'nullable|string|max:45',


            // Personal ID's
            'gsis'=>'nullable|string|max:20',
            'philhealth'=>'nullable|string|max:20',
            'tin'=>'nullable|string|max:20',
            'sss'=>'nullable|string|max:20',
            'hdmf'=>'nullable|string|max:20',
            'hdmfpremiums'=>'nullable|string|max:13',


            // Appointment Status
            'employee_no'=> [
                'required',
                'string',
                'max:20',
                Rule::unique('hr_employees','employee_no')->ignore($this->slug,'slug'),
            ],
            'position'=>'required|string|max:90',
            'item_no'=>'nullable|int|max:10000',
            'appointment_status'=>'nullable|string|max:45',
            'salary_grade'=>'nullable|int',
            'step_inc'=>'nullable|int',
            'department_id'=>'nullable|string|max:11',
            'department_unit_id'=>'nullable|string|max:11',
            'monthly_basic'=>'nullable|string|max:13',
            'aca'=>'nullable|string|max:13',
            'pera'=>'nullable|string|max:13',
            'food_subsidy'=>'nullable|string|max:13',
            'ra'=>'nullable|string|max:13',
            'ta'=>'nullable|string|max:13',
            'firstday_gov' => 'nullable|date_format:"Y-m-d"',
            'firstday_sra' => 'nullable|date_format:"Y-m-d"',
            'appointment_date' => 'nullable|date_format:"Y-m-d"',
            'adjustment_date' => 'nullable|date_format:"Y-m-d"',
            'project_id' => 'nullable|string|max:11',
            'is_active' => 'required|string|max:11',
            'locations' => 'required|string',
            'assignment' => 'required|string',

            // Questions
            'q_34_a'=>'nullable|string|max:11',
            'q_34_b'=>'nullable|string|max:11',
            'q_34_b_yes_details'=>'nullable|string|max:255',
            'q_35_a'=>'nullable|string|max:11',
            'q_35_a_yes_details'=>'nullable|string|max:255',
            'q_35_b'=>'nullable|string|max:11',
            'q_35_b_yes_details_1'=>'nullable|string|max:255',
            'q_35_b_yes_details_2'=>'nullable|string|max:255',
            'q_36'=>'nullable|string|max:11',
            'q_36_yes_details'=>'nullable|string|max:255',
            'q_37'=>'nullable|string|max:11',
            'q_37_yes_details'=>'nullable|string|max:255',
            'q_38_a'=>'nullable|string|max:11',
            'q_38_a_yes_details'=>'nullable|string|max:255',
            'q_38_b'=>'nullable|string|max:11',
            'q_38_b_yes_details' => 'nullable|string|max:255',
            'q_39' => 'nullable|string|max:11',
            'q_39_yes_details' => 'nullable|string|max:255',
            'q_40_a' => 'nullable|string|max:11',
            'q_40_a_yes_details' => 'nullable|string|max:255',
            'q_40_b' => 'nullable|string|max:11',
            'q_40_b_yes_details' => 'nullable|string|max:255',
            'q_40_c' => 'nullable|string|max:11',
            'q_40_c_yes_details' => 'nullable|string|max:255',


            //Health Declaration

            'family_doctor' => 'nullable|string|max:45',
            'contact_person' => 'nullable|string|max:45',
            'contact_person_phone' => 'nullable|string|max:45',
            'cities_ecq' => 'nullable|string|max:150',
            'been_sick' => 'nullable|string|max:20',
            'been_sick_yes_details' => 'nullable|string|max:45',
            'fever_colds' => 'nullable|string|max:20',
            'fever_colds_yes_details' => 'nullable|string|max:45',
            'smoking' => 'nullable|string|max:20',
            'smoking_yes_details' => 'nullable|string|max:45',
            'drinking' => 'nullable|string|max:20',
            'drinking_yes_details' => 'nullable|string|max:45',
            'taking_drugs' => 'nullable|string|max:20',
            'taking_drugs_yes_details' => 'nullable|string|max:45',
            'taking_vitamins' => 'nullable|string|max:20',
            'taking_vitamins_yes_details' => 'nullable|string|max:45',
            'eyeglasses' => 'nullable|string|max:20',
            'eyeglasses_yes_details' => 'nullable|string|max:45',
            'exercise' => 'nullable|string|max:20',
            'exercise_yes_details' => 'nullable|string|max:45',
            'being_treated' => 'nullable|string|max:20',
            'being_treated_yes_details' => 'nullable|string|max:45',
            'chronic_injuries' => 'nullable|string|max:20',
            'chronic_injuries_yes_details' => 'nullable|string|max:45',

        ];


        // Children
//        if(!empty($rows_children)){
//            foreach($rows_children as $key => $value){
//                $rules['row_children.'.$key.'.fullname'] = 'nullable|string|max:255';
//                $rules['row_children.'.$key.'.date_of_birth'] = 'nullable|date_format:"m/d/Y"';
//            }
//        }


        // Educational background
//        if(!empty($rows_eb)){
//            foreach($rows_eb as $key => $value){
//                $rules['row_eb.'.$key.'.level'] = 'nullable|string|max:90';
//                $rules['row_eb.'.$key.'.school_name'] = 'nullable|string|max:255';
//                $rules['row_eb.'.$key.'.course'] = 'nullable|string|max:90';
//                $rules['row_eb.'.$key.'.date_from'] = 'nullable|string|max:45';
//                $rules['row_eb.'.$key.'.date_to'] = 'nullable|string|max:45';
//                $rules['row_eb.'.$key.'.units'] = 'nullable|numeric';
//                $rules['row_eb.'.$key.'.graduate_year'] = 'nullable|string|max:45';
//                $rules['row_eb.'.$key.'.scholarship'] = 'nullable|string|max:90';
//            }
//        }


        // Eligibility
//        if(!empty($rows_eligibility)){
//            foreach($rows_eligibility as $key => $value){
//                $rules['row_eligibility.'.$key.'.eligibility'] = 'nullable|string|max:250';
//                $rules['row_eligibility.'.$key.'.level'] = 'nullable|string|max:20';
//                $rules['row_eligibility.'.$key.'.rating'] = 'nullable|numeric';
//                $rules['row_eligibility.'.$key.'.exam_place'] = 'nullable|string|max:255';
//                $rules['row_eligibility.'.$key.'.exam_date'] = 'nullable|date_format:"m/d/Y"';
//                $rules['row_eligibility.'.$key.'.license_no'] = 'nullable|string|max:90';
//                $rules['row_eligibility.'.$key.'.license_validity'] = 'nullable|string|max:255';
//            }
//        }


        // Work Experience
        /*if(!empty($rows_we)){
            foreach($rows_we as $key => $value){   
                $rules['row_we.'.$key.'.date_from'] = 'nullable|date_format:"m/d/Y"';
                $rules['row_we.'.$key.'.date_to'] = 'nullable|date_format:"m/d/Y"';
                $rules['row_we.'.$key.'.company'] = 'nullable|string|max:255';
                $rules['row_we.'.$key.'.position'] = 'nullable|string|max:90';
                $rules['row_we.'.$key.'.salary'] = 'nullable|string|max:13';
                $rules['row_we.'.$key.'.salary_grade'] = 'nullable|int';
                $rules['row_we.'.$key.'.appointment_status'] = 'nullable|string|max:45';
                $rules['row_we.'.$key.'.is_gov_service'] = 'nullable|string|max:11';
            } 
        }*/


        // Voluntary Works
        /*if(!empty($rows_vw)){
            foreach($rows_vw as $key => $value){   
                $rules['row_vw.'.$key.'.name'] = 'nullable|string|max:255';
                $rules['row_vw.'.$key.'.address'] = 'nullable|string|max:255';
                $rules['row_vw.'.$key.'.date_from'] = 'nullable|date_format:"m/d/Y"';
                $rules['row_vw.'.$key.'.date_to'] = 'nullable|date_format:"m/d/Y"';
                $rules['row_vw.'.$key.'.hours'] = 'nullable|numeric';
                $rules['row_vw.'.$key.'.position'] = 'nullable|string|max:90';
            } 
        }*/


        // Recognition
        /*if(!empty($rows_recognition)){
            foreach($rows_recognition as $key => $value){   
                $rules['row_recognition.'.$key.'.title'] = 'nullable|string|max:255';
            } 
        }*/


        // Organizations
        /*if(!empty($rows_org)){
            foreach($rows_org as $key => $value){   
                $rules['row_org.'.$key.'.name'] = 'nullable|string|max:255';
            } 
        }*/


        // Special Skills
        /*if(!empty($rows_ss)){
            foreach($rows_ss as $key => $value){   
                $rules['row_ss.'.$key.'.description'] = 'nullable|string|max:255';
            } 
        }*/


        // Voluntary Works
        /*if(!empty($rows_reference)){
            foreach($rows_reference as $key => $value){   
                $rules['row_reference.'.$key.'.fullname'] = 'nullable|string|max:255';
                $rules['row_reference.'.$key.'.address'] = 'nullable|string|max:255';
                $rules['row_reference.'.$key.'.tel_no'] = 'nullable|string|max:20';
            } 
        }*/


        return $rules;
    
    }





}
