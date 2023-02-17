<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Http\Requests\StoreServiceCategoryRequest;
use App\Http\Requests\UpdateServiceCategoryRequest;

use DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.service.catergory.layout');
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
     * @param  \App\Http\Requests\StoreServiceCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'cname' => 'required',
           
        ]);
        
        $serviceCategory = new ServiceCategory;
        $serviceCategory->cname = $request->cname;
     
        $serviceCategory->save();
          
        return redirect()->to('/service/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceCategoryRequest  $request
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceCategoryRequest $request, ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = ServiceCategory::find($id);

        $delete->delete();

        Toastr::success('Data deleted successfully :)','Success');

        return redirect()->route('ServiceCategory');
    }

    public function status_update($id){

        //get unit status with the help of  ID
        $categories = DB::table('service_categories')
                    ->select('status')
                    ->where('id','=',$id)
                    ->first();

        //Check unit status
        if($categories->status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }

        //update unit status
        $values = array('status' => $status );
        DB::table('service_categories')->where('id',$id)->update($values);

        session()->flash('msg','User status has been updated successfully.');
        return redirect()->route('ServiceCategory');
    }
}