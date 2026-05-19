<x-app-layout>

<div class="min-h-screen bg-gray-100 py-10">

    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">

            <div>

                <h1 class="text-4xl font-bold text-gray-900 mb-2">

                    Halo, {{ auth()->user()->name }}

                </h1>

                <p class="text-gray-600 text-lg">

                    Selamat datang kembali di Aksawira Iris

                </p>

            </div>

            <div class="mt-6 md:mt-0">

                <a
                    href="/translate"
                    class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-6 py-4 rounded-2xl shadow-lg text-lg font-medium">

                    Mulai Translate

                </a>

            </div>

        </div>

        {{-- STATISTICS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

            {{-- TOTAL CORPUS --}}
            <div class="bg-white rounded-3xl shadow p-6">

                <div class="text-sm text-gray-500 mb-2">

                    Total Corpus

                </div>

                <div class="text-4xl font-bold text-gray-900">

                    {{ $totalCorpus }}

                </div>

            </div>

            {{-- APPROVED --}}
            <div class="bg-white rounded-3xl shadow p-6">

                <div class="text-sm text-gray-500 mb-2">

                    Approved Corpus

                </div>

                <div class="text-4xl font-bold text-green-600">

                    {{ $approvedCorpus }}

                </div>

            </div>

            {{-- PENDING --}}
            <div class="bg-white rounded-3xl shadow p-6">

                <div class="text-sm text-gray-500 mb-2">

                    Pending Corpus

                </div>

                <div class="text-4xl font-bold text-yellow-500">

                    {{ $pendingCorpus }}

                </div>

            </div>

            {{-- DICTIONARY --}}
            <div class="bg-white rounded-3xl shadow p-6">

                <div class="text-sm text-gray-500 mb-2">

                    Dictionary Contribution

                </div>

                <div class="text-4xl font-bold text-indigo-600">

                    {{ $totalDictionary }}

                </div>

            </div>

        </div>

        {{-- QUICK ACTIONS --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

            {{-- ADD CORPUS --}}
            <a
                href="/sentences/create"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-3">

                    Tambah Corpus

                </h2>

                <p class="text-gray-600">

                    Kontribusikan pasangan kalimat
                    Bahasa Indonesia dan Komering.

                </p>

            </a>

            {{-- ADD DICTIONARY --}}
            <a
                href="/dictionary/create"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-3">

                    Tambah Kata

                </h2>

                <p class="text-gray-600">

                    Tambahkan kosakata baru
                    ke dalam kamus Komering.

                </p>

            </a>

            {{-- TRANSLATE --}}
            <a
                href="/translate"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-3">

                    Translate

                </h2>

                <p class="text-gray-600">

                    Gunakan translator bilingual
                    Indonesia ↔ Komering.

                </p>

            </a>

        </div>

        {{-- RECENT ACTIVITY --}}
        <div class="bg-white rounded-3xl shadow p-8">

            <div class="flex items-center justify-between mb-6">

                <h2 class="text-2xl font-bold">

                    Aktivitas Kontribusi

                </h2>

                <a
                    href="/translation-history"
                    class="text-indigo-600 hover:underline">

                    Lihat Semua

                </a>

            </div>

            <div class="space-y-4">

                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="font-semibold mb-1">

                        Translation History

                    </div>

                    <div class="text-gray-600">

                        Riwayat translation pengguna
                        tersimpan secara otomatis.

                    </div>

                </div>

                <div class="bg-gray-50 rounded-2xl p-5">

                    <div class="font-semibold mb-1">

                        Dataset Contribution

                    </div>

                    <div class="text-gray-600">

                        Semua kontribusi corpus dan
                        dictionary akan divalidasi.

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>