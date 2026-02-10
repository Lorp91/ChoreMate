<x-layout.app title="Raum erstellen">
    <div class="p-10">
        <form
            method="POST"
            action="{{ route('households.rooms.store', [$household]) }}"
            class="max-w-xl"
        >
            @csrf

            <x-form.field
                name="name"
                label="Name"
                placeholder="z.B. Wohnzimmer"
                value="{{ old('name') }}"
            />

            <div class="mt-5 flex flex-row-reverse items-center gap-3">
                <button type="submit" class="btn btn-primary">Erstellen</button>
                <a href="{{ route('households.dashboard', $household) }}" class="btn btn-ghost">abbrechen</a>
            </div>
        </form>
    </div>
</x-layout.app>
