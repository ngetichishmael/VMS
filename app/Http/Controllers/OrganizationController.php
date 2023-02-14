<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;


class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'org_name' => 'required',
            'email' => 'required|email',

        ]);

        // $this->validate(request(), [
        //     'org_name' => 'required',
        //     'email' => 'required|email',
        //     'code' => 'required',
        // ]);


        $id = IdGenerator::generate(['table' => 'organizations', 'length' => 6, 'prefix' => '1']);
        do {

            $code = random_int(100000, 999999);
        } while (organization::where("code", "=", $code)->first());

        $organization = new organization;
        $organization->org_name = $request->org_name;
        $organization->code      = $code;
        $organization->email    = $request->email;
        $organization->save();

        // $organization = Organization::create([
        //     'org_name' => $request->org_name,
        //     'code' => $request->code,
        //     'email' => $request->email,

        // ]);


        return redirect()->to('/organization/information');
    }

    public function generateUniqueCode()

    {

        do {

            $code = random_int(100000, 999999);
        } while (organization::where("code", "=", $code)->first());



        return $code;
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
