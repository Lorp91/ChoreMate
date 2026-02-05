<?php

namespace App\Http\Controllers\Auth;

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegisterRequest;
use App\Models\Household;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(StoreRegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $household = Household::create([
            'name' => 'Zuhause',
        ]);

        $household->users()->attach($user->id, [
            'role' => HouseholdRole::OWNER->label(),
            'status' => MembershipStatus::ACTIVE->label(),
        ]);

        session(['current_household_id' => $household->id]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
