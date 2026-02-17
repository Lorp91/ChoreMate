<x-layout.app title="{{ $room->name }}">
    <div class="fixed z-50 bottom-4 right-4 flex flex-row-reverse items-center gap-3">
        <a href="{{ route('households.rooms.tasks.create', [$household, $room]) }}"
           class="btn btn-success">+ Aufgabe erstellen</a>
        <a href="{{ route('households.rooms.edit', [$household, $room]) }}"
           class="btn btn-info">Raum bearbeiten</a>
    </div>
    <div class="p-4 bg-base-300 rounded-2xl space-y-2">
        {{-- $todayTasks erstellen --}}
        <h2 class="text-2xl">Heute</h2>
        @foreach($tasks as $task)
            <x-task.card :task="$task" />
        @endforeach
    </div>
    <div class="mt-5 p-4 bg-base-200 rounded-2xl space-y-2">
        {{-- sortieren und anzeigen --}}
        <h2 class="text-2xl">Alle Aufgaben</h2>
        @foreach($tasks as $task)
            <div class="card bg-base-100 max-w-5xl shadow-sm">
                <div class="card-body flex flex-row items-center">
                    <input type="checkbox" class="checkbox"/>
                    <h2 class="text-xl">{{ $task->title }}</h2>
                </div>
            </div>
        @endforeach
    </div>

    <ul class="w-2xl space-y-4">
        @foreach($tasks as $task)
            <li>
                <div class="w-full flex justify-between items-center gap-5">
                    <a href="{{ route('households.rooms.tasks.show', [$household, $room, $task]) }}">{{ $task->title }}
                        , {{ $task->due_date }}</a>
                    <div class="flex items-center gap-5">
                        <a href="{{ route('households.rooms.tasks.edit', [$household, $room, $task]) }}"
                           class="btn btn-info">Edit</a>
                        <form method="POST"
                              action="{{ route('households.rooms.tasks.complete', [$household, $room, $task]) }}">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn">Erledigen</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout.app>
