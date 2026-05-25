<x-app-layout>

<div class="min-h-screen bg-gray-100 py-10">

    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-10">

            <div>

                <h1 class="text-5xl font-bold text-gray-900 mb-3">

                    Admin Dashboard

                </h1>

                <p class="text-xl text-gray-600">

                    Monitoring ecosystem Aksawira Iris
                    secara real-time.

                </p>

            </div>

            <div class="mt-6 lg:mt-0">

                <a
                    href="/export/corpus/csv"
                    class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-8 py-4 rounded-2xl shadow-lg text-lg font-semibold">

                    Export Dataset

                </a>

            </div>

        </div>

        {{-- ANALYTICS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

            {{-- USERS --}}
            <div class="bg-white rounded-3xl shadow p-7">

                <div class="text-sm text-gray-500 mb-3">

                    Community Users

                </div>

                <div class="text-5xl font-bold text-gray-900">

                    {{ $totalUsers }}

                </div>

            </div>

            {{-- VALIDATORS --}}
            <div class="bg-white rounded-3xl shadow p-7">

                <div class="text-sm text-gray-500 mb-3">

                    Validators

                </div>

                <div class="text-5xl font-bold text-indigo-600">

                    {{ $totalValidators }}

                </div>

            </div>

            {{-- CORPUS --}}
            <div class="bg-white rounded-3xl shadow p-7">

                <div class="text-sm text-gray-500 mb-3">

                    Total Corpus

                </div>

                <div class="text-5xl font-bold text-green-600">

                    {{ $totalCorpus }}

                </div>

            </div>

            {{-- DICTIONARY --}}
            <div class="bg-white rounded-3xl shadow p-7">

                <div class="text-sm text-gray-500 mb-3">

                    Dictionary Entries

                </div>

                <div class="text-5xl font-bold text-yellow-500">

                    {{ $totalDictionary }}

                </div>

            </div>

        </div>

        {{-- DATASET STATUS --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">

            {{-- CORPUS STATUS --}}
            <div class="bg-white rounded-3xl shadow p-8">

                <h2 class="text-2xl font-bold mb-8">

                    Corpus Status

                </h2>

                <div class="space-y-6">

                    <div>

                        <div class="flex justify-between mb-2">

                            <span class="text-gray-600">

                                Approved Corpus

                            </span>

                            <span class="font-semibold text-green-600">

                                {{ $approvedCorpus }}

                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-4">

                            <div
                                class="bg-green-500 h-4 rounded-full"
                                style="width: 80%"></div>

                        </div>

                    </div>

                    <div>

                        <div class="flex justify-between mb-2">

                            <span class="text-gray-600">

                                Pending Corpus

                            </span>

                            <span class="font-semibold text-yellow-500">

                                {{ $pendingCorpus }}

                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-4">

                            <div
                                class="bg-yellow-400 h-4 rounded-full"
                                style="width: 40%"></div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- DICTIONARY STATUS --}}
            <div class="bg-white rounded-3xl shadow p-8">

                <h2 class="text-2xl font-bold mb-8">

                    Dictionary Status

                </h2>

                <div class="space-y-6">

                    <div>

                        <div class="flex justify-between mb-2">

                            <span class="text-gray-600">

                                Approved Dictionary

                            </span>

                            <span class="font-semibold text-indigo-600">

                                {{ $approvedDictionary }}

                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-4">

                            <div
                                class="bg-indigo-500 h-4 rounded-full"
                                style="width: 70%"></div>

                        </div>

                    </div>

                    <div>

                        <div class="flex justify-between mb-2">

                            <span class="text-gray-600">

                                Total Admin

                            </span>

                            <span class="font-semibold text-red-500">

                                {{ $totalAdmins }}

                            </span>

                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-4">

                            <div
                                class="bg-red-400 h-4 rounded-full"
                                style="width: 20%"></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- MANAGEMENT ACTIONS --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @role('admin|validator')

<a
    href="/sentences"
    class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

    <h2 class="text-2xl font-bold mb-4">

        Sentences Management

    </h2>

    <p class="text-gray-600 mb-6">

        Moderasi dan manajemen
        dataset corpus internal.

    </p>

    <div class="text-indigo-600 font-semibold">

        Open Sentences →

    </div>

</a>

@endrole

            <a
                href="/admin/users"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-4">

                    User Approval

                </h2>

                <p class="text-gray-600 mb-6">

                    Kelola persetujuan akun user
                    dan aktivasi akses platform.

                </p>

                <div class="text-indigo-600 font-semibold">

                    Open User Management →

                </div>

            </a>
            {{-- EXPORT --}}
            <a
                href="/export/corpus/csv"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-4">

                    Export Dataset

                </h2>

                <p class="text-gray-600 mb-6">

                    Download approved corpus
                    untuk research dan NLP training.

                </p>

                <div class="text-indigo-600 font-semibold">

                    Export CSV →

                </div>

            </a>

            {{-- VALIDATION --}}
            <a
                href="/validation-dashboard"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-4">

                    Validation Center

                </h2>

                <p class="text-gray-600 mb-6">

                    Moderasi dan validasi
                    dataset crowdsourcing.

                </p>

                <div class="text-indigo-600 font-semibold">

                    Open Validation →

                </div>

            </a>

            {{-- TRANSLATOR --}}
            <a
                href="/translate"
                class="bg-white rounded-3xl shadow p-8 hover:shadow-xl transition">

                <h2 class="text-2xl font-bold mb-4">

                    Translator Engine

                </h2>

                <p class="text-gray-600 mb-6">

                    Gunakan dan evaluasi
                    translation engine platform.

                </p>

                <div class="text-indigo-600 font-semibold">

                    Open Translator →

                </div>

            </a>

        </div>

    </div>

</div>

</x-app-layout>