<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class createClassRequest extends Request
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
            'name'          => 'required|unique:classes,name', 
            'max_students'  => 'integer|required'
        ];
    }

    public function all(){
        $attributes = parent::all();

        //remove spaces btw words in churcn name
        $name = preg_replace("/ {2,}/", " ", $attributes['name']);
        $attributes['name'] = $name;

        return $attributes;
    }
}
