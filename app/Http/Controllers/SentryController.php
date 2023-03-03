<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Sentry;

use Brian2694\Toastr\Facades\Toastr;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Premise;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SentryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.sentry.layout');
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
     * @param  \App\Http\Requests\StoreSentryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate(request(), [

            'name' => 'required|min:2',

            'premise_id' => 'required',

            'shift_id' => 'required',

            'phone_number' => 'required',

        ]);
        $org_code=Premise::where('id',  $request->input('premise_id'))->first();
        $organization=Organization::where('code', $org_code->organization_code)->first();
        Sentry::create([
            'name' => $request->name,

            'phone_number' => $request->phone_number,

            'status' => 1,

            'device_id' => $request->device_id ?? 0,

            'user_detail_id' => $request->user_detail_id ?? null,

            'shift_id' => $request->shift_id,

            'premise_id' => $request->premise_id,

        ]);


        User::create([

            'name' => $request->input('name'),

            'email' => $organization->email ?? $request->input('name'),
            'phone_number' => $request->phone_number,

            'organization_code' =>$org_code->organization_code,

            'role_id' => 4,

            'email_verified_at' => now(),

            'password' => Hash::make(Str::random(20)),
        ]);

        Activity::create([
            'name' => $request->user()->name,
            'target' => "Guard creation",
            'organization' => $request->user()->organization_code,
            'activity' => "Created a new guard with name" . $request->name .
                " and phone number " . $request->phone_number . "."
        ]);
        return redirect()->to('users/sentries')->with('success', 'Sentry added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sentry  $sentry
     * @return \Illuminate\Http\Response
     */
    public function show(Sentry $sentry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sentry  $sentry
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sentry = Sentry::find($id);

        $premises = Premise::where('status', 1)->get();

        $shifts = Shift::where('status', 1)->get();

        return view('livewire.sentry.edit', compact('sentry', 'premises', 'shifts'));


        // return view('livewire.sentry.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSentryRequest  $request
     * @param  \App\Models\Sentry  $sentry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sentry = Sentry::find($id);

        $sentry->name = $request->input('name');

        $sentry->phone_number = $request->input('phone_number');

        $sentry->premise_id  = $request->input('premise_id');

        $sentry->shift_id  = $request->input('shift_id');

        $sentry->device_id  = $request->input('device_id') ?? 0;

        $sentry->save();

        return redirect()->to('/users/sentries')->with('success', 'Sentry Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sentry  $sentry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Sentry::find($id);

        $delete->delete();

        Toastr::success('Data deleted successfully :)', 'Success');

        return redirect()->route('Sentry');
    }

    public function status_update($id)
    {

        //get unit status with the help of  ID
        $sentries = DB::table('sentries')
            ->select('status')
            ->where('id', '=', $id)
            ->first();

        //Check unit status
        if ($sentries->status == '1') {
            $status = '0';
        } else {
            $status = '1';
        }

        //update unit status
        $values = array('status' => $status);
        DB::table('sentries')->where('id', $id)->update($values);

        session()->flash('msg', 'User status has been updated successfully.');
        return redirect()->route('Sentry');
    }
}
