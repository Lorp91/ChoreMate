<?php

namespace App\Http\Controllers;

use App\Actions\Household\CreateHouseholdAction;
use App\Actions\Household\DeleteHouseholdAction;
use App\Actions\Household\UpdateHouseholdAction;
use App\Http\Requests\App\Household\StoreHouseHoldRequest;
use App\Http\Requests\UpdateHouseholdRequest;
use App\Models\Household;
use Illuminate\Support\Facades\Auth;

class HouseholdController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Household::class, 'household');
    }

    public function index()
    {
        $households = Auth::user()->households;

        return view('pages.households.index', compact('households'));
    }

    public function create()
    {
        return view('pages.households.create');
    }

    public function store(
        StoreHouseHoldRequest $request,
        CreateHouseholdAction $action
    ) {
        $action->handle($request->user(), $request->validated());

        return redirect()
            ->route('households.index')
            ->with('success', 'Haushalt wurde erfolgreich erstellt.');
    }

    public function show(Household $household)
    {
        return view('pages.dashboard.index', compact('household'));
    }

    public function edit(Household $household)
    {
        return view('pages.households.edit', compact('household'));
    }

    public function update(
        UpdateHouseholdRequest $request,
        Household $household,
        UpdateHouseholdAction $action
    ) {
        $household = $action->handle($household, $request->validated());

        return redirect()
            ->back()
            ->with('success', 'Haushalt wurde erfolgreich aktualisiert.');
    }

    public function destroy(
        Household $household,
        DeleteHouseholdAction $action
    ) {
        $action->handle($household);

        return redirect()
            ->route('households.index')
            ->with('success', 'Haushalt wurde erfolgreich entfernt.');
    }
}
