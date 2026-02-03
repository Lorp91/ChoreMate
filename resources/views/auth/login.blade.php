<x-layout.auth title=" - Login">
    <div class="card">
        <h2 class="text-3xl">Login</h2>
        <form method="POST" action="{{ route('login.store') }}" class="mt-10 space-y-4">
            @csrf

            <x-form.field type="email" name="email" label="E-Mail" placeholder="max@msutermann.de" />
            <x-form.field type="password" name="password" label="Passwort" />

            <button type="submit" class="btn btn-primary w-full mt-2">Login</button>
        </form>
    </div>
</x-layout.auth>
