<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return view('app.Settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'organization_code' => 'required',
            'id_checkin' => 'required|boolean',
            'automatic_id_checkin' => 'required|boolean',
            'sms_checkin' => 'required|boolean',
            'ipass_checkin' => 'required|boolean',
        ]);

        Setting::create($validatedData);

        return redirect()->route('settings.index')->with('success', 'Setting settings created successfully.');
    }

    public function show(Setting $setting)
    {
        return view('settings.show', compact('setting'));
    }


    public function edit($setting)
    {
//        return response()->json(['success' =>$setting ]);
        $organization_code = Setting::where('organization_code', $setting)->firstOrFail();
        return view('app.Settings.edit', compact('organization_code'));
    }

//    public function update(Request $request, Setting $setting)
//    {
//        $validatedData = $request->validate([
//            'organization_code' => 'required',
//            'id_checkin' => 'required|boolean',
//            'automatic_id_checkin' => 'required|boolean',
//            'sms_checkin' => 'required|boolean',
//            'ipass_checkin' => 'required|boolean',
//        ]);
//
//        $setting->update($validatedData);
//
//        $van_sales = $request->van_sales == null ? "NO" : "YES";
//        $new_sales = $request->new_sales == null ? "NO" : "YES";
//        $deliveries = $request->deliveries == null ? "NO" : "YES";
//        $schedule_visits = $request->schedule_visits == null ? "NO" : "YES";
//        $merchanizing = $request->merchanizing == null ? "NO" : "YES";
//        AppPermission::updateOrCreate(
//            [
////                "organization_code" => $organization_code,
//            ],
//            [
//                "van_sales" => $van_sales,
//                "new_sales" => $new_sales,
//                "schedule_visits" => $schedule_visits,
//                "deliveries" => $deliveries,
//                "merchanizing" => $merchanizing,
//            ]
//        );
//
//        Session()->flash('success', 'User updated Successfully');
//
//        return redirect()->back();
////        return redirect()->route('settings.index')->with('success', 'Setting updated successfully.');
//    }
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $setting->id_checkin = $request->has('id_checkin');
        $setting->ipass_checkin = $request->has('ipass_checkin');
        $setting->automatic_id_checkin = $request->has('automatic_checkin');
        $setting->sms_checkin = $request->has('sms_checkin');

        $setting->save();
        return redirect()->route('OrganizationSetting')->with('success', 'Settings updated successfully');
    }
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('settings.index')->with('success', 'Setting deleted successfully.');
    }
}
