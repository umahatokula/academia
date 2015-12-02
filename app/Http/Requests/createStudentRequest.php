<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class createStudentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fname'             => 'min:2|string|required',
            'lname'             => 'min:2|string|required',
            'parent_id'         => 'integer|required',
            'class_id'          => 'integer|required',
            'address'           => 'required',
            'dob'               => 'required',
            'gender_id'         => 'integer|required',
            'country_id'        => 'integer|required',
            'state_id'          => 'integer|required',
            'local_id'          => 'integer|required',
            'religion_id'       => 'integer|required',
            'blood_group_id'    => 'integer|required'
        ];
    }



    // public function all(){
    //     $arrtributes = parent::all();

    //     unset($arrtributes['_token']);

    //     return $arrtributes;
    // }

}
