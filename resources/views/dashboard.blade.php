<x-app-layout>

<div class="min-h-screen bg-gray-100 py-10">

    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-10">

            <div>

                <h1 class="text-5xl font-bold text-gray-900 mb-3">

                    Selamat Datang,
                    {{ auth()->user()->name }}

                </h1>

                <p class="text-xl text-gray-600">

                    Platform digitalisasi Bahasa Komering
                    berbasis crowdsourcing dan translation.

                </p>

            </div>

            <div class="mt-6 lg:mt-0">

                <a
                    href="/translate"
                    class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-8 py-4 rounded-2xl shadow-lg text-lg font-semibold">

                    Mulai Translate

                </a>

            </div>

        </div>

        {{-- MAIN STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

            {{-- CORPUS --}}
            <div class="bg-white rounded-3xl shadow p-6">

                <div class="text-gray-500 mb-2">

                    Corpus Platform

                </div>

                <div class="text-4xl font-bold text-gray-900">

                    {{ \App\Models\Sentence::count() }}

                </div>

            </div>

            {{-- DICTIONARY --}}
            <div class="bg-white rounded-3xl shadow p-6">

                <div class="text-gray-500 mb-2">

                    Dictionary Entries

                </div>

                <div class="text-4xl font-bold text-indigo-600">

                    {{ \App\Models\Dictionary::count() }}

                </div>

            </div>

            {{-- APPROVED --}}
            <div class="bg-white rounded-3xl shadow p-6">

                <div class="text-gray-500 mb-2">

                    Approved Corpus

                </div>

                <div class="text-4xl font-bold text-green-600">

                    {{ \App\Models\Sentence::where('status', 'approved')->count() }}

                </div>

            </div>

            {{-- USERS --}}
            <div class="bg-white rounded-3xl shadow p-6">

                <div class="text-gray-500 mb-2">

                    Community Users

                </div>

                <div class="text-4xl font-bold text-yellow-500">

                    {{ \App\Models\User::count() }}

                </div>

            </div>

        </div>

        {{-- QUICK ACTIONS --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

            {{-- TRANSLATE --}}
            <a
                href="/translate"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-4">

                    Translator

                </h2>

                <p class="text-gray-600 mb-6">

                    Gunakan translator bilingual
                    Indonesia ↔ Komering.

                </p>

                <div class="text-indigo-600 font-semibold">

                    Buka Translator →

                </div>

            </a>

            {{-- DICTIONARY --}}
            <a
                href="/dictionary"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-4">

                    Kamus Komering

                </h2>

                <p class="text-gray-600 mb-6">

                    Jelajahi dan cari kosakata
                    Bahasa Komering.

                </p>

                <div class="text-indigo-600 font-semibold">

                    Buka Kamus →

                </div>

            </a>

            {{-- CORPUS --}}
            <a
                href="/corpus"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-4">

                    Corpus Platform

                </h2>

                <p class="text-gray-600 mb-6">

                    Lihat dataset dan pasangan
                    kalimat Bahasa Komering.

                </p>

                <div class="text-indigo-600 font-semibold">

                    Buka Corpus →

                </div>

            </a>

        </div>

        {{-- ROLE BASED ACCESS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- CONTRIBUTOR --}}
            <div class="bg-white rounded-3xl shadow p-8">

                <h2 class="text-2xl font-bold mb-6">

                    Contributor Tools

                </h2>

                <div class="space-y-4">

                    <a
                        href="/sentences/create"
                        class="block bg-gray-50 hover:bg-gray-100 transition rounded-2xl p-5">

                        Tambah Corpus

                    </a>

                    <a
                        href="/dictionary/create"
                        class="block bg-gray-50 hover:bg-gray-100 transition rounded-2xl p-5">

                        Tambah Kata Baru

                    </a>

                    <a
                        href="/translation-history"
                        class="block bg-gray-50 hover:bg-gray-100 transition rounded-2xl p-5">

                        Translation History

                    </a>

                </div>

            </div>

            {{-- ADMIN / VALIDATOR --}}
            <div class="bg-white rounded-3xl shadow p-8">

                <h2 class="text-2xl font-bold mb-6">

                    Moderation & Management

                </h2>

                <div class="space-y-4">

                    @role('validator')

                    <a
                        href="/validation-dashboard"
                        class="block bg-indigo-50 hover:bg-indigo-100 transition rounded-2xl p-5">

                        Validation Dashboard

                    </a>

                    <a
                        href="/dictionary-validation"
                        class="block bg-indigo-50 hover:bg-indigo-100 transition rounded-2xl p-5">

                        Dictionary Validation

                    </a>
                    <a
                        href="/sentences"
                        class="block bg-indigo-50 hover:bg-yellow-100 transition rounded-2xl p-5">
                      Sentences Management
                    </a>

                    @endrole

                    @role('admin')

                    <a
                        href="/admin-dashboard"
                        class="block bg-yellow-50 hover:bg-yellow-100 transition rounded-2xl p-5">

                        Admin Dashboard

                    </a>

                    <a
                        href="/export/corpus/csv"
                        class="block bg-yellow-50 hover:bg-yellow-100 transition rounded-2xl p-5">

                        Export Dataset CSV

                    </a>

                    <a
                        href="/sentences"
                        class="block bg-yellow-50 hover:bg-yellow-100 transition rounded-2xl p-5">
                      Sentences Management
                    </a>

                    @endrole
                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>