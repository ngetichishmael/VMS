<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Block;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Activity;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:units,name',
            'block_id' => 'required',

        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        $unit = new Unit();

        $unit->name = $request->input('name');

        $unit->block_id  = $request->input('block_id');

        $unit->save();
        Activity::create([
            'name' => $request->user()->name,
            'target' => "Unit created by " . $request->user()->name,
            'organization' => 'Unit' . $unit->name,
            'activity' => "Created a new resident with " . $unit
        ]);
        return redirect()->to('/unit/information')->with('success', 'Unit added successfully.');
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
    public function edit($id)
    {

        $unit = Unit::find($id);

        $block = Block::where('status', 1) ->get();

        return view('livewire.premises.unit.edit', compact('unit','block'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitRequest  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
          
        $unit = Unit::find($id);

    
        $unit->name = $request->input('name');
        
        $unit->block_id  = $request->input('block_id');

        $unit->save();

        return redirect()->to('/unit/information')->with('success','Unit Updated successfully.');
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

        Toastr::success('Data deleted successfully :)', 'Success');

        return redirect()->route('BlockInformation');
    }

    public function status_update($id)
    {

        //get unit status with the help of  ID
        $units = DB::table('units')
            ->select('status')
            ->where('id', '=', $id)
            ->first();

        //Check unit status
        if ($units->status == '1') {
            $status = '0';
        } else {
            $status = '1';
        }

        //update unit status
        $values = array('status' => $status);
        DB::table('units')->where('id', $id)->update($values);

        session()->flash('msg', 'User status has been updated successfully.');
        return redirect()->route('UnitInformation');
    }
}
