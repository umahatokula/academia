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
        $rules = [
            'name'          => 'required|unique:classes,name', 
            'max_students'  => 'integer|required'
        ];

          foreach($this->request->get('staff') as $key => $val)
          {
            $rules['staff.'.$key] = 'required|greater_than:0';
          }
          // dd($rules);
          return $rules;

    }



    public function messages()
    {
      $messages = [];
      foreach($this->request->get('staff') as $key => $val)
      {
        $messages['staff.'.$key.'.max'] = 'The field labeled "Subject '.$key.'" must be selected.';
      }
      return $messages;
    }



    public function all(){
        $attributes = parent::all();

        //remove spaces btw words in churcn name
        $name = preg_replace("/ {2,}/", " ", $attributes['name']);
        $attributes['name'] = $name;

        return $attributes;
    }
}
