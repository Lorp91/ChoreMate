<x-layout.app title="Task">
    <form method="POST" action="{{ route('tasks.update', $task) }}" class="max-w-xl">
        @csrf
        @method('PUT')

        <x-form.field name="title" label="Titel" :value="$task->title" />
        <x-form.field name="description" label="Beschreibung" :value="$task->description" />
        <x-form.field type="date" name="due_date" label="Faellig am" :value="optional($task->due_date)->format('Y-m-d')" />
        <x-form.field type="number" name="repeat_interval" label="Zahl Wiederholung" :value="$task->repeat_interval" />
        {{-- evtl dann select --}}
        <x-form.field name="interval_unit" label="Intervall" :value="$task->interval_unit" />

        <div class="flex flex-row-reverse items-center gap-3 mt-5">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="submit" form="delete-task" class="btn btn-warning">Loeschen</button>
        </div>
    </form>
    <form id="delete-task" method="POST" action="{{ route('tasks.destroy', $task) }}">
        @csrf
        @method('DELETE')
    </form>
</x-layout.app>
