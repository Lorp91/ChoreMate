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
</x-layout.app>
