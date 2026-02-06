<dialog
    id="create_household_modal"
    class="modal"
    @if(session('openModal') === 'household_create') open @endif
>
    <div class="modal-box">
        <h3 class="text-lg font-bold">Neuen Haushalt erstellen</h3>
        <form method="POST" action="{{ route('households.store') }}" class="mt-2 space-y-2">
            @csrf

            <x-form.field name="name" label="Name" placeholder="Ferienwohnung"/>

            <button type="submit" class="btn btn-primary w-full mt-2">Erstellen</button>
        </form>
        <form method="dialog" class="modal-backdrop mt-2">
            <button class="btn">Abbrechen</button>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
