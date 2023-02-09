<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Http\Requests\StoreBlockRequest;
use App\Http\Requests\UpdateBlockRequest;

use DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blocks = DB::table('blocks')

        ->join('premises', 'blocks.premise', '=', 'premises.id')
      
        ->select('blocks.*', 'premises.name')

        ->get();

        $premises = DB::table('premises')
        
        ->get();

        return view('livewire.premises.block.dashboard',compact('blocks','premises'));
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
     * @param  \App\Http\Requests\StoreBlockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'blockname' => 'required',
            'premise' => 'required',  
        ]);
        
        $block = new Block;
        $block->blockname = $request->blockname;
        $block->premise = $request->premise;
        $block->save();
          
        return redirect()->to('/block/information');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlockRequest  $request
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlockRequest $request, Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = block::find($id);

        $delete->delete();

        Toastr::success('Data deleted successfully :)','Success');

        return redirect()->route('BlockInformation');
    }

    public function status_update($id){

        //get block status with the help of  ID
        $blocks = DB::table('blocks')
                    ->select('status')
                    ->where('id','=',$id)
                    ->first();

        //Check block status
        if($blocks->status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        //update block status
        $values = array('status' => $status );
        DB::table('blocks')->where('id',$id)->update($values);

        session()->flash('msg','User status has been updated successfully.');
        return redirect()->route('BlockInformation');
    }
}