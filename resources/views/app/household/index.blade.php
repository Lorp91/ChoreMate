<x-layout.app title="Haushalte">
    <div class="max-w-5xl flex flex-col gap-4">
        @foreach($households as $household)
            <div class="card card-border bg-base-100">
                <div class="card-body flex flex-row justify-between items-center">
                    <a href="{{ route('households.dashboard', $household) }}"
                       class="flex-1 font-semibold text-lg">
                        {{ $household->name }}
                    </a>

                    <a href="{{ route('households.edit', $household) }}"
                       class="btn btn-sm btn-ghost">
                        <x-icon.pencil class="size-6 text-info-content"/>
                    </a>
                </div>
            </div>
        @endforeach
        <a href="{{ route('households.create') }}"
           class="card card-border bg-base-100">
            <div class="card-body">
                <h2 class="card-title text-success-content font-medium justify-center">+ Haushalt erstellen</h2>
            </div>
        </a>
    </div>
</x-layout.app>
