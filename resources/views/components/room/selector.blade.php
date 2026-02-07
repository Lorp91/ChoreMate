@props(['currentHousehold', 'currentRooms'])

<div>
    <h3 class="text-xl">Raeume</h3>

    <ul class="mt-5 space-y-4">
        <li><a href="{{ route('households.rooms.index', $currentHousehold) }}">alle Raeume</a></li>
        @foreach($currentRooms as $room)
            <li><a href="{{ route('households.rooms.show', [$currentHousehold, $room]) }}">{{ $room->name }}</a></li>
        @endforeach
        <li><a href="{{ route('households.rooms.create', $currentHousehold) }}" class="text-accent-content">+ neuer Raum</a></li>
    </ul>
</div>
