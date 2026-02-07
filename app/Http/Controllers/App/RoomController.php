<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Household;
use App\Models\Room;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Household $household)
    {
        $this->authorize('view', $household);

        $rooms = $household->rooms;

        return view('app.room.index', compact('household', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Household $household)
    {
        $this->authorize('manage', $household);

        return view('app.room.create', compact('household'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Household $household)
    {
        $this->authorize('manage', $household);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Room::create([
            'name' => $request->name,
            'household_id' => $household->id,
        ]);

        return redirect()
            ->route('households.rooms.index', compact('household'))
            ->with('success', 'Raum erfolgreich erstellt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Household $household, Room $room)
    {
        $this->authorize('view', $household);

        return view('app.room.show', compact('household', 'room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Household $household, Room $room)
    {
        $this->authorize('manage', $household);

        return view('app.room.edit', compact('household', 'room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Household $household, Room $room)
    {
        $this->authorize('manage', $household);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $room->update([
            'name' => $request->name,
            'household_id' => $household->id,
        ]);

        return redirect()
            ->route('households.rooms.index', compact('household'))
            ->with('success', 'Raum erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Household $household, Room $room)
    {
        $this->authorize('manage', $household);

        $room->delete();

        return redirect()
            ->route('households.rooms.index', compact('household'))
            ->with('success', 'Raum erfolgreich entfernt.');
    }
}
