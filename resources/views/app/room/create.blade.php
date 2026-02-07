<x-layout.app title="Raum erstellen">
    <h2 class="text-3xl">Neuer Raum</h2>
    <form method="POST" action="{{ route('households.rooms.store', [$household]) }}">
        @csrf

        <x-form.field
            name="name"
            label="Name"
            value="{{ old('name') }}"
        />

        <button type="submit" class="btn btn-primary">Erstellen</button>
    </form>
</x-layout.app>
