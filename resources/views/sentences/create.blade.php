<x-app-layout>

    <div class="max-w-4xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">
            Tambah Kalimat Corpus
        </h1>

        <form method="POST" action="{{ route('sentences.store') }}">

            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-2">
                    Kalimat Indonesia
                </label>

                <textarea
                    name="source_text"
                    class="w-full border rounded p-3"
                    rows="4"
                    required></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-2">
                    Kalimat Komering
                </label>

                <textarea
                    name="target_text"
                    class="w-full border rounded p-3"
                    rows="4"
                    required></textarea>
            </div>

            <button
                type="submit"
                class="bg-black text-white px-6 py-3 rounded">

                Submit Corpus

            </button>

        </form>

    </div>

</x-app-layout>