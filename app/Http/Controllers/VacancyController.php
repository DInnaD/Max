<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Organization;
use App\Vacancy;
use Illuminate\Http\Request;
use App\Http\Requests\VacancyRequest;
use App\Http\Requests\BookRequest;
use App\Http\Resources\VacancyCollection;
use App\Http\Resources\VacancyResource;
use App\Http\Resources\UserResource;

class VacancyController extends Controller
{   
    public function book(BookRequest $request)
    {
        //$this->authorize('book', Vacancy::class);
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
        $vacancy->workers()->attach($userId);
        return response()->json([
            'succes' => true,
        ], 200);
    }
    
    public function unbook(BookRequest $request)
    {
            //$this->authorize('unbook', Vacancy::class);
            $vacancyId = $request->get('vacancy_id');
            $userId = $request->post('user_id');
            $vacancy = Vacancy::find($vacancyId);
            $vacancy->workers()->detach($userId);

            return response()->json(['success' => true], 200);
       
    }

    public function indexStats(Request $request)
    {
            $this->authorize('indexStats', Vacancy::class);
            $vacancies = \App\Http\Resources\VacancyCollection::make(Vacancy::all());
            $all = $vacancies->count();
            $closed = $vacancies->filter(function ($value){
                return $value->workers_booked > $value->workers_amount;
            })->count();
            $active = $all - $closed;
            $vacancy = collect(['active' =>  $active, 'closed' => $closed, 'all' => $all]);
            return response()->json(['success' => true, 'data ' => $vacancy], 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', Vacancy::class);
        $only_active = $request->input('only_active');
        $vacancies = \App\Http\Resources\VacancyCollection::make(Vacancy::all());
        $vacancies = $vacancies->filter(function ($value) use ($only_active) {
            if ($only_active != false) {
                if ($value->workers_booked < $value->workers_amount) {
                    return $value;
                }
            } else {
                return $value;
            }
        }); 
        return response()->json([ 'success' => true, 'data ' => $vacancies], 200);//make($vacancies)
    
      
        
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacancyRequest $request)
    {
        $this->authorize('store', Vacancy::class);
        $vacancy = Vacancy::create($request->all());
        return response()->json([ 'success' => true, 'data' => $vacancy], 201);
        
    }
     
    
    public function show(Vacancy $vacancy, Organization $organization, User $user)
    {
        
        // $this->authorize('show', Vacancy::class);
        $vacancy->load(['workers']);
        $vacancy->workers_booked = count($vacancy->workers()->get());
        
        return new VacancyResource($vacancy);
        // return response()->json(['success' => true, 
        // 'data' => $vacancy->load('organization')->load('workers'),
        // ], 200);
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VacancyRequest $request, Vacancy $vacancy)
    {
        $this->authorize('update', Vacancy::class);
        $vacancy->update($request->all());
        return response()->json(['success' => true, 'data' => $vacancy], 200);
        
    }//call to undef user() but work after added to workers()  'id' + add VacancyRequest
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Vacancy $vacancy)
    {
        
        $this->authorize('delete', Vacancy::class);
        $vacancy->delete();
        return response()->json(null, 200);
        
    }
    
    public function setOrganization($id, $organization_id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $organization = Organization::findOrFail($organization_id);
        $organization->vacancies()->save($vacancy);
        return response()->json($vacancy->load('organization'), 200);
    }




}
