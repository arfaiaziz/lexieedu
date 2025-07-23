<header class="bg-white shadow px-6 py-4 flex items-center justify-between">
    <h1 class="text-xl font-semibold text-gray-800">{{ @$respon['title'] }}</h1>

    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
            <i class="fas fa-user-circle text-3xl text-gray-600"></i>
            <div class="text-left text-gray-800 font-semibold text-xs">
                {{ Auth::user()->name }}
                <div class="text-gray-600 text-[11px]">Operator</div>
            </div>
        </button>

        <!-- Dropdown -->
        <div
            x-show="open"
            @click.away="open = false"
            x-transition
            class="absolute right-0 mt-2 w-40 bg-white rounded shadow z-50 py-2 text-sm text-gray-700"
        >
            <a href="{{ url('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Keluar</button>
            </form>
        </div>
    </div>
</header>
