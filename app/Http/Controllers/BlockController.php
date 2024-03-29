<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Http\Requests\UpdateBlockRequest;
use App\Models\Activity;
use App\Models\Premise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $blocks = DB::table('blocks')

        //     ->join('premises', 'blocks.premise', '=', 'premises.id')

        //     ->select('blocks.*', 'premises.name')

        //     ->get();

        // $premises = DB::table('premises')

        //     ->get();

        return view('livewire.premises.block.layout');
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:blocks,name',
            'premise_id' => 'required',


        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        $block = new Block;

        $block->name = $request->input('name');

        $block->premise_id  = $request->input('premise_id');

        $block->save();

        $premise = Premise::whereId($request->premise_id)->first();
        Activity::create([
            'name' => $request->user()->name,
            'target' => "Block created by " . $request->user()->name,
            'organization' => $request->user()->organization_code,
            'activity' => "Created a new block name" . $request->name .
                " for premise " . $premise->name . "."
        ]);

        return redirect()->to('/block/information')->with('success', 'Block added successfully.');
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
    public function edit($id)
    {

        $block = Block::find($id);

        $premise = Premise::where('status', 1) ->get();

        return view('livewire.premises.block.edit', compact('premise','block'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlockRequest  $request
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
          
        $block = Block::find($id);

        $block->name = $request->input('name');

        $block->premise_id  = $request->input('premise_id'); 

        $block->save();

        return redirect()->to('/block/information')->with('success','Block Updated successfully.');
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

        // Toastr::success('Data deleted successfully :)', 'Success');

        return redirect()->route('BlockInformation');
    }

    public function status_update($id)
    {

        //get block status with the help of  ID
        $blocks = DB::table('blocks')
            ->select('status')
            ->where('id', '=', $id)
            ->first();

        //Check block status
        if ($blocks->status == '1') {
            $status = '0';
        } else {
            $status = '1';
        }

        //update block status
        $values = array('status' => $status);
        DB::table('blocks')->where('id', $id)->update($values);

        session()->flash('msg', 'User status has been updated successfully.');
        return redirect()->route('BlockInformation');
    }
}
