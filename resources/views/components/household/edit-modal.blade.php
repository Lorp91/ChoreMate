<dialog
    id="edit_household_modal"
    class="modal"
    @if(session('openModal') === 'household_edit') open @endif
>
    <div class="modal-box">
        <h3 class="text-lg font-bold">Name bearbeiten</h3>
        <form
            method="POST" action="{{ route('households.update') }}" class="mt-2">
            @csrf
            @method('PUT')

            <input type="hidden" name="household_id"  >

            <x-form.field name="name" label="Name" x-model="editHousehold.name" />

            <div class="mt-10 flex gap-4">
                <button form="close-modal" class="btn btn-ghost flex-1">Abbrechen</button>
                <button type="button" class="btn btn-warning flex-1">Loeschen</button>
            </div>
            <button type="submit" class="btn btn-primary w-full mt-2">Update</button>
        </form>
    </div>
    <form id="close-modal" method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
