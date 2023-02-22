<?php

namespace App\Http\Controllers;

use App\Models\Sentry;
use App\Http\Requests\StoreSentryRequest;
use App\Http\Requests\UpdateSentryRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

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
            'name' => 'required',
            'id_number' => 'required',
            'email' => 'required',
            'shift' => 'required',

        ]);

        $sentry = new Sentry;
        $sentry->sname = $request->sname;
        $sentry->id_number = $request->id_number;
        $sentry->email = $request->email;
        $sentry->zone = $request->zone;
        $sentry->save();

        return redirect()->to('users/sentries');
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
