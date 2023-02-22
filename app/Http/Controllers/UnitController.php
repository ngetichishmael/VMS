<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;

use DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $units = DB::table('units')

        // ->get();

        // $units = DB::table('units')

        // ->join('premises', 'units.premise', '=', 'premises.id')

        // ->join('blocks', 'units.block', '=', 'blocks.id')
      
        // ->select('units.*', 'premises.name', 'blocks.blockname')

        // ->get();

        // $premises = DB::table('premises')

        // ->get();

        // $blocks = DB::table('blocks')

        // ->get();

        return view('livewire.premises.unit.layout');
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
     * @param  \App\Http\Requests\StoreUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'unitname' => 'required',
            'block' => 'required',
            'premise' => 'required',  
        ]);
        
        $unit = new Unit;
        $unit->unitname = $request->unitname;
        $unit->block = $request->block;
        $unit->premise = $request->premise;
        $unit->save();
          
        return redirect()->to('/unit/information');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitRequest  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = unit::find($id);

        $delete->delete();

        Toastr::success('Data deleted successfully :)','Success');

        return redirect()->route('BlockInformation');
    }

    public function status_update($id){

        //get unit status with the help of  ID
        $units = DB::table('units')
                    ->select('status')
                    ->where('id','=',$id)
                    ->first();

        //Check unit status
        if($units->status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        //update unit status
        $values = array('status' => $status );
        DB::table('units')->where('id',$id)->update($values);

        session()->flash('msg','User status has been updated successfully.');
        return redirect()->route('UnitInformation');
    }

}