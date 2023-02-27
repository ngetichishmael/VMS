<?php

namespace App\Http\Controllers;

use App\Models\Sentry;
use App\Http\Requests\StoreSentryRequest;
use App\Http\Requests\UpdateSentryRequest;

<<<<<<< HEAD
=======
use App\Models\User;
>>>>>>> 8c7a9faf66b96512ff6ea24d02ff15ab51b23525

use Brian2694\Toastr\Facades\Toastr;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [

            'name' => 'required|min:2',

            'premise_id' => 'required',

            'shift_id' => 'required',

            'phone_number' => 'required',

        ]);

<<<<<<< HEAD

=======
>>>>>>> 8c7a9faf66b96512ff6ea24d02ff15ab51b23525
        Sentry::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'status' => 1,
            'device_id' => $request->device_id ?? 1,
            'user_detail_id' => $request->user_detail_id ?? null,
            'shift_id' => $request->shift_id,
            'premise_id' => $request->premise_id
        ]);
<<<<<<< HEAD
=======


        $sentry = new Sentry;
        $sentry->sname = $request->sname;
        $sentry->id_number = $request->id_number;
        $sentry->email = $request->email;
        $sentry->zone = $request->zone;
        $sentry->save();
         $user =  new User;
>>>>>>> 8c7a9faf66b96512ff6ea24d02ff15ab51b23525


        User::create([
            'name' => $request->input('name'),
            'password' => Hash::make(Str::random(20)),
            'email' => Str::uuid(),
            'phone_number' => $request->input('phone_number'),
            'status' => 1,
            'organization_code' => Str::uuid(),
            'role_id' => 4,
            'email_verified_at' => now()
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
    public function edit(Sentry $sentry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSentryRequest  $request
     * @param  \App\Models\Sentry  $sentry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSentryRequest $request, Sentry $sentry)
    {
        //
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
