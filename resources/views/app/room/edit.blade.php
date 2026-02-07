<x-layout.app title="{{ $room->name }} bearbeiten">
    <h2 class="text-3xl">{{ $room->name }}</h2>
    <form method="POST" action="{{ route('households.rooms.update', [$household, $room]) }}">
        @csrf
        @method('PUT')

        <x-form.field
            name="name"
            label="Name"
            value="{{ old('name', $room->name) }}"
        />

        <button type="submit" form="delete-household" class="btn btn-warning">Loeschen</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <form id="delete-household" method="POST" action="{{ route('households.rooms.destroy', [$household, $room]) }}">
        @csrf
        @method('DELETE')
    </form>
</x-layout.app>
