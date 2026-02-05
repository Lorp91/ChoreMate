@props(['title'])

    <!doctype html>
<html data-theme="pastel" lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ChoreMate - {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content flex flex-col items-center justify-center">
        {{-- page content --}}
        <div class="navbar bg-base-100 shadow-sm">
            <div class="flex-none lg:hidden">
                <label for="my-drawer" class="btn btn-square btn-ghost drawer-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         class="inline-block h-5 w-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>
            <div class="flex-1">
                <a class="ml-4 text-xl font-semibold">{{ $title }}</a>
            </div>
            <div class="flex-none">
                <form method="POST" action="{{ route('login.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-warning">Logout</button>
                </form>
            </div>
        </div>
        {{ $slot }}
    </div>
    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 min-h-full w-sm p-4">
            {{-- sidebar content --}}
            <div class="flex items-center gap-4">
                <span class="text-4xl">#</span>
                <h1 class="text-4xl font-semibold">ChoreMate</h1>
            </div>
            <div class="mt-5">
                <x-household.selector/>
            </div>
            <div class="mt-5">
                {{-- rooms here --}}
            </div>
        </ul>
    </div>
</div>

{{-- Modals --}}
<x-household.create-modal/>
<x-household.edit-modal/>

</body>
</html>
