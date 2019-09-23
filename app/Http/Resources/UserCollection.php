<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{

    public $collects = 'App\Http\Resources\UserResource';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return [
        //     'success' => true,
        //     'data' => $this->collection,
        // ];
    
        return parent::toArray($request);
    }
}
