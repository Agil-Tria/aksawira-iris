<x-app-layout>

<div class="min-h-screen bg-gray-100 py-14">

    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-10">

            <div>

                <h1 class="text-5xl font-bold text-gray-900 mb-3">

                    Corpus Komering

                </h1>

                <p class="text-xl text-gray-600">

                    Dataset pasangan kalimat Bahasa Indonesia
                    dan Komering berbasis crowdsourcing.

                </p>

            </div>

            <div class="mt-6 lg:mt-0">

                <div class="bg-white rounded-2xl shadow px-8 py-5">

                    <div class="text-sm text-gray-500 mb-1">

                        Total Approved Corpus

                    </div>

                    <div class="text-3xl font-bold text-indigo-600">

                        {{ $sentences->total() }}

                    </div>

                </div>

            </div>

        </div>

        {{-- SEARCH --}}
        <div class="bg-white rounded-3xl shadow p-6 mb-10">

            <form method="GET">

                <div class="flex flex-col lg:flex-row gap-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari pasangan kalimat..."
                        class="flex-1 bg-gray-50 border border-gray-200 rounded-2xl px-6 py-5 text-lg focus:ring-2 focus:ring-indigo-500">

                    <button
                        type="submit"
                        class="bg-black hover:bg-gray-800 transition text-white px-8 py-5 rounded-2xl text-lg font-medium">

                        Cari

                    </button>

                </div>

            </form>

        </div>

        {{-- CORPUS LIST --}}
        <div class="space-y-6">

            @forelse($sentences as $sentence)

                <div class="bg-white rounded-3xl shadow hover:shadow-xl transition p-8">

                    {{-- TOP --}}
                    <div class="flex items-center justify-between mb-6">
                        @role('admin')

                            <form
                                method="POST"
                                action="{{ route('admin.corpus.destroy', $sentence) }}">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus corpus ini?')"
                                    class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-2xl transition">

                                    Hapus

                                </button>

                            </form>

                        @endrole

@if($sentence->status === 'approved')

    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-2xl text-sm font-medium">

        Approved

    </div>

@elseif($sentence->status === 'pending')

    <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-2xl text-sm font-medium">

        Pending

    </div>

@else

    <div class="bg-red-100 text-red-700 px-4 py-2 rounded-2xl text-sm font-medium">

        Rejected

    </div>

@endif

                        <div class="text-sm text-gray-500">

                            {{ $sentence->created_at->diffForHumans() }}

                        </div>

                    </div>

                    {{-- SENTENCE GRID --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                        {{-- INDONESIA --}}
                        <div>

                            <div class="text-sm text-gray-500 mb-3">

                                Bahasa Indonesia

                            </div>

                            <div class="bg-gray-50 rounded-2xl p-6">

                                <p class="text-xl text-gray-900 leading-relaxed">

                                    {{ $sentence->source_text }}

                                </p>

                            </div>

                        </div>

                        {{-- KOMERING --}}
                        <div>

                            <div class="text-sm text-gray-500 mb-3">

                                Bahasa Komering

                            </div>

                            <div class="bg-indigo-50 rounded-2xl p-6">

                                <p class="text-xl text-indigo-800 leading-relaxed">

                                    {{ $sentence->target_text }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-3xl shadow p-14 text-center">

                    <h2 class="text-2xl font-bold text-gray-700 mb-3">

                        Corpus tidak ditemukan

                    </h2>

                    <p class="text-gray-500">

                        Coba gunakan kata kunci lain.

                    </p>

                </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}
        <div class="mt-12">

            {{ $sentences->links() }}

        </div>

    </div>

</div>

</x-app-layout>