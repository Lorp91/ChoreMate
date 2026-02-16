@props(['currentHousehold', 'currentRooms'])

<div class="bg-base-200 p-4 w-xs min-h-full menu">
    <div class="flex items-center gap-2">
        <x-icon.logo class="w-12" />
        <h1 class="font-extrabold text-4xl">ChoreMate</h1>
    </div>
    <div class="mt-7">
        <a href="{{ route('households.index') }}" class="font-bold text-3xl">{{ $currentHousehold->name ?? '' }}</a>
    </div>
    <div class="flex flex-col gap-2 mt-5">
        <a href="{{ route('households.dashboard', $currentHousehold) }}" class="text-xl">Dashboard</a>
        <a href="" class="text-base-content/40 text-xl cursor-not-allowed">Kalender</a>
        <a href="" class="text-base-content/40 text-xl cursor-not-allowed">Statistik</a>
        <a href="" class="text-base-content/40 text-xl cursor-not-allowed">Alle Aufgaben</a>
    </div>
    <div class="mt-5">
        <div>
            <div class="flex justify-between items-center">
                <h3 class="font-semibold text-2xl">Räume</h3>
                <a href="{{ route('households.rooms.create', $currentHousehold) }}"
                    class="text-success-content text-sm">+ neuer Raum</a>
            </div>
            <ul class="space-y-2 mt-1 ml-4">
                @foreach ($currentRooms as $room)
                    <li>
                        <a href="{{ route('households.rooms.show', [$currentHousehold, $room]) }}"
                            class="{{ request()->route('room')?->id === $room->id ? 'menu-active' : '' }}">{{ $room->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
