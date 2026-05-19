<x-app-layout>

<div class="max-w-4xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Kata Baru
    </h1>

    <form method="POST"
        action="{{ route('dictionary.store') }}">

        @csrf

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Bahasa Indonesia
            </label>

            <input
                type="text"
                name="word_source"
                class="w-full border rounded p-3"
                required>

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Bahasa Komering
            </label>

            <input
                type="text"
                name="word_target"
                class="w-full border rounded p-3"
                required>

        </div>

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Contoh Kalimat
            </label>

            <textarea
                name="example_sentence"
                class="w-full border rounded p-3"
                rows="4"></textarea>

        </div>

        <button
            type="submit"
            class="bg-black text-white px-6 py-3 rounded">

            Submit Kata

        </button>

    </form>

</div>

</x-app-layout>