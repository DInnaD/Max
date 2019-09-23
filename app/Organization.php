<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Organization extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //protected $dates = ['deleted_at'];
    protected $hidden = [
        'api_token', 'deleted_at', 'pivot'
    ];
    protected $fillable = [ 
        'title', 
        'country',
        'city',
        'creator_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

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


}
