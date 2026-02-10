@props(['currentHousehold', 'currentRooms'])

<ul class="menu bg-base-200 min-h-full w-sm p-4">
    <div class="flex items-center gap-4">
        <span class="text-4xl">#</span>
        <h1 class="text-4xl font-semibold">ChoreMate</h1>
    </div>
    <div class="mt-5">
        <a href="{{ route('households.index') }}" class="text-3xl">{{ $currentHousehold->name }}</a>
    </div>
    <div class="mt-5">
        <div>
            <h3 class="text-xl">Raeume</h3>

            <ul class="mt-5 space-y-4">
                <li><a href="{{ route('households.rooms.index', $currentHousehold) }} ">alle Raeume</a></li>
                @foreach($currentRooms as $room)
                    <li><a href="{{ route('households.rooms.show', [$currentHousehold, $room]) }}">{{ $room->name }}</a>
                    </li>
                @endforeach
                <li><a href="{{ route('households.rooms.create', $currentHousehold) }}" class="text-accent-content">+
                        neuer Raum</a></li>
            </ul>
        </div>
    </div>
</ul>
