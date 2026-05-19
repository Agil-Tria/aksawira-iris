<nav
    x-data="{ open: false }"
    class="sticky top-0 z-50 backdrop-blur-xl bg-white/80 border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between min-h-[88px]">

            {{-- LEFT --}}
            <div class="flex items-center gap-10">

                {{-- BRAND --}}
                <a
                    href="/"
                    class="flex items-center gap-4 shrink-0">

                        <img
                        src="{{ asset('logo.png') }}"
                        alt="Aksawira Iris Logo"
                        class="w-14 h-14 object-contain">

                    <div class="leading-tight">

                        <div class="font-bold text-2xl text-gray-900">

                            Aksawira Iris

                        </div>

                        <div class="text-sm text-gray-500">

                            Komering Language Platform

                        </div>

                    </div>

                </a>

                {{-- DESKTOP MENU --}}
                <div class="hidden xl:flex items-center gap-2">

                    <a href="/dashboard"
                        class="px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                        Dashboard

                    </a>

                    <a href="/translate"
                        class="px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                        Translate

                    </a>

                    <a href="/dictionary"
                        class="px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                        Dictionary

                    </a>

                    <a href="/corpus"
                        class="px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                        Corpus

                    </a>

                    @auth

                    <a href="/translation-history"
                        class="px-4 py-3 rounded-2xl hover:bg-gray-100 transition">

                        History

                    </a>

                    @endauth

                    @role('validator')

                    <a href="/validation-dashboard"
                        class="px-4 py-3 rounded-2xl bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition">

                        Validation

                    </a>

                    @endrole

                    @role('admin')

                    <a href="/admin-dashboard"
                        class="px-4 py-3 rounded-2xl bg-yellow-50 text-yellow-700 hover:bg-yellow-100 transition">

                        Admin

                    </a>

                    @endrole

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-3">

                {{-- DESKTOP PROFILE --}}
                @auth

                <a
    href="/profile"
    class="hidden xl:flex items-center gap-3 bg-gray-100 hover:bg-gray-200 transition rounded-2xl px-4 py-2 shrink-0">

                    <div class="w-10 h-10 rounded-2xl bg-indigo-600 flex items-center justify-center text-white font-semibold shadow">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                    <div class="leading-tight">

                        <div class="font-semibold text-sm text-gray-900">

                            {{ auth()->user()->name }}

                        </div>

                        <div class="text-xs text-gray-500 truncate max-w-[140px]">

                            {{ auth()->user()->email }}

                        </div>

                    </div>

                </a>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="hidden xl:block">

                    @csrf

                    <button
                        type="submit"
                        class="bg-red-50 hover:bg-red-100 transition text-red-600 px-5 py-3 rounded-2xl">

                        Logout

                    </button>

                </form>

                @endauth

                {{-- GUEST --}}
                @guest

                <div class="hidden xl:flex items-center gap-3">

                    <a
                        href="{{ route('login') }}"
                        class="px-5 py-3 rounded-2xl hover:bg-gray-100 transition">

                        Login

                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-6 py-3 rounded-2xl shadow-lg">

                        Register

                    </a>

                </div>

                @endguest

                {{-- MOBILE BUTTON --}}
                <button
                    @click="open = !open"
                    class="xl:hidden bg-gray-100 hover:bg-gray-200 transition rounded-2xl p-3">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    {{-- MOBILE MENU --}}
    <div
        x-show="open"
        x-transition
        class="xl:hidden border-t border-gray-200 bg-white">

        <div class="px-6 py-6 space-y-3">

            <a href="/dashboard"
                class="block px-5 py-4 rounded-2xl hover:bg-gray-100">

                Dashboard

            </a>

            <a href="/translate"
                class="block px-5 py-4 rounded-2xl hover:bg-gray-100">

                Translate

            </a>

            <a href="/dictionary"
                class="block px-5 py-4 rounded-2xl hover:bg-gray-100">

                Dictionary

            </a>

            <a href="/corpus"
                class="block px-5 py-4 rounded-2xl hover:bg-gray-100">

                Corpus

            </a>

            @auth

            <a href="/translation-history"
                class="block px-5 py-4 rounded-2xl hover:bg-gray-100">

                History

            </a>

            @endauth

            @role('validator')

            <a href="/validation-dashboard"
                class="block px-5 py-4 rounded-2xl bg-indigo-50 text-indigo-700">

                Validation Dashboard

            </a>

            @endrole

            @role('admin')

            <a href="/admin-dashboard"
                class="block px-5 py-4 rounded-2xl bg-yellow-50 text-yellow-700">

                Admin Dashboard

            </a>

            @endrole

            @auth

            <div class="border-t pt-5 mt-5">

                <div class="mb-4">

                    <div class="font-semibold">

                        {{ auth()->user()->name }}

                    </div>

                    <div class="text-sm text-gray-500">

                        {{ auth()->user()->email }}

                    </div>

                </div>

                <form
                    method="POST"
                    action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="w-full bg-red-50 hover:bg-red-100 text-red-600 px-5 py-4 rounded-2xl">

                        Logout

                    </button>

                </form>

            </div>

            @endauth

        </div>

    </div>

</nav>