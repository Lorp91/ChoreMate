<x-layout.app title="Raeume">
    <h2 class="text-xl">alle Raeume ansehen</h2>
    <ul class="mt-4">
        @foreach($rooms as $room)
            <li>
                <div class="py-4 max-w-lg flex justify-between items-center">
                    <a
                        href="{{ route('households.rooms.show', [$household, $room]) }}"
                    >
                        {{ $room->name }}
                    </a>
                    <a
                        href="{{ route('households.rooms.edit', [$household, $room]) }}"
                        class="btn btn-secondary"
                    >
                        Edit
                    </a>
                </div>

            </li>
        @endforeach
        <li>
            <a
                href="{{ route('households.rooms.create', $household) }}"
                class="btn btn-primary"
            >+ neuen Raum</a>
        </li>
    </ul>
</x-layout.app>
