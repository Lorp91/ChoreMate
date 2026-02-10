<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Household;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Household $household)
    {
        return view('app.dashboard', compact('household'));
    }
}
