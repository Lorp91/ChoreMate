<x-layout.marketing>
    <div class="flex flex-col justify-center items-center h-screen">
        <h1 class="text-3xl">ChoreMate - Landingpage</h1>
        <div class="mt-10">
            @auth
                <div class="flex items-center gap-4">
                    <a href="{{ route('households.index') }}" class="btn btn-ghost">zur App</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button class="btn btn-primary">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Registrieren</a>
            @endauth
        </div>
    </div>
</x-layout.marketing>
