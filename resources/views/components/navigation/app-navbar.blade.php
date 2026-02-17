@props(['title'])

<div class="bg-base-100 shadow-sm navbar">
    <div class="lg:hidden flex-none">
        <label for="my-drawer" class="btn btn-square btn-ghost drawer-button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="inline-block stroke-current w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </label>
    </div>
    <div class="flex-1">
        <a class="ml-4 font-semibold text-xl">{{ $title }}</a>
    </div>
    <div class="flex-none">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-warning">Logout</button>
        </form>
    </div>
</div>
