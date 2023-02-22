<?php
namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();

        return view('app.Subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        return view('subscriptions.create');
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

        Subscription::create($validatedData);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully.');
    }

    public function show(Subscription $subscription)
    {
        return view('subscriptions.show', compact('subscription'));
    }

    public function edit(Subscription $subscription)
    {
        return view('subscriptions.edit', compact('subscription'));
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validatedData = $request->validate([
            'organization_code' => 'required',
            'id_checkin' => 'required|boolean',
            'automatic_id_checkin' => 'required|boolean',
            'sms_checkin' => 'required|boolean',
            'ipass_checkin' => 'required|boolean',
        ]);

        $subscription->update($validatedData);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }
}
