<ul class="menu bg-base-200 min-h-full w-sm p-4">
    <div class="flex items-center gap-4">
        <span class="text-4xl">#</span>
        <h1 class="text-4xl font-semibold">ChoreMate</h1>
    </div>
    <div class="mt-5">
        <a href="{{ route('households.index') }}" class="text-3xl">{{ $currentHousehold->name }}</a>
    </div>
    <div class="mt-5">
        <x-room.selector :current-household="$currentHousehold" :current-rooms="$currentRooms"/>
    </div>
</ul>
