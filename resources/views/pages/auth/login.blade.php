<x-layout.guest title=" - Login">
    <div class="card">
        <h2 class="text-3xl">Login</h2>
        <form method="POST" action="/login" class="space-y-4 mt-10">
            @csrf

            <x-form.field type="email" name="email" label="E-Mail" placeholder="max@msutermann.de" />
            <x-form.field type="password" name="password" label="Passwort" />

            <button type="submit" class="mt-2 w-full btn btn-primary">Login</button>
        </form>
    </div>
</x-layout.guest>
