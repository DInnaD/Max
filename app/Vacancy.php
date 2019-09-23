<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{ 
    //use SostDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

   // protected $dates = ['deleted_at'];
    protected $hidden = [
        'api_token', 'deleted_at', 'pivot'
    ];
    protected $fillable = [ 
        'vacancy_name',           
        'workers_amount',
        'organization_id',
        'salary',
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'workers_booked' => 'boolean',
        'status' => 'string',
    ];
    
    protected $appends = [
        'status',
        'workers_booked',
         ];

    
    public function workers()
    {
    	return $this->belongsToMany('App\User', 'user_vacancy', 'user_id', 'vacancy_id');
    }

     public function organization()
    {
    	return $this->belongsTo('App\Organization');
    }

    public function getWorkersBookedAttribute()
    { 
        

            $workers_booked = $this->workers()->count();
        
        
            return $workers_booked;
       
    }

    public function getStatusAttribute()
    {
        if($this->workers_booked >= $this->workers_amount){
            return 'closed';
        }
        return 'active';
        
    }
    
}
     