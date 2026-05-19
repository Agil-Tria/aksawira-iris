<x-app-layout>

<div class="min-h-screen bg-gray-100 py-12">

    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-3xl shadow p-10 mb-10">

            <div class="flex flex-col lg:flex-row lg:items-center gap-8">

                {{-- AVATAR --}}
                <div class="w-32 h-32 rounded-3xl bg-gradient-to-br from-indigo-600 to-blue-500 flex items-center justify-center text-white text-5xl font-bold shadow-xl shrink-0">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

                {{-- USER INFO --}}
                <div class="flex-1">

                    <div class="flex flex-col lg:flex-row lg:items-center gap-4 mb-4">

                        <h1 class="text-5xl font-bold text-gray-900">

                            {{ auth()->user()->name }}

                        </h1>

                        <div class="bg-indigo-100 text-indigo-700 px-5 py-2 rounded-2xl font-semibold w-fit">

                            {{ auth()->user()->roles->first()->name ?? 'User' }}

                        </div>

                    </div>

                    <div class="text-xl text-gray-600 mb-3">

                        {{ auth()->user()->email }}

                    </div>

                    <div class="text-gray-500">

                        Bergabung sejak
                        {{ auth()->user()->created_at->format('d F Y') }}

                    </div>

                </div>

            </div>

        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            {{-- CORPUS --}}
            <div class="bg-white rounded-3xl shadow p-8">

                <div class="text-gray-500 mb-3">

                    Total Corpus Contribution

                </div>

                <div class="text-5xl font-bold text-indigo-600">

                    {{ \App\Models\Sentence::where('user_id', auth()->id())->count() }}

                </div>

            </div>

            {{-- DICTIONARY --}}
            <div class="bg-white rounded-3xl shadow p-8">

                <div class="text-gray-500 mb-3">

                    Dictionary Contribution

                </div>

                <div class="text-5xl font-bold text-blue-500">

                    {{ \App\Models\Dictionary::where('user_id', auth()->id())->count() }}

                </div>

            </div>

            {{-- APPROVED --}}
            <div class="bg-white rounded-3xl shadow p-8">

                <div class="text-gray-500 mb-3">

                    Approved Contributions

                </div>

                <div class="text-5xl font-bold text-green-500">

                    {{ \App\Models\Sentence::where('user_id', auth()->id())->where('status', 'approved')->count() }}

                </div>

            </div>

        </div>

        {{-- SETTINGS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            {{-- PROFILE INFO --}}
            <div class="bg-white rounded-3xl shadow p-8">

                <h2 class="text-3xl font-bold mb-8">

                    Profile Information

                </h2>

                @include('profile.partials.update-profile-information-form')

            </div>

            {{-- PASSWORD --}}
            <div class="bg-white rounded-3xl shadow p-8">

                <h2 class="text-3xl font-bold mb-8">

                    Change Password

                </h2>

                @include('profile.partials.update-password-form')

            </div>

        </div>

        {{-- RECENT ACTIVITY --}}
<div class="bg-white rounded-3xl shadow p-8 mt-10">

    <h2 class="text-3xl font-bold mb-8">

        Recent Activity

    </h2>

    <div class="space-y-5">

        {{-- SENTENCES --}}
        @foreach(
            \App\Models\Sentence::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get()

            as $sentence
        )

            <div class="bg-gray-50 rounded-2xl p-5">

                <div class="font-semibold text-gray-900 mb-2">

                    Menambahkan Corpus Baru

                </div>

                <div class="text-gray-600">

                    {{ $sentence->source_text }}

                </div>

                <div class="text-sm text-gray-400 mt-3">

                    {{ $sentence->created_at->diffForHumans() }}

                </div>

            </div>

        @endforeach

        {{-- DICTIONARY --}}
            @foreach(
                \App\Models\Dictionary::where('user_id', auth()->id())
                ->latest()
                ->take(5)
                ->get()

                as $dictionary
            )

                    <div class="bg-blue-50 rounded-2xl p-5">

                        <div class="font-semibold text-blue-900 mb-2">

                            Menambahkan Kata Baru

                        </div>

                        <div class="text-blue-700">

                            {{ $dictionary->word_source }}
                            →
                            {{ $dictionary->word_target }}

                        </div>

                        <div class="text-sm text-blue-400 mt-3">

                            {{ $dictionary->created_at->diffForHumans() }}

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

        {{-- DELETE ACCOUNT --}}
        <div class="bg-white rounded-3xl shadow p-8 mt-10">

            <h2 class="text-3xl font-bold text-red-600 mb-8">

                Danger Zone

            </h2>

            @include('profile.partials.delete-user-form')

        </div>

    </div>

</div>

</x-app-layout>