<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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

public function rules()//only store udate book unbook
    {
        
        return [
            'status' => 'min:1|max:32|string',
            'vacancy_name'  =>  'required|min:1|max:32|string',
            'workers_amount' => 'min:1|max:2147483647|integer',             
            'workers_booked' => 'min:1|max:2147483647|integer',
            'salary' => 'min:1|max:2147483647|integer',
            'user_id' => 'bigInteger'
        ];
    }
    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'status' => 'Position Status',
            'vacancy_name'  =>  'Position Name',           
            'workers_amount' => 'Position Number Of Emploees',
            'workers_booked' => 'Position Booked',
            'organization_id' => 'Creator Company',
            'salary' => 'Position Salary',
            'user_id' => 'Of User'
        ];
    }

   
 
}
