<x-layout.app title="Raeume">
    <div class="flex justify-between items-center">
        <h3 class="text-xl">Raum: {{ $room->name }}</h3>
        <a href="{{ route('households.rooms.edit', [$household, $room]) }}" class="btn btn-secondary">Edit</a>
    </div>
    <div class="mt-5">
        <a href="{{ route('households.rooms.tasks.create', [$household, $room]) }}" class="btn btn-primary my-5">+
            Aufgabe erstellen</a>
        <ul class="w-2xl space-y-4">
            @foreach($tasks as $task)
                <li>
                    <div class="w-full flex justify-between items-center gap-5">
                        <a href="{{ route('households.rooms.tasks.show', [$household, $room, $task]) }}">{{ $task->title }}, {{ $task->due_date }}</a>
                        <div class="flex items-center gap-5">
                            <a href="{{ route('households.rooms.tasks.edit', [$household, $room, $task]) }}"
                               class="btn btn-secondary">Edit</a>
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
    </div>
</x-layout.app>
