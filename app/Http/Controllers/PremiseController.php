<?php

namespace App\Http\Controllers;

use App\Models\Premise;
use App\Http\Requests\StorePremiseRequest;
use App\Http\Requests\UpdatePremiseRequest;

use DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
        $this->validate(request(), [
            'name' => 'required',

        ]);

        $premise = Premise::create([
            'name' => $request->name,
            
        ]);
        return redirect()->to('/premise/information');
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
        Toastr::success('Data deleted successfully :)','Success');
        return redirect()->route('PremiseInformation');
    }

    function status_update($id){

        //get premise status with the help of  ID
        $premises = DB::table('premises')
                    ->select('status')
                    ->where('id','=',$id)
                    ->first();

        //Check user status
        if($premises->status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        //update premise status
        $values = array('status' => $status );
        DB::table('premises')->where('id',$id)->update($values);

        session()->flash('msg','Premise status has been updated successfully.');
        return redirect()->route('PremiseInformation');
    }
}