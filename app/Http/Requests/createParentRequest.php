<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class createParentRequest extends Request
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
            'email'             => 'min:5|email|required',
            'phone'             => 'min:11|required',
            'address'           => 'required',
            'occupation'        => 'required',
            'gender_id'         => 'required',
            'country_id'        => 'required',
            'state_id'          => 'required',
            'local_id'          => 'required',
            'religion_id'       => 'required',
            'blood_group_id'    => 'required',
            'staff'             => 'required'
        ];
    }
}
