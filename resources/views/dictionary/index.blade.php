<x-app-layout>

<div class="min-h-screen bg-gray-100 py-14">

    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-10">

            <div>

                <h1 class="text-5xl font-bold text-gray-900 mb-3">

                    Kamus Komering

                </h1>

                <p class="text-xl text-gray-600">

                    Jelajahi kosakata Bahasa Komering
                    berbasis komunitas.

                </p>

            </div>

            @auth

            <div class="mt-6 lg:mt-0">

                <a
                    href="/dictionary/create"
                    class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-8 py-4 rounded-2xl shadow-lg text-lg font-semibold">

                    Tambah Kata

                </a>

            </div>

            @endauth

        </div>

        {{-- SEARCH --}}
        <div class="bg-white rounded-3xl shadow p-6 mb-10">

            <form method="GET">

                <div class="flex flex-col lg:flex-row gap-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari kata Bahasa Indonesia atau Komering..."
                        class="flex-1 bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5 text-lg focus:ring-2 focus:ring-indigo-500">

                    <button
                        type="submit"
                        class="bg-black hover:bg-gray-800 transition text-white px-8 py-5 rounded-2xl text-lg font-medium">

                        Cari

                    </button>

                </div>

            </form>

        </div>

        {{-- WORD LIST --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            @forelse($words as $word)

                <div class="bg-white rounded-3xl shadow hover:shadow-xl transition p-8">

                    {{-- TOP --}}
                    <div class="flex items-start justify-between mb-6">

                        <div>
                            

                            <div class="text-sm text-gray-500 mb-2">

                                Bahasa Indonesia

                            </div>

                            <h2 class="text-3xl font-bold text-gray-900">

                                {{ $word->word_source }}

                            </h2>

                        </div>
                        
                                                    @role('admin')

                            <form
                                method="POST"
                                action="{{ route('admin.dictionary.destroy', $word) }}">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus kata ini?')"
                                    class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-2xl transition">

                                    Hapus

                                </button>

                            </form>

                        @endrole
                        <div class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-2xl text-sm font-medium">
                            

                            Komering

                        </div>

                    </div>

                    {{-- TRANSLATION --}}
                    <div class="mb-6">

                        <div class="text-sm text-gray-500 mb-2">

                            Translation

                        </div>

                        <div class="text-2xl font-semibold text-indigo-700">

                            {{ $word->word_target }}

                        </div>
                        
                    </div>
                        
                    {{-- EXAMPLE --}}
                    @if($word->example_sentence)

                    <div class="bg-gray-50 rounded-2xl p-5">

                        <div class="text-sm text-gray-500 mb-2">

                            Contoh Kalimat

                        </div>

                        <div class="text-gray-800 leading-relaxed">

                            {{ $word->example_sentence }}

                        </div>

                    </div>

                    @endif

                </div>

            @empty

                <div class="col-span-2">

                    <div class="bg-white rounded-3xl shadow p-14 text-center">

                        <h2 class="text-2xl font-bold text-gray-700 mb-3">

                            Kata tidak ditemukan

                        </h2>

                        <p class="text-gray-500">

                            Coba gunakan kata kunci lain.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-12">

            {{ $words->links() }}

        </div>

    </div>

</div>

</x-app-layout>