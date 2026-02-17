<x-layout.auth title=" - Registrieren">
    <div class="card">
        <h2 class="text-3xl">Registrieren</h2>
        <form method="POST" action="{{ route('register') }}" class="space-y-4 mt-10">
            @csrf

            <x-form.field name="name" label="Name" placeholder="Max Mustermann" />
            <x-form.field type="email" name="email" label="E-Mail" placeholder="max@msutermann.de" />
            <x-form.field type="password" name="password" label="Passwort" />
            <x-form.field type="password" name="password_confirmation" label="Passwort wiederholen" />

            <button type="submit" class="mt-2 w-full btn btn-primary">Registrieren</button>
        </form>
    </div>
</x-layout.auth>
