<x-app-layout>

<div class="max-w-7xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">
        Validation Dashboard
    </h1>

    @foreach($sentences as $sentence)

    <div class="bg-white shadow rounded p-6 mb-6">

        <div class="mb-4">

            <h2 class="font-bold mb-2">
                Indonesia
            </h2>

            <p>
                {{ $sentence->source_text }}
            </p>

        </div>

        <div class="mb-4">

            <h2 class="font-bold mb-2">
                Komering
            </h2>

            <p>
                {{ $sentence->target_text }}
            </p>

        </div>

        <form
            method="POST"
            action="{{ route('validation.process', $sentence->id) }}">

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