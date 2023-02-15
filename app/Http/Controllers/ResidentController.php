<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\UpdateResidentRequest;

use DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $residents = DB::table('residents')

        ->join('blocks', 'residents.block', '=', 'blocks.id')
      
        ->join('premises', 'blocks.premise', '=', 'premises.id')

        ->select('residents.*', 'blocks.blockname', 'premises.name')

        ->get();

        $premises = DB::table('premises')

        ->get();

        $blocks = DB::table('blocks')

        ->get();


        return view('livewire.premises.resident.dashboard',compact('residents', 'premises', 'blocks'));
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
            'rname' => 'required',
            'block' => 'required',
            'premise' => 'required',  
        ]);
        
        $resident = new Resident;
        $resident->rname = $request->rname;
        $resident->block = $request->block;
        $resident->premise = $request->premise;
        $resident->save();
          
        return redirect()->to('/resident/information');
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

        Toastr::success('Data deleted successfully :)','Success');

        return redirect()->route('ResidentInformation');
    }

    public function status_update($id){

        //get resident status with the help of  ID
        $residents = DB::table('residents')
                    ->select('status')
                    ->where('id','=',$id)
                    ->first();

        //Check unit status
        if($residents->status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        //update unit status
        $values = array('status' => $status );
        DB::table('residents')->where('id',$id)->update($values);

        session()->flash('msg','User status has been updated successfully.');
        return redirect()->route('ResidentInformation');
    }

}