<form method="POST" action="{{ route('household.switch') }}" class="w-sm">
    @csrf

    <div class="dropdown dropdown-bottom w-full text-left">
        <label tabindex="0" class="btn btn-ghost btn-xl w-full text-left justify-start text-4xl">
            <span>
                {{ $households->firstWhere('id', session('current_household_id'))->name ?? 'Select Household' }}
            </span>
            <span class="ml-auto text-sm font-medium">
                v
            </span>
        </label>

        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-full">
            @foreach($households as $household)
                <li class="w-full">
                    <div class="flex items-center group px-2 py-1 rounded hover:bg-base-200">
                        <button
                            type="submit"
                            name="household_id"
                            value="{{ $household->id }}"
                            class="flex-1 text-left cursor-pointer"
                        >
                            {{ $household->name }}
                        </button>
                        <button
                            type="button"
                            class="ml-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer hover:text-warning"
                            data-id="{{ $household->id }}"
                            data-name="{{ $household->name }}"
                            onclick="edit_household_modal.showModal()"
                        >
                            Edit
                        </button>
                    </div>


                </li>
            @endforeach
            <li>
                <button type="button" class="btn btn-primary w-full" onclick="create_household_modal.showModal()">
                    + Haushalt erstellen
                </button>
            </li>
        </ul>
    </div>
</form>

<x-household.create-modal/>
<x-household.edit-modal/>


