<x-app-layout>

<div class="min-h-screen bg-gray-100 py-10">

    <div class="max-w-7xl mx-auto px-4 lg:px-6">
         {{-- IMPORT ERROR --}}
    @if($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700 p-5 rounded-2xl mb-6">

            <ul class="space-y-2">

                @foreach($errors->all() as $error)

                    <li>
                        • {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 p-5 rounded-2xl mb-6">

            {{ session('success') }}

        </div>

    @endif

        {{-- HEADER --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">

            <div>

                <h1 class="text-4xl font-bold text-gray-900 mb-2">

                    Kamus Komering

                </h1>

                <p class="text-gray-500 text-lg">

                    Lexical database Bahasa Indonesia ↔ Komering

                </p>

            </div>



            @role('admin|validator')

            <form
                action="/dictionary/import"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <input
                    type="file"
                    name="file"
                >

                <button type="submit">
                    Import Dictionary
                </button>

            </form>

            <!-- <form
                        action="{{ route('dictionary.deleteAll') }}"
                        method="POST"
                        onsubmit="return confirm(
                            'Yakin ingin menghapus semua data dictionary?'
                        )">

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 transition text-white px-6 py-3 rounded-2xl font-semibold">

                            Delete All Dictionary

                        </button>

                    </form> -->

                @endrole

            <a
                href="/dictionary/create"
                class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-6 py-4 rounded-2xl font-semibold shadow-lg w-fit">

                Tambah Kata

            </a>

            

        </div>

        {{-- SEARCH --}}
        <div class="bg-white border border-gray-200 rounded-3xl p-5 mb-8">

            <form method="GET">

                <div class="flex flex-col lg:flex-row gap-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari kata..."
                        class="flex-1 bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-indigo-500">

                    <button
                        type="submit"
                        class="bg-black hover:bg-gray-800 transition text-white px-6 py-4 rounded-2xl font-semibold">

                        Cari

                    </button>

                </div>

            </form>

            

        </div>

        {{-- TABLE --}}
        <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden">

            {{-- TABLE HEADER --}}
            <div class="hidden lg:grid grid-cols-12 gap-4 px-6 py-5 bg-gray-50 border-b border-gray-200 text-sm font-semibold text-gray-600">

                <div class="col-span-4">

                    Bahasa Indonesia

                </div>

                <div class="col-span-4">

                    Bahasa Komering

                </div>

                <div class="col-span-2">

                    Status

                </div>

                <div class="col-span-2 text-right">

                    Action

                </div>

            </div>

            {{-- TABLE BODY --}}
            <div class="divide-y divide-gray-100">

                @forelse($words as $word)

                <details
                    class="group">

                    <summary
                        class="list-none cursor-pointer hover:bg-gray-50 transition">

                        <div class="grid lg:grid-cols-12 gap-4 px-6 py-5 items-center">

                            {{-- SOURCE --}}
                            <div class="lg:col-span-4">

                                <div class="text-sm text-gray-400 mb-1 lg:hidden">

                                    Indonesia

                                </div>

                                <div class="font-semibold text-gray-900">

                                    {{ $word->meaning }}

                                </div>

                            </div>

                            {{-- TARGET --}}
                            <div class="lg:col-span-4">

                                <div class="text-sm text-gray-400 mb-1 lg:hidden">

                                    Komering

                                </div>

                                <div class="text-indigo-600 font-semibold">

                                    {{ $word->lemma }}

                                </div>

                            </div>

                            {{-- STATUS --}}
                            <div class="lg:col-span-2">

                                @if($word->status === 'approved')

                                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-xl text-sm font-medium w-fit">

                                        Approved

                                    </div>

                                @elseif($word->status === 'pending')

                                    <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl text-sm font-medium w-fit">

                                        Pending

                                    </div>

                                @elseif($word->status === 'rejected')

                                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-sm font-medium w-fit">

                                        Rejected

                                    </div>
                                @if($word->reject_reason)

                                    <div class="mt-3 bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl">

                                        <div class="font-semibold mb-1">

                                            Alasan Reject

                                        </div>

                                        <div>

                                            {{ $word->reject_reason }}

                                        </div>

                                    </div>
                                @endif
                                @endif

                            </div>

                            {{-- ACTION --}}
                            <div class="lg:col-span-2 flex justify-end items-center gap-3">

                                <div class="text-gray-400 group-open:rotate-180 transition">

                                    ▼

                                </div>

                            </div>

                        </div>

                    </summary>

                    {{-- EXPAND DETAIL --}}
                    <div class="px-6 pb-6">

                        <div class="bg-gray-50 rounded-2xl p-6">

                            {{-- EXAMPLE --}}

                            {{-- META --}}
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                                <div class="text-sm text-gray-500">

                                    Ditambahkan
                                    {{ $word->created_at->diffForHumans() }}

                                </div>

                                {{-- ADMIN DELETE --}}
                                @role('admin')

                                <form
                                    method="POST"
                                    action="{{ route('admin.dictionary.destroy', $word) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Hapus kata ini?')"
                                        class="bg-red-50 hover:bg-red-100 transition text-red-600 px-5 py-3 rounded-2xl font-medium">

                                        Hapus Kata

                                    </button>

                                </form>

                                @endrole

                            </div>

                        </div>

                    </div>

                </details>

                @empty

                <div class="p-16 text-center">

                    <h2 class="text-2xl font-bold text-gray-700 mb-3">

                        Kata tidak ditemukan

                    </h2>

                    <p class="text-gray-500">

                        Coba gunakan kata kunci lain.

                    </p>

                </div>

                @endforelse

            </div>

        </div>

        {{-- PAGINATION --}}
        <div class="mt-10">

            {{ $words->links() }}

        </div>

    </div>

</div>

</x-app-layout>