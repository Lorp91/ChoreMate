<x-layout.app title="{{ $household->name }} bearbeiten">
    <form method="POST" action="{{ route('households.update', $household) }}" class="max-w-xl">
        @csrf
        @method('PUT')

        <x-form.field name="name" label="Name" value="{{ old('name', $household->name) }}" />

        <x-form.field type="textarea" name="description" label="Beschreibung"
            value="{{ old('description', $household->description) }}" />

        <div class="flex flex-row-reverse items-center gap-3 mt-5">
            <button type="submit" class="btn btn-primary">Speichern</button>
            <button type="submit" form="delete-household" class="btn btn-warning">Löschen</button>
            <a href="{{ route('households.index') }}" class="btn btn-ghost">abbrechen</a>
        </div>
    </form>

    <form id="delete-household" method="POST" action="{{ route('households.destroy', $household) }}">
        @csrf
        @method('DELETE')
    </form>
</x-layout.app>
