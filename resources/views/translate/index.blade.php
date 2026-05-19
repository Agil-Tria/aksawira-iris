<x-app-layout>

<div class="min-h-screen bg-gray-100 py-14">

    <div class="max-w-7xl mx-auto px-6">

        {{-- HEADER --}}
        <div class="text-center mb-12">

            <h1 class="text-6xl font-bold text-gray-900 mb-4">
                Komering Translator
            </h1>

            <p class="text-xl text-gray-600">
                Terjemahkan Bahasa Indonesia ↔ Komering
            </p>

        </div>

        {{-- TRANSLATOR CARD --}}
        <form
            method="POST"
            action="{{ route('translate.process') }}">

            @csrf

            <div class="bg-white rounded-3xl shadow-xl p-10">

                {{-- TOP LANGUAGE BAR --}}
                <div class="flex items-center justify-center gap-5 mb-10">

                    <div class="w-72">

                        <label class="block mb-2 font-semibold text-gray-700">

                            Dari

                        </label>

                        <select
                            id="direction"
                            name="direction"
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-lg focus:ring-2 focus:ring-indigo-500">

                            <option
                                value="id_to_komering"
                                @selected(old('direction') == 'id_to_komering')>

                                Indonesia → Komering

                            </option>

                            <option
                                value="komering_to_id"
                                @selected(old('direction') == 'komering_to_id')>

                                Komering → Indonesia

                            </option>

                        </select>

                    </div>

                    {{-- SWAP BUTTON --}}
                    <div class="pt-8">

                        <button
                            type="button"
                            onclick="swapDirection()"
                            class="bg-indigo-100 hover:bg-indigo-200 transition rounded-2xl w-16 h-16 text-2xl text-indigo-700 font-bold shadow">

                            ↔

                        </button>

                    </div>

                </div>

                {{-- TRANSLATION AREA --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    {{-- INPUT --}}
                    <div>

                        <h2 class="text-xl font-semibold mb-4 text-gray-800">

                            Input Text

                        </h2>

                        <div class="relative">
                            <textarea
                                id="inputText"
                                name="text"
                                rows="14"
                                class="w-full bg-gray-50 border border-gray-200 rounded-3xl p-6 text-lg focus:ring-2 focus:ring-indigo-500 resize-none"
                                placeholder="Tulis kalimat di sini...">{{ old('text') }}</textarea>
                            <button
                                type="button"
                                onclick="clearInput()"
                                class="absolute bottom-5 right-5 bg-white border border-gray-200 hover:bg-gray-100 transition px-4 py-2 rounded-xl text-sm shadow">
                                Clear
                            </button>
                        </div>
                    </div>

                    {{-- OUTPUT --}}
                    <div>

                        <h2 class="text-xl font-semibold mb-4 text-gray-800">

                            Translation Result

                        </h2>

                        <div class="relative bg-gray-50 border border-gray-200 rounded-3xl p-6 min-h-[360px]">
                            @isset($result)
                              <button
                                    type="button"
                                    onclick="copyResult()"
                                    class="absolute top-5 right-5 bg-white border border-gray-200 hover:bg-gray-100 transition px-4 py-2 rounded-xl text-sm shadow">

                                    Copy
                                </button>
                                <p
                                    id="translationResult"
                                    class="text-xl text-gray-900 leading-relaxed">
                                    {{ $result }}
                                </p>
                            @else
                                <div class="h-full flex items-center justify-center text-gray-400 text-lg text-center">
                                    Hasil translation akan muncul di sini
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="text-center mt-10">

                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-12 py-5 rounded-2xl text-xl font-semibold shadow-lg">

                        Translate Sekarang

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

{{-- SWAP SCRIPT --}}
<script>

function swapDirection() {

    const direction =
        document.getElementById('direction');

    if (
        direction.value === 'id_to_komering'
    ) {

        direction.value =
            'komering_to_id';

    } else {

        direction.value =
            'id_to_komering';
    }
}

</script>

<div
    id="copyNotification"
    class="fixed bottom-6 right-6 bg-black text-white px-5 py-3 rounded-2xl shadow-xl hidden z-50">

    Hasil translation berhasil disalin

</div>

<script>

function swapDirection() {

    const direction =
        document.getElementById('direction');

    if (
        direction.value === 'id_to_komering'
    ) {

        direction.value =
            'komering_to_id';

    } else {

        direction.value =
            'id_to_komering';
    }
}

function clearInput() {

    document.getElementById(
        'inputText'
    ).value = '';
}

function copyResult() {

    const text =
        document.getElementById(
            'translationResult'
        ).innerText;

    navigator.clipboard.writeText(text);

    const notif =
        document.getElementById(
            'copyNotification'
        );

    notif.classList.remove('hidden');

    setTimeout(() => {

        notif.classList.add('hidden');

    }, 2000);
}

</script>

</x-app-layout>