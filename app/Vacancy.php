<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{ 
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

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
    
    public static function getVacancyList(Request $request)
    {
        $vacancies = Vacancy::all();
        $all = $vacancies->count();
        $closed = $vacancies->filter(function ($value){
            return $value->workers_booked > $value->workers_amount;
        })->count();
        $active = $all - $closed;
        $vacancy = collect(['active' =>  $active, 'closed' => $closed, 'all' => $all]);
        
        return $vacancy;
            
    }   

    public static function getIndexList(Request $request)
    {
        $only_active = $request->input('only_active');
        $vacancies = \App\Http\Resources\VacancyCollection::make(Vacancy::all());
        
        return $vacancies = $vacancies->filter(function ($value) use ($only_active) {
            if ($only_active != false) {
                if ($value->workers_booked < $value->workers_amount) {
                    return $value;
                }
            } else {
                return $value;
            }
        });
    }

    public static function getBook(Request $request)
    {
        $id = \Auth::user()->id;
        $vacancyId = $request->post('vacancy_id');
        $userId = $request->post('user_id');
        $vacancy = Vacancy::find($vacancyId);
        $users = $vacancy->workers;
        foreach ($users as $user){
            if($user->id == $id){
                return response()->json(['success' => false, 'error' => 'User Booked!'], 200);
            }
        }
        return $vacancy->workers()->attach($userId);
    }

    public static function getUnbook(Request $request)
    {
        $vacancyId = $request->get('vacancy_id');
        $userId = $request->post('user_id');
        $vacancy = Vacancy::find($vacancyId);
        return $vacancy->workers()->detach($userId);
    }
    
}
     
