<x-layout.app title="Haushalt erstellen">
    <form method="POST" action="{{ route('households.store') }}" class="max-w-xl">
        @csrf

        <x-form.field name="name" label="Name" placeholder="z.B. Ferienhaus" />
        <x-form.field type="textarea" name="description" label="Beschreibung" placeholder="Mein Haus an der Ostsee" />

        <div class="flex flex-row-reverse items-center gap-3 mt-5">
            <button type="submit" class="btn btn-primary">Erstellen</button>
            <a href="{{ route('households.index') }}" class="btn btn-ghost">abbrechen</a>
        </div>
    </form>
</x-layout.app>
