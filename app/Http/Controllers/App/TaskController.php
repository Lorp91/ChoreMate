<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Task\StoreTaskRequest;
use App\Http\Requests\App\Task\UpdateTaskRequest;
use App\Models\Household;
use App\Models\Room;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Household $household, Room $room)
    {
        $this->authorize('view', $household);

        return view('app.task.create', compact('household', 'room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, Household $household, Room $room)
    {
        $room->tasks()->create($request->validated());

        return redirect()
            ->route('households.rooms.show', compact('household', 'room'))
            ->with('success', 'Aufgabe erfolgreich erstellt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Household $household, Room $room, Task $task)
    {
        $this->authorize('view', $household);

        return view('app.task.show', compact('household', 'room', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Household $household, Room $room, Task $task)
    {
        $this->authorize('manage', $household);

        return view('app.task.edit', compact('household', 'room', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Household $household, Room $room, Task $task)
    {
        $task->update($request->validated());

        return redirect()
            ->route('households.rooms.show', compact('household', 'room'))
            ->with('success', 'Aufgabe erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Household $household, Room $room, Task $task)
    {
        $this->authorize('manage', $household);

        $task->delete();

        return redirect()
            ->route('households.rooms.show', compact('household', 'room'))
            ->with('success', 'Aufgabe erfolgreich geloescht.');
    }

    public function complete(Household $household, Room $room, Task $task)
    {
        $this->authorize('view', $household);

        $task->complete(Auth::user());

        return redirect()->back()->with('success', 'Aufgabe erfolgreich abgeschlossen.');
    }
}
