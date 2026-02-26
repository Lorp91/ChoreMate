<x-layout.app title="{{ $room->name }} bearbeiten">
    <form method="POST" action="{{ route('rooms.update', $room) }}" class="max-w-xl">
        @csrf
        @method('PUT')

        <x-form.field name="name" label="Name" value="{{ old('name', $room->name) }}" />

        <div class="flex flex-row-reverse items-center gap-3 mt-5">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="submit" form="delete-household" class="btn btn-warning">Loeschen</button>
        </div>
    </form>

    <form id="delete-household" method="POST" action="{{ route('rooms.destroy', $room) }}">
        @csrf
        @method('DELETE')
    </form>
</x-layout.app>
