<?php


namespace App\Http\Requests\Holiday;


use App\Swep\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class HolidayFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'holiday_name' => 'required|string|max:255',
            'date' => 'required|date',
//            'type' => 'required|string|max:255|in:'.Helper::implode_assoc(Helper::holiday_types()),
        ];
    }
}