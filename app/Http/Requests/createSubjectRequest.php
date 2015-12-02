<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class createSubjectRequest extends Request
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
            'subject' => 'required|min:2'
        ];
    }


    public function all(){
        $attributes = parent::all();

        $attributes['status_id'] = 1;

        return $attributes;
    }
}
