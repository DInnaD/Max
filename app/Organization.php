<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
/**
* @property  int creator_id
*/

class Organization extends Model
{
    use SoftDeletes;
    
     /******* Properties *******/

    protected $hidden = [
        'api_token', 'deleted_at', 'pivot'
    ];
    protected $fillable = [ 
        'title', 
        'country',
        'city',
        'creator_id'
    ];
    
     /******* Relations *******/

    public function creator()
    {
    	return $this->belongsTo(User::class, 'creator_id');
    }

    public function vacancies()
    {
    	return $this->hasMany('App\Vacancy');
    }
    public function workers()
    {
        return $this->hasManyThrough('App\User' ,'App\Vacancy');
    }

     /******* Static Functions *******/

    public static function getOrganizationList(Request $request)
    {
        $organizations = \App\Http\Resources\UserCollection::make(User::all());
        $all = $organizations->count();
        $active = count($organizations->where('deleted_at', '=', null)->all());
        $softDelete = $all - $active;
        return $organization = collect(['active' =>  $active, 'softDelete' => $softDelete, 'all' => $all]);
    }
}
