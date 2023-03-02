<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Http\Requests\UpdateResidentRequest;
use App\Models\Activity;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('livewire.premises.resident.layout');
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
     * @param  \App\Http\Requests\StoreResidentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|min:2',

            'email' => 'required|email|max:255|unique:organizations,email',

            'phone_number' => 'required|numeric',
        ]);

        $resident = new Resident;

        $resident->name = $request->input('name');

        $resident->email = $request->input('email');

        $resident->phone_number = $request->input('phone_number');

        $resident->unit_id = $request->input('unit_id');

        $resident->save();

        Activity::create([
            'name' => $request->user()->name,
            'target' => "Resident created by " . $request->user()->name,
            'organization' => $resident->name,
            'activity' => "Created a new resident with " . $resident
        ]);

        return redirect()->to('/resident/information')->with('success', 'Resident Created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function show(Resident $resident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function edit(Resident $resident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResidentRequest  $request
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResidentRequest $request, Resident $resident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resident  $resident
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = resident::find($id);

        $delete->delete();

        Toastr::success('Data deleted successfully :)', 'Success');

        return redirect()->route('ResidentInformation');
    }

    public function status_update($id)
    {

        //get resident status with the help of  ID
        $residents = DB::table('residents')
            ->select('status')
            ->where('id', '=', $id)
            ->first();

        //Check unit status
        if ($residents->status == '1') {
            $status = '0';
        } else {
            $status = '1';
        }

        //update unit status
        $values = array('status' => $status);
        DB::table('residents')->where('id', $id)->update($values);

        session()->flash('msg', 'User status has been updated successfully.');
        return redirect()->route('ResidentInformation');
    }
}
