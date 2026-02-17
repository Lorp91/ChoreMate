<?php

namespace App\Http\Controllers\App;

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\Household\StoreHouseHoldRequest;
use App\Models\Household;
use App\Models\HouseholdMembership;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseholdController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $households = Auth::user()->households;

        return view('app.household.index', compact('households'));
    }

    public function create()
    {
        return view('app.household.create');
    }

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
            ->route('households.index')
            ->with('success', 'Haushalt wurde erfolgreich erstellt.');
    }

    public function show(Household $household)
    {
        $this->authorize('view', $household);

        return view('app.dashboard', compact('household'));
    }

    public function edit(Household $household)
    {
        $this->authorize('view', $household);

        return view('app.household.edit', compact('household'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Household $household)
    {
        $this->authorize('manage', $household);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $household->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Haushalt wurde erfolgreich aktualisiert.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Household $household)
    {
        $this->authorize('manage', $household);

        $household->delete();

        return redirect()
            ->route('households.index')
            ->with('success', 'Haushalt wurde erfolgreich entfernt.');
    }
}
