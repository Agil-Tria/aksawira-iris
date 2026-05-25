<x-app-layout>

<div class="max-w-7xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-6">
        Dictionary Validation
    </h1>
    @if($errors->any())

    <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-2xl mb-6">

        <ul>

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

    @foreach($words as $word)

    <div class="bg-white shadow rounded p-6 mb-6">

        <div class="mb-3">

            <strong>Indonesia:</strong>

            {{ $word->meaning }}

        </div>

        <div class="mb-3">

            <strong>Komering:</strong>

            {{ $word->lemma }}

        </div>

        <div class="mb-6">

            <strong>Contoh:</strong>

            

        </div>

            <form
                method="POST"
                action="{{ route('dictionary.validation.process', $word->id) }}">

                @csrf

                <textarea
                    name="notes"
                    placeholder="Validator notes"
                    class="w-full border rounded-xl p-4 mb-4"
                ></textarea>

                <div class="flex gap-3">

                    <button
                        type="submit"
                        name="action"
                        value="approve"
                        class="bg-green-600 text-white px-5 py-2 rounded-xl"
                    >
                        Approve
                    </button>

                    <button
                        type="submit"
                        name="action"
                        value="reject"
                        class="bg-red-600 text-white px-5 py-2 rounded-xl"
                    >
                        Reject
                    </button>

                </div>

            </form>

    </div>

    @endforeach

</div>

</x-app-layout>