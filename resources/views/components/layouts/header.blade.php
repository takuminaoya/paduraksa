<header
    class="fixed w-full py-6 h-24 text-lg flex justify-between transition-all duration-200 bg-red-700 items-center px-6 text-white z-20"
    :class="{ 'h-24': !scrolledFromTop, 'h-12': scrolledFromTop }">
    <a href="/" class="font-bold flex flex-row justify-center items-center gap-1">
        <img src="{{ asset('storage/images/icon_trans.png') }}" class="h-11" alt="">
        Paduraksa
    </a>

    <nav>
        <button @click="navbarOpen = !navbarOpen" class="md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>

        </button>

        <ul class="fixed w-full left-0 right-0 min-h-screen transition duration-200 bg-red-700 space-y-4 p-6 transform translate-x-full md:relative md:flex md:min-h-0 md:space-y-0 md:space-x-6 md:p-0 md:translate-x-0"
            :class="{ 'translate-x-full': !navbarOpen, 'translate-x-0': navbarOpen }">
            <li><a href="/" wire:navigate class="hover:border-b-2 pb-1 font-s">Home</a></li>
            <li><a href="/tentang" wire:navigate class="hover:border-b-2 pb-1 font-s">Tentang</a></li>
            <li><a href="/petunjuk" wire:navigate class="hover:border-b-2 pb-1 font-s">Petunjuk Penggunaan</a></li>
        </ul>
    </nav>
</header>
