<x-layout.app title="Haushalt erstellen">
    <h2 class="text-3xl">Neuer Haushalt</h2>
    <form method="POST" action="{{ route('households.store') }}">
        @csrf

        <x-form.field
            name="name"
            label="Name"
            value="{{ old('name') }}"
        />

        <button type="submit" class="btn btn-primary">Erstellen</button>
    </form>
</x-layout.app>
