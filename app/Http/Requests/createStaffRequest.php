<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class createStaffRequest extends Request
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
            'email'             => 'email|required|min:5',
            'staff_type_id'     => 'integer|required',
            'phone'             => 'min:11|required',
            'address'           => 'required',
            'gender_id'         => 'integer|required',
            'gender_id'         => 'integer|required',
            'country_id'        => 'integer|required',
            'state_id'          => 'integer|required',
            'local_id'          => 'integer|required'
        ];
    }

    
}
