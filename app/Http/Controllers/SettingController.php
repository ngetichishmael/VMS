<?php
namespace App\Http\Controllers;

use App\Models\Field;
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

        $fields = new Field();
        $fields->visitor_type = $request->input('visitor_type', 1);
        $fields->destination = $request->input('destination', 1);
        $fields->tag = $request->input('tag', 1);
        $fields->host = $request->input('host', 1);
        $fields->purpose_of_visit = $request->input('purpose_of_visit', 1);
        $fields->attachments = $request->input('attachments', 1);
        $fields->gender = $request->input('gender', 1);
        $fields->company = $request->input('company', 1);
        $fields->fingerprint = $request->input('fingerprint', 1);
        $fields->save();

        // Add data to settings table
        $settings = new Setting();
        $settings->fields_id = $fields->id;
        $settings->organization_code = $request->input('organization_code');
        $settings->id_checkin = $request->input('id_checkin', 0);
        $settings->automatic_id_checkin = $request->input('automatic_id_checkin', 0);
        $settings->sms_checkin = $request->input('sms_checkin', 0);
        $settings->ipass_checkin = $request->input('ipass_checkin', 0);
        $settings->returning_visitor = $request->input('returning_visitor', 0);
        $settings->save();


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
        $fields = Field::where('id', $organization_code->field_id)->first();
        return view('app.Settings.edit', compact('organization_code', 'fields'));
    }
    public function update(Request $request, $id)
    {

        $settings = Setting::findOrFail($id);

        $settings->id_checkin = $request->has('id_checkin') ? 1 : 0;
        $settings->automatic_id_checkin = $request->has('automatic_id_checkin') ? 1 : 0;
        $settings->sms_checkin = $request->has('sms_checkin') ? 1 : 0;
        $settings->ipass_checkin = $request->has('ipass_checkin') ? 1 : 0;
        $settings->returning_visitor = $request->has('returning_visitor') ? 1 : 0;
        $settings->save();

        $fields = Field::findOrFail($settings->field_id);
        $fields->visitor_type = $request->has('visitor_type') ? 1 : 0;
        $fields->destination = $request->has('destination') ? 1 : 0;
        $fields->tag = $request->has('tag') ? 1 : 0;
        $fields->host = $request->has('host') ? 1 : 0;
        $fields->purpose_of_visit = $request->has('purpose_of_visit') ? 1 : 0;
        $fields->attachments = $request->has('attachments') ? 1 : 0;
        $fields->gender = $request->has('gender') ? 1 : 0;
        $fields->company = $request->has('company') ? 1 : 0;
        $fields->fingerprint = $request->has('fingerprint') ? 1 : 0;
        $fields->save();

        return redirect()->route('OrganizationSetting')->with('success', 'Settings updated successfully');
    }
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('settings.index')->with('success', 'Setting deleted successfully.');
    }
}
