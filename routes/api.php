<?php

use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
	Route::middleware('auth:api')->get('/user', function (Request $request) {
	    return $request->user();
	});

	Route::post('register', 'Auth\RegisterController@register');
	Route::post('login', 'Auth\LoginController@login');


	Route::middleware('auth:api')->group(function () {
	
    Route::post('vacancy-book', 'VacancyController@book');
    Route::post('vacancy-unbook', 'VacancyController@unbook');
	Route::get('vacancy/{vacancy_id}/{organization_id}', 'VacancyController@setOrganization');
    Route::get('stats/vacancy', 'VacancyController@indexStats'); //
	Route::apiResource('/vacancy', 'VacancyController');


	Route::get('organization/{id}/{creator_id}', 'OrganizationController@setCreator');
    Route::get('stats/organization', 'OrganizationController@indexStats');//
	Route::apiResource('/organization', 'OrganizationController');

    Route::get('stats/user', 'UserController@indexStats');// 
	Route::apiResource('user', 'UserController');

	Route::get('logout', 'Auth\LoginController@logout');

	

// 	let jsonData = pm.response.json();
// pm.environment.set("token", jsonData.data.api_token);

});


