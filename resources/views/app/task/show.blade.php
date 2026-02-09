@php
    use Carbon\Carbon;
@endphp

<x-layout.app title="Aufgabe">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-bold">{{ $task->title }}</h2>
        <a
            href="{{ route('households.rooms.tasks.edit', [$household, $room, $task]) }}"
            class="btn btn-secondary"
        >
            Edit
        </a>
    </div>
    <div>
        <p>Beschreibung: {{ $task->description }}</p>
        <p>Faellig
            <span
                class="text-accent-content"
            >
                {{ Carbon::parse($task->due_date)->locale('de')->diffForHumans() }}
            </span>
        </p>
        <p>Wiederholungen: <span>{{ $task->repeat_interval }}</span> <span>{{ $task->interval_unit }}</span></p>
        <p>in Raum: {{ $task->room->name }}</p>
        <p>zugewiesener User: {{ $task->user->name ?? 'Kein Benutzer' }}</p>
    </div>
</x-layout.app>
