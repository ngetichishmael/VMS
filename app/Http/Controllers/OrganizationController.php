<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

       return view('livewire.organization.layout');

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrganizationRequest $request)
    {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email|max:255|unique:organizations,email',
    //         'phone'=> 'required|numeric',
    //         'location' => 'required',


    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }
    //     $code = Str::random(20);
    //     $organization = new organization;
    //     $organization->code = $code;
    //     $organization->name = $request->input('name');
    //     $organization->location = $request->input('location');
    //     $organization->email = $request->input('email');
    //     $organization->primary_phone  = $request->input('phone');
    //     $organization->secondary_phone  = $request->input('phone2');
    //     $organization->websiteUrl  = $request->input('url');
    //     $organization->description = $request->input('description');
    //     $organization->save();
        
    //     session()->flash('message', 'Post successfully updated.');
    //    // return response()->json(['success' => 'organization information added successfully.'], 201);
    return redirect()->route('OrganizationInformation');
 
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
        Toastr::success('Data deleted successfully :)', 'Success');
        return redirect()->route('OrganizationInformation');
    }

    function status_update($id)
    {

        //get organization status with the help of  ID
        $organizations = DB::table('organizations')
            ->select('status')
            ->where('id', '=', $id)
            ->first();

        //Check user status
        if ($organizations->status == '1') {
            $status = '0';
        } else {
            $status = '1';
        }

        //update organization status
        $values = array('status' => $status);
        DB::table('organizations')->where('id', $id)->update($values);

        session()->flash('msg', 'Organization status has been updated successfully.');
        return redirect()->route('OrganizationInformation');
    }

    public function search(Request $request)
    {

        $output = "";

        $organizations = DB::table('organizations')->where('org_name', 'LIKE', '%' . $request->search . "%")

            ->orWhere('email', 'LIKE', '%' . $request->search . "%")

            ->get();

        foreach ($organizations as $organizations) {
            $output .=
                '
            <tr>
            <td>' . $organizations->id . '</td>
            <td>' . $organizations->org_name . '</td>
            <td>' . $organizations->email . '</td>
            <td>' . $organizations->created_at . '</td>

            td> ' . '
                <a href="" class=""style="padding-right:20px">' . ' <i class="fas fa-pen-nib"></i> </a>

            ' . ' </td>
            </tr>
            ';
        }

        return response($output);
    }

}
