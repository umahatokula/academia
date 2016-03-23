<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class updateClassRequest extends Request
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
        'name'          => 'required', 
        'max_students'  => 'integer|required'
        ];
        // dd($this->request->get('subject'));

        if ($this->request->get('subject') !== null) {

            foreach($this->request->get('staff') as $key => $val)
            {
                $rules['staff.'.$key] = 'required|greater_than:0';
            }

            return false;
        }
          // dd($rules);
        return $rules;

    }
}
