<x-layout.app title="Task">
    <form method="POST" action="{{ route('households.rooms.tasks.store', [$household, $room]) }}" class="max-w-xl">
        @csrf

        <x-form.field name="title" label="Titel" />
        <x-form.field name="description" label="Beschreibung" />
        <x-form.field type="date" name="due_date" label="Faellig am" />
        <x-form.field type="number" name="repeat_interval" label="Zahl Wiederholung" />
        {{-- evtl dann select --}}
        <x-form.field name="interval_unit" label="Intervall" />

        <div class="flex flex-row-reverse items-center gap-3 mt-5">
            <button type="submit" class="btn btn-primary">Erstellen</button>
        </div>
    </form>
</x-layout.app>
