<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Organization;
use App\Vacancy;
use Illuminate\Http\Request;
use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\UserResource;

class OrganizationController extends Controller
{   
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $this->authorize('index', Organization::class);
        $organizations = \App\Http\Resources\OrganizationCollection::make(Organization::all());
        
        return new OrganizationCollection($organizations);
    }

    public function indexStats(Request $request)
    {
        //$this->authorize('indexStats', Organization::class);
        $organization = Organization::getOrganizationList($request);
        
        return response()->json(['success' => true, 'data' => $organization], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationRequest $request)
    {
        //$this->authorize('store', Organization::class);
        $organization = Organization::create($request->all());
        
        return new OrganizationResource($organization);
        
    }

    
    /**
     * Display the specified resource.
     *
     * TODO: $id -> $organization
     *
     * @param  Organization  $organization
     * @param Vacancy $vacany
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Organization $organization)
    {
        //$this->authorize('show', Organization::class);
        $_vacancies = $request->get('vacancies');
        $_workers = $request->get('workers');
        $organization = $organization->load(['creator', 'vacancies' => function ($query) {
            $query->withCount(['workers AS workers_booked'])->get();
        }]);
        $organization->vacancies->each(function ($value){
            if($value->workers_booked >= $value->workers_amount){
                $value->status = 'closed';
            }else{
                $value->status = 'active';
            }
        });
        $organization->_vacancies = $_vacancies;
        if (isset($_vacancies) and $_vacancies != 0) {
            $vacancies = $organization->vacancies;
            foreach ($vacancies as $key => $vacancy) {
                if ($_vacancies == 1) {
                    if ($vacancy->workers_amount <= $vacancy->workers_booked) {
                        unset($vacancies[$key]);
                    }
                } elseif ($_vacancies == 2) {
                    if ($vacancy->workers_amount > $vacancy->workers_booked) {
                        unset($vacancies[$key]);
                    }
                } elseif ($_vacancies == 3) {
                    if ($vacancy->workers_amount <= $vacancy->workers_booked || $vacancy->workers_amount > $vacancy->workers_booked) {
                        unset($vacancies[$key]);
                    }
                }
            }
            if ($_workers == 1) {
                $workers = [];
                foreach ($organization->vacancies as $vacancy) {
                    array_push($workers, $vacancy->workers);
                    unset($vacancy['workers']);
                }
                $organization->workers = collect($workers)->collapse()->all();
            }
        } else {
            unset($organization['vacancies']);
        }
        return new OrganizationResource($organization);
    
     }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationRequest $request, Organization $organization)
    {
        //$this->authorize('update', Organization::class);
        $organization->update($request->all());
        
        return new OrganizationResource($organization);
        
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //$this->authorize('delete', Organization::class);
        $organization->delete();
        
        return new OrganizationResource($organization);
        
    }


    public function setCreator($id, $creator_id)
    {
        $organization = Organization::findOrFail($id);
        $creator = Creator::findOrFail($creator_id);
        $creator->organizations()->save($organization);
        return response()->json($organization->load('organization'), 200);
    }
}
