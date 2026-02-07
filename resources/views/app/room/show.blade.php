<x-layout.app title="Raeume">
    <div class="flex justify-between items-center">
        <h3 class="text-xl">Raum: {{ $room->name }}</h3>
        <a href="{{ route('households.rooms.edit', [$household, $room]) }}" class="btn btn-secondary">Edit</a>
    </div>
    <div class="mt-5">
        -- Aufgaben hier --
    </div>
</x-layout.app>
