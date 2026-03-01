<x-layout.app title="{{ $room->name }}">
    <div class="right-4 bottom-4 z-50 fixed flex flex-row-reverse items-center gap-3">
        <a href="{{ route('households.rooms.tasks.create', [$household, $room]) }}" class="btn btn-success">+ Aufgabe
            erstellen</a>
        <a href="{{ route('rooms.edit', $room) }}" class="btn btn-info">Raum bearbeiten</a>
    </div>
    <div class="space-y-2 bg-base-300 p-4 rounded-2xl">
        {{-- $todayTasks erstellen --}}
        <h2 class="text-2xl">Heute</h2>
        @foreach ($tasks_today as $task)
            <x-task.card :task="$task" />
        @endforeach
    </div>
    <div class="space-y-2 bg-base-200 mt-5 p-4 rounded-2xl">
        {{-- sortieren und anzeigen --}}
        <h2 class="text-2xl">Alle Aufgaben</h2>
        @foreach ($tasks_future as $task)
            <x-task.card :task="$task" />
        @endforeach
    </div>

    {{-- <ul class="space-y-4 w-2xl">
        @foreach ($room->tasks as $task)
            <li>
                <div class="flex justify-between items-center gap-5 w-full">
                    <a href="{{ route('tasks.show', $task) }}">{{ $task->title }}
                        , {{ $task->due_date }}</a>
                    <div class="flex items-center gap-5">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-info">Edit</a>
                        <form method="POST" action="{{ route('tasks.complete', $task) }}">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn">Erledigen</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul> --}}
</x-layout.app>
