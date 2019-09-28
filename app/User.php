<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, Softdeletes;
    
    /******* Properties *******/
    
    protected $fillable = [ 
        'email', 
        'password',
        'first_name',
        'last_name',
        'country',
        'city',
        'phone',
        'role',
    ];
    
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'deleted_at', 'pivot'
    ];
    
    /******* Relations *******/
    
    public function vacancies()
        {
        return $this->belongsToMany(Vacancy::class);
        }

    public function organization()
        {
        return $this->hasOne(Organization::class, 'creator_id');
        } 

    public function generateToken()
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }
    
    /******* Getters *******/
    
    public static function getSearchList(Request $request)
    {
        $search = $request->get('search');        
        $search = $search ? '%' . $search . '%' : null;
       
        return User::where('first_name', 'LIKE', '%'.$search.'%')
            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
            ->orWhere('country', 'LIKE', '%'.$search.'%')
            ->orWhere('city', 'LIKE', '%'.$search.'%')->get();
    }
    
    
    
}
