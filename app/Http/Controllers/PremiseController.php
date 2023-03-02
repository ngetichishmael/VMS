<?php

namespace App\Http\Controllers;

use App\Models\Premise;
use App\Http\Requests\UpdatePremiseRequest;
use App\Models\Activity;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PremiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $premises = DB::table('premises')
        // ->get();

        return view('livewire.premises.premise.layout');
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
     * @param  \App\Http\Requests\StorePremiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'location' => 'required',
            'address' => 'required',
            'organization_code' => 'required',



        ]);

        $premise = new Premise;

        $premise->name = $request->input('name');

        $premise->location = $request->input('location');

        $premise->address  = $request->input('address');

        $premise->organization_code  = $request->input('organization_code');

        $premise->description  = $request->input('description');

        $premise->save();
        Activity::create([
            'name' => $request->user()->name,
            'target' => "Premise created by " . $request->user()->name,
            'organization' => $premise->name,
            'activity' => "Created a new premise with " . $premise
        ]);

        return redirect()->to('/premise/information')->with('success', 'Premise added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function show(Premise $premise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function edit(Premise $premise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePremiseRequest  $request
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePremiseRequest $request, Premise $premise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Premise::find($id);
        $delete->delete();
        Toastr::success('Data deleted successfully :)', 'Success');
        return redirect()->route('PremiseInformation');
    }

    function status_update($id)
    {

        //get premise status with the help of  ID
        $premises = DB::table('premises')
            ->select('status')
            ->where('id', '=', $id)
            ->first();

        //Check user status
        if ($premises->status == '1') {
            $status = '0';
        } else {
            $status = '1';
        }

        //update premise status
        $values = array('status' => $status);
        DB::table('premises')->where('id', $id)->update($values);

        session()->flash('msg', 'Premise status has been updated successfully.');
        return redirect()->route('PremiseInformation');
    }
}
