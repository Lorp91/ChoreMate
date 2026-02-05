<?php

namespace App\Http\Controllers;

use App\Models\Household;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $households = $user->households()->get();
        $currentHousehold = Household::find(session('household_id')) ?? $households->first();

        return view('app.dashboard', compact('households', 'currentHousehold'));
    }
}
