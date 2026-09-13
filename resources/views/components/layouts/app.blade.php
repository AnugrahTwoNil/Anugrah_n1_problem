<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'N+1 Lab' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-stone-100 font-sans text-stone-900">
        <header class="border-b-4 border-stone-900 bg-amber-300">
            <div class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-6 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('posts.index') }}" class="text-2xl font-black tracking-normal">N+1 LAB</a>
                <nav class="flex gap-2 text-sm font-bold">
                    <a href="{{ route('posts.index') }}" class="border-2 border-stone-900 px-3 py-2 {{ request()->routeIs('posts.index') ? 'bg-stone-900 text-amber-300' : 'bg-white' }}">800 Post</a>
                    <a href="{{ route('posts.report') }}" class="border-2 border-stone-900 px-3 py-2 {{ request()->routeIs('posts.report') ? 'bg-stone-900 text-amber-300' : 'bg-white' }}">200 Relasi</a>
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-6 py-10">
            {{ $slot }}
        </main>
    </body>
</html>