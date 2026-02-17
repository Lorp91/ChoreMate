@props(['title'])

<!doctype html>
<html data-theme="pastel" lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <title>ChoreMate - {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">

            <x-navigation.app-navbar title="{{ $title }}" />

            <main class="p-10">
                {{ $slot }}
            </main>
        </div>
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

            <x-navigation.app-sidebar />

        </div>
    </div>
</body>

</html>
