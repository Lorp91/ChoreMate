<x-layout.app title="Haushalte">
    <h2 class="text-xl">alle haushalte ansehen</h2>
    <ul class="mt-4">
        @foreach($households as $household)
            <li>
                <div class="py-4 max-w-lg flex justify-between items-center">
                    <a
                        href="{{ route('households.show', $household) }}"
                    >
                        {{ $household->name }}
                    </a>
                    <a
                        href="{{ route('households.edit', $household) }}"
                        class="btn btn-secondary"
                    >
                        Edit
                    </a>
                </div>

            </li>
        @endforeach
        <li>
            <a
                href="{{ route('households.create') }}"
                class="btn btn-primary"
            >+ neuen haushalt</a>
        </li>
    </ul>
</x-layout.app>
