<x-layout.app title="{{ $household->name }} bearbeiten">
    <h2 class="text-3xl">{{ $household->name }}</h2>
    <form method="POST" action="{{ route('households.update', $household) }}">
        @csrf
        @method('PUT')

        <x-form.field
            name="name"
            label="Name"
            value="{{ old('name', $household->name) }}"
        />

        <button type="submit" form="delete-household" class="btn btn-warning">Loeschen</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <form id="delete-household" method="POST" action="{{ route('households.destroy', $household) }}">
        @csrf
        @method('DELETE')
    </form>
</x-layout.app>
