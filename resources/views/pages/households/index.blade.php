<x-layout.app title="Haushalte">
    <div class="flex flex-col gap-4 max-w-5xl">
        @foreach ($households as $household)
            <div class="bg-base-100 card-border card">
                <div class="flex flex-row justify-between items-center card-body">
                    <a href="{{ route('dashboard', $household) }}" class="flex-1 font-semibold text-lg">
                        {{ $household->name }}
                    </a>

                    <a href="{{ route('households.edit', $household) }}" class="btn btn-sm btn-ghost">
                        <x-icon.pencil class="size-6 text-info-content" />
                    </a>
                </div>
            </div>
        @endforeach
        <a href="{{ route('households.create') }}" class="bg-base-100 card-border card">
            <div class="card-body">
                <h2 class="justify-center font-medium text-success-content card-title">+ Haushalt erstellen</h2>
            </div>
        </a>
    </div>
</x-layout.app>
