<?php

namespace App\Http\Controllers\Household;

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Household\StoreHouseHoldRequest;
use App\Models\Household;
use App\Models\HouseholdMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseholdController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHouseHoldRequest $request)
    {
        $household = Household::create([
            'name' => $request->name,
        ]);

        HouseholdMembership::create([
            'user_id' => Auth::id(),
            'household_id' => $household->id,
            'role' => HouseholdRole::OWNER->label(),
            'status' => MembershipStatus::ACTIVE->label(),
        ]);

        session(['current_household_id' => $household->id]);

        return redirect()
            ->back()
            ->with('success', 'Haushalt wurde erfolgreich erstellt.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Household $household)
    {
        dd($request->all());
        // isOwner checken
        // input validieren
        // household update
        // redirect
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Household $household)
    {
        $isOwner = $household->owner()
            ->whereKey(Auth::id())
            ->exists();

        abort_unless($isOwner, 403);

        $household->delete();

        return redirect()
            ->back()
            ->with('success', 'Haushalt wurde erfolgreich entfernt.');
    }

    public function switch(Request $request)
    {
        $request->validate([
            'household_id' => ['required', 'integer', 'exists:households,id'],
        ]);

        $householdId = $request->household_id;

        $household = Household::findOrFail($householdId);

        if (! $household->users()->where('user_id', Auth::id())->exists()) {
            abort(403, 'Du bist kein Mitglied dieses Haushaltes');
        }

        session(['current_household_id' => $household->id]);

        return redirect()->back();
    }
}
