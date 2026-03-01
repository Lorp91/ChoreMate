<?php

namespace App\Http\Controllers;

use App\Actions\Task\CreateTaskAction;
use App\Actions\Task\DeleteTaskAction;
use App\Actions\Task\UpdateTaskAction;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Household;
use App\Models\Room;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use AuthorizesRequests;

    /**
     * Show the form for creating a new resource.
     */
    public function create(Household $household, Room $room)
    {
        return view('pages.tasks.create', compact('household', 'room'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreTaskRequest $request,
        Household $household,
        Room $room,
        CreateTaskAction $action
    ) {
        $action->handle($room, $request->validated());

        return redirect()
            ->route('rooms.show', compact('household', 'room'))
            ->with('success', 'Aufgabe erfolgreich erstellt.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('pages.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateTaskRequest $request,
        Task $task,
        UpdateTaskAction $action
    ) {
        $action->handle($task, $request->validated());

        $room = $task->room;

        return redirect()
            ->route('rooms.show', compact('room'))
            ->with('success', 'Aufgabe erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Household $household,
        Task $task,
        DeleteTaskAction $action
    ) {
        $action->handle($task);

        $room = $task->room;

        return redirect()
            ->route('rooms.show', compact('room'))
            ->with('success', 'Aufgabe erfolgreich geloescht.');
    }

    public function complete(Task $task)
    {
        $this->authorize('view', $task);

        $task->complete(Auth::user());

        return redirect()->back()->with('success', 'Aufgabe erfolgreich abgeschlossen.');
    }
}
