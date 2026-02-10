@props(['currentHousehold', 'currentRooms'])

<div class="menu bg-base-200 min-h-full w-sm p-4">
    <div class="flex items-center gap-2">
        <x-icon.logo class="w-12"/>
        <h1 class="text-4xl font-extrabold">ChoreMate</h1>
    </div>
    <div class="mt-7">
        <a
            href="{{ route('households.index') }}"
            class="text-3xl font-bold"
        >{{ $currentHousehold->name }}</a>
    </div>
    <div class="mt-5 flex flex-col gap-2">
        <a
            href="{{ route('households.dashboard', $currentHousehold) }}"
            class="text-xl"
        >Dashboard</a>
        <a
            href=""
            class="text-xl text-base-content/40 cursor-not-allowed"
        >Kalender</a>
        <a
            href=""
            class="text-xl text-base-content/40 cursor-not-allowed"
        >Statistik</a>
        <a
            href=""
            class="text-xl text-base-content/40 cursor-not-allowed"
        >Alle Aufgaben</a>
    </div>
    <div class="mt-5">
        <div>
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-semibold">Räume</h3>
                <a
                    href="{{ route('households.rooms.create', $currentHousehold) }}"
                    class="text-sm text-success-content"
                >+ neuer Raum</a>
            </div>
            <ul class="ml-4 mt-1 space-y-2">
                @foreach($currentRooms as $room)
                    <li>
                        <a
                            href="{{ route('households.rooms.show', [$currentHousehold, $room]) }}"
                            class="{{ request()->route('room')?->id === $room->id ? 'menu-active' : '' }}"
                        >{{ $room->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
