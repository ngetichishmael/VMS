<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;


class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = DB::table('organizations')
        ->get();

         return view('livewire.organization.dashboard',compact('organizations'));
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
     * @param  \App\Http\Requests\StoreOrganizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'org_name' => 'required',
            'email' => 'required|email',

        ]);
        
       
        $organization = Organization::create([
            'org_name' => $request->org_name,
            'email' => $request->email,
        ]);
     
        
        return redirect()->to('/organization/information');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrganizationRequest  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $delete = Organization::find($id);
        $delete->delete();
        Toastr::success('Data deleted successfully :)','Success');
        return redirect()->route('OrganizationInformation');
    }

    public function search(Request $request){
        
        $output = "";

        $organizations=DB::table('organizations')->where('org_name','LIKE','%'.$request->search."%")

        ->orWhere('email','LIKE','%'.$request->search."%")
       
        ->get();
        
        foreach($organizations as $organizations)
        {
            $output.= 
            '
            <tr>
            <td>'.$organizations ->id.'</td>
            <td>'.$organizations ->org_name.'</td>
            <td>'.$organizations ->email.'</td>
            <td>'.$organizations ->created_at.'</td>
          
            td> '.'
                <a href="" class=""style="padding-right:20px">'.' <i class="fas fa-pen-nib"></i> </a>

            '.' </td>
            </tr>
            ';
        }

        return response($output);
     
    }
}