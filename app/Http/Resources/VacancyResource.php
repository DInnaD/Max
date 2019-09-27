<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'success' => true,
        ];
    }
    
    public function toArray($request)
    {
        return [
            'id' => $this->id,  
            'status' => $this->status,
            'vacancy_name'  => $this->vacancy_name,       
            'workers_amount' => $this->workers_amount,
            'workers_booked' => $this->workers_booked,
            'salary' => $this->salary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'workers' => $this->workers,
        ];
        
        
    }
}
