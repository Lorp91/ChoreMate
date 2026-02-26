<x-layout.app title="Raum erstellen">
    <form method="POST" action="{{ route('households.rooms.store', [$household]) }}" class="max-w-xl">
        @csrf

        <x-form.field name="name" label="Name" placeholder="z.B. Wohnzimmer" value="{{ old('name') }}" />

        <div class="flex flex-row-reverse items-center gap-3 mt-5">
            <button type="submit" class="btn btn-primary">Erstellen</button>
            <a href="{{ route('dashboard', $household) }}" class="btn btn-ghost">abbrechen</a>
        </div>
    </form>
</x-layout.app>
