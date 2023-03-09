<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $devices = Device::all();
        return response()->json(['data' => $devices], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'name_of_address' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        //        $sentry = $request->user()->sentry;
        //        $premiseId = $sentry->premise_id;

        $device = new Device();
        $device->identifier = $request->input('identifier');
        $device->description = $request->input('description');
        $device->device_code = $request->input('device_code');
        $device->latitude = $request->input('latitude');
        $device->longitude = $request->input('longitude');
        $device->name_of_address = $request->input('name_of_address');
        $device->premise_id = $request->input('premise_id');
        $device->sentry_id = $request->user()->id;
        $device->save();

        Activity::create([
            'name' => $request->user()->name,
            'target' => "New device added by " . $request->user()->name,
            'organization' => 'Device' . $device->identifier,
            'activity' => "Created a new device with " . $device . '.'
        ]);
        return response()->json(['message' => 'Device created successful'], 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
