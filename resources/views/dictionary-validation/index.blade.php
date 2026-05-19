<x-app-layout>

<div class="max-w-7xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-6">
        Dictionary Validation
    </h1>

    @foreach($words as $word)

    <div class="bg-white shadow rounded p-6 mb-6">

        <div class="mb-3">

            <strong>Indonesia:</strong>

            {{ $word->word_source }}

        </div>

        <div class="mb-3">

            <strong>Komering:</strong>

            {{ $word->word_target }}

        </div>

        <div class="mb-6">

            <strong>Contoh:</strong>

            {{ $word->example_sentence }}

        </div>

        <form
            method="POST"
            action="{{ route(
                'dictionary.validation.process',
                $word->id
            ) }}">

            @csrf

            <textarea
                name="notes"
                class="w-full border rounded p-3 mb-4"
                placeholder="Validator notes"></textarea>

            <div class="flex gap-4">

                <button
                    type="submit"
                    name="action"
                    value="approve"
                    class="bg-green-600 text-white px-4 py-2 rounded">

                    Approve

                </button>

                <button
                    type="submit"
                    name="action"
                    value="reject"
                    class="bg-red-600 text-white px-4 py-2 rounded">

                    Reject

                </button>

            </div>

        </form>

    </div>

    @endforeach

</div>

</x-app-layout>