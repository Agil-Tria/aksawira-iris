<x-guest-layout>

<div class="min-h-screen grid lg:grid-cols-2">

    {{-- LEFT SIDE --}}
    <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-indigo-600 to-blue-500 p-16 text-white">

        <div class="flex items-center gap-4">

            <img
                src="{{ asset('aksawira-logo.png') }}"
                class="w-16 h-16 object-contain">

            <div>

                <h1 class="text-3xl font-bold">

                    Aksawira Iris

                </h1>

                <p class="text-indigo-100">

                    Komering Language Platform

                </p>

            </div>

        </div>

        <div>

            <h2 class="text-5xl font-bold leading-tight mb-8">

                Digitalisasi Bahasa Komering
                untuk Masa Depan NLP Indonesia

            </h2>

            <p class="text-xl text-indigo-100 leading-relaxed">

                Platform crowdsourcing corpus,
                kamus digital, dan translation engine
                Bahasa Komering.

            </p>

        </div>

        <div class="text-indigo-200">

            © {{ date('Y') }} Aksawira Iris

        </div>

    </div>

    {{-- RIGHT SIDE --}}
    <div class="flex items-center justify-center bg-gray-100 p-8">

        <div class="w-full max-w-xl">

            <div class="bg-white rounded-3xl shadow-2xl p-10">

                <div class="mb-10">

                    <h2 class="text-4xl font-bold text-gray-900 mb-3">

                        Welcome Back

                    </h2>

                    <p class="text-gray-600 text-lg">

                        Login ke platform Aksawira Iris

                    </p>

                </div>

                <form
                    method="POST"
                    action="{{ route('login') }}">

                    @csrf

                    {{-- EMAIL --}}
                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-gray-700 mb-3">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            required
                            autofocus
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-lg focus:ring-2 focus:ring-indigo-500"
                            placeholder="Masukkan email">

                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-gray-700 mb-3">

                            Password

                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-lg focus:ring-2 focus:ring-indigo-500"
                            placeholder="Masukkan password">

                    </div>

                    {{-- REMEMBER --}}
                    <div class="flex items-center justify-between mb-8">

                        <label class="flex items-center gap-3">

                            <input
                                type="checkbox"
                                name="remember"
                                class="rounded border-gray-300 text-indigo-600">

                            <span class="text-gray-600">

                                Remember me

                            </span>

                        </label>

                        <a
                            href="{{ route('password.request') }}"
                            class="text-indigo-600 hover:underline">

                            Forgot password?

                        </a>

                    </div>

                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 transition text-white py-5 rounded-2xl text-lg font-semibold shadow-lg">

                        Login

                    </button>

                </form>

                {{-- REGISTER --}}
                <div class="mt-8 text-center text-gray-600">

                    Belum punya akun?

                    <a
                        href="{{ route('register') }}"
                        class="text-indigo-600 font-semibold hover:underline">

                        Register sekarang

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</x-guest-layout>