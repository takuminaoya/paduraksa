<div x-data="{ navbarOpen: false, scrolledFromTop: false }" x-init="window.pageYOffset > 60 ? scrolledFromTop = true : scrolledFromTop = false"
    @scroll.window="window.pageYOffset > 60 ? scrolledFromTop = true : scrolledFromTop = false">

    <x-layouts.header />

    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-layouts.hero />

    {{ $slot }}

    <x-layouts.footer />
</div>
