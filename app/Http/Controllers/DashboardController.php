<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Household;

class DashboardController extends Controller
{
    public function index(Household $household)
    {
        return view('pages.dashboard.index', compact('household'));
    }
}
