<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{ /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

public function rules()
    {


        
        return [
            'user_id'  =>  'required|min:1|max:32|integer|exists:users,id', 
            'vacancy_id'  =>  'required|min:1|max:32|integer|exists:vacancies,id', 
        ];
    }
  
}
