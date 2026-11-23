<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Category;

class PlanController extends Controller
{
    public function index(Request $request)
    {
        $query = Plan::with('category');

        if ($request->filled('search')) {
            $query->where('activity_name', 'like', '%' . $request->search . '%')
                  ->orWhere('target_city', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $plans = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        $totalPlans = Plan::count();
        $completedPlans = Plan::where('status', 'Completed')->count();
        $pendingPlans = Plan::where('status', 'Pending')->count();
        $productivityRate = $totalPlans > 0 ? round(($completedPlans / $totalPlans) * 100) : 0;

        return view('plans.index', compact(
            'plans', 
            'categories', 
            'totalPlans', 
            'completedPlans', 
            'pendingPlans', 
            'productivityRate'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required',
            'target_city'   => 'required',
            'activity_date' => 'required|date',
            'start_time'    => 'required',
            'end_time'      => 'required',
            'category_id'   => 'required|exists:categories,id',
        ]);

        Plan::create([
            'activity_name' => $request->activity_name,
            'target_city'   => $request->target_city,
            'activity_date' => $request->activity_date,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'status'        => 'Pending',
            'category_id'   => $request->category_id,
        ]);

        return redirect('/plans');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $categories = Category::all();
        return view('plans.edit', compact('plan', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'activity_name' => 'required',
            'target_city'   => 'required',
            'activity_date' => 'required|date',
            'start_time'    => 'required',
            'end_time'      => 'required',
            'status'        => 'required',
            'category_id'   => 'required|exists:categories,id',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update([
            'activity_name' => $request->activity_name,
            'target_city'   => $request->target_city,
            'activity_date' => $request->activity_date,
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'status'        => $request->status,
            'category_id'   => $request->category_id,
        ]);

        return redirect('/plans');
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return redirect('/plans');
    }
    public function toggleStatus($id)
{
    $plan = Plan::findOrFail($id);
    
    // Jika statusnya sekarang Completed, ubah jadi Pending. Sebaliknya, ubah jadi Completed.
    $plan->status = ($plan->status == 'Completed') ? 'Pending' : 'Completed';
    $plan->save();

    return redirect('/plans');
}
}