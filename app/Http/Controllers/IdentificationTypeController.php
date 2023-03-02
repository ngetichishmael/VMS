<?php

namespace App\Http\Controllers;

use App\Models\IdentificationType;
use App\Http\Requests\StoreIdentificationTypeRequest;
use App\Http\Requests\UpdateIdentificationTypeRequest;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IdentificationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.identification-type.layout');
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
     * @param  \App\Http\Requests\StoreIdentificationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
    
        ]);     
        $identity = new IdentificationType;

        $identity->name = $request->input('name');

        $identity->save();
        
        return redirect()->to('/identification/type')->with('success','Indentity Type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function show(IdentificationType $identificationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $type = IdentificationType::find($id);

        return view('livewire.identification-type.edit', compact('type'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIdentificationTypeRequest  $request
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
          
        $type = IdentificationType::find($id);

        $type->name = $request->input('name');

        $type->save();

        return redirect()->to('/identification/type')->with('success','Identification Type Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationType $identificationType)
    {
        //
    }
}
