<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\DriveIn;
use App\Models\Organization;
use App\Models\TimeLog;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class ActivityController extends Controller
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 25;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.activity.layout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        $activity = Activity::whereId($id)->first();
//        $activities=Activity::where('name',$activity->name )->get()->paginate($this->perPage);
//        $organization = Organization::where('code', $activity->organization)->first();
//        return view('livewire.activity.view',compact('activity', 'activities','organization'));
//    }

    public function show($id)
    {
        $activity = Activity::whereId($id)->first();
        $activities = Activity::where('name', $activity->name)->paginate($this->perPage);
        $organization = Organization::where('code', $activity->organization)->first();
        return view('livewire.activity.view', compact('activity', 'activities', 'organization'));
    }
        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
