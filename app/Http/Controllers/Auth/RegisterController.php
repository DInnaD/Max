<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
//use App\Http\Controllers\Auth\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, UserRequest::rules());
          //  [           
        //     'email' =>  ['required', 'confirmed', 'email', 'unique:users', 'string'],
        //     'password'  =>  ['required', 'confirmed', 'string', ' min:6', 'max:20', 'confirmed'],
        //     'first_name'  =>  ['min:1', 'max:20', 'string'],
        //     'last_name' => ['min:1', 'max:40', 'string'],
        //     'country' => ['min:1', 'max:100', 'string'],
        //     'city' => ['min:1', 'max:100', 'string'],
        //     'phone' => ['min:1', 'max:30', 'string'],
           // 'role' => ['min:1', 'max:20', 'string'],//pivot
        
        //]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'country' => $data['country'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'role' => $data['role'],
            //'api_token' => Str::random(80),
        ]);
    }

    protected function registered($request, $user)
        {
            $user->generateToken();

            return response()->json(['data' => $user->toArray()], 201);
        }
}
