<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Organization;
use App\Vacancy;
use App\Filters\UserFilters;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

class UserController extends Controller
{   
    public function index(Request $request)
    {//not work I dont know why? HELP
        //$this->authorize(User::class);
        $search = $request->get('search');
        $users = User::where('first_name', 'LIKE', '%'.$search.'%')
            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
            ->orWhere('country', 'LIKE', '%'.$search.'%')
            ->orWhere('city', 'LIKE', '%'.$search.'%')
            ->get();
        return new UserCollection($users);
//         $users = \App\Http\Resources\UserCollection::make(User::paginate(10));
//         return response()->json(['success' => true, 'data' => $users], 200);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function indexStats(Request $request)
    {
       $this->authorize(User::class);
       $users = \App\Http\Resources\UserCollection::make(User::all());
       $worker = $users->filter(function ($value){
            return $value->role == 'worker';
       })->count();
       $employer = $users->filter(function ($value){
            return $value->role == 'employer';
       })->count();
       $admin = $users->filter(function ($value){
            return $value->role == 'admin';
       })->count();
        $user = collect(['worker' =>  $worker, 'employer' => $employer, 'admin' => $admin]);
        return response()->json(['success' => true, 'data' => $user], 200);
                
        
    }

    public function show(User $user, Vacancy $vacancy)
    {
       $this->authorize(User::class);
        return response()->json(['success' => true, 'data' => $user->load('vacancies')
        ], 200);
    }

    public function update(UserRequest $request, User $user)
    {
       $this->authorize(User::class);//alone

        $user->update($request->all());
        return response()->json($user);

    }

    public function destroy(UserRequest $request, User $user)
    {

       $this->authorize(User::class);
        return response()->json(['success' => $user->delete()], 200);
    }
}
