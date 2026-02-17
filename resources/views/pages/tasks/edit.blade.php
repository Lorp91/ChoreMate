<x-layout.app title="Task">
    <form method="POST" action="{{ route('households.rooms.tasks.update', [$household, $room, $task]) }}">
        @csrf
        @method('PUT')

        <x-form.field name="title" label="Titel" :value="$task->title" />
        <x-form.field name="description" label="Beschreibung" :value="$task->description" />
        <x-form.field type="date" name="due_date" label="Faellig am" :value="optional($task->due_date)->format('Y-m-d')" />
        <x-form.field type="number" name="repeat_interval" label="Zahl Wiederholung" :value="$task->repeat_interval" />
        {{-- evtl dann select --}}
        <x-form.field name="interval_unit" label="Intervall" :value="$task->interval_unit" />

        <button type="submit" form="delete-task" class="btn btn-warning">Loeschen</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <form id="delete-task" method="POST" action="{{ route('households.rooms.tasks.destroy', [$household, $room, $task]) }}">
        @csrf
        @method('DELETE')
    </form>
</x-layout.app>
