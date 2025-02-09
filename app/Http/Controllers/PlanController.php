<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('welcome', compact('plans'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:plans',
        ]);

        Plan::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Plan added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('plans.edit', compact('plan'));
    }

    // Update the plan
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:plans,name,' . $id,
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update([
            'name' => $request->name,
        ]);

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully!');
    }

    // Delete a plan
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->back()->with('success', 'Plan deleted successfully!');
    }
}
