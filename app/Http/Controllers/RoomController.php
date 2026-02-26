<?php

namespace App\Http\Controllers;

use App\Actions\Room\CreateRoomAction;
use App\Actions\Room\DeleteRoomAction;
use App\Actions\Room\UpdateRoomAction;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Models\Household;
use App\Models\Room;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoomController extends Controller
{
    use AuthorizesRequests;

    /**
     * Show the form for creating a new resource.
     */
    public function create(Household $household)
    {
        return view('pages.rooms.create', compact('household'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreRoomRequest $request,
        Household $household,
        CreateRoomAction $action
    ) {
        $room = $action->handle($request->validated(), $household);

        return view('pages.rooms.show', compact('household', 'room'))
            ->with('success', 'Raum erfolgreich erstellt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $household = Household::with('rooms.tasks.room')
            ->firstOrFail();

        $room = $household->rooms->firstWhere('id', $room->id);

        return view('pages.rooms.show', [
            'household' => $household,
            'room' => $room,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('pages.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateRoomRequest $request,
        Room $room,
        UpdateRoomAction $action
    ) {
        $action->handle($room, $request->validated());

        $household = $room->household;

        return view('pages.rooms.show', compact('household', 'room'))
            ->with('success', 'Raum erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Room $room,
        DeleteRoomAction $action
    ) {
        $action->handle($room);

        $household = $room->household;

        return redirect()
            ->route('dashboard', compact('household'))
            ->with('success', 'Raum erfolgreich entfernt.');
    }
}
