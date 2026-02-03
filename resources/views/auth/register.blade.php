<x-layout.auth title=" - Registrieren">
    <div class="card">
        <h2 class="text-3xl">Registrieren</h2>
        <form method="POST" action="{{ route('register.store') }}" class="mt-10 space-y-4">
            @csrf

            <x-form.field name="name" label="Name" placeholder="Max Mustermann" />
            <x-form.field type="email" name="email" label="E-Mail" placeholder="max@msutermann.de" />
            <x-form.field type="password" name="password" label="Passwort" />

            <button type="submit" class="btn btn-primary w-full mt-2">Registrieren</button>
        </form>
    </div>
</x-layout.auth>
