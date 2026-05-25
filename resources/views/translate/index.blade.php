<x-app-layout>

<div class="min-h-screen bg-gray-100 py-14">

<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- HEADER --}}
    <div class="text-center mb-10">

        <h1 class="text-4xl font-bold text-gray-900 mb-2">

            Komering Translator

        </h1>

        <p class="text-gray-500">

            Indonesia ↔ Komering Translation

        </p>

    </div>

    {{-- TRANSLATOR --}}
    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden">

        {{-- TOP BAR --}}
        <div class="grid grid-cols-[1fr_auto_1fr] border-b border-gray-200">

            {{-- LEFT --}}
            <div class="px-6 py-4 flex items-center">

                <span class="font-semibold text-gray-700">

                    Input

                </span>

            </div>

            {{-- SWAP --}}
            <div class="flex items-center justify-center border-x border-gray-200">

                <!-- <button
                    id="swap_language"
                    type="button"
                    class="w-10 h-10 rounded-full hover:bg-gray-100 transition flex items-center justify-center text-gray-600 text-lg">

                    ⇄

                </button> -->

            </div>

            {{-- RIGHT --}}
            <div class="px-6 py-4 flex items-center justify-between">

                <span class="font-semibold text-gray-700">

                    Result

                </span>

                <select
                    id="translation_direction"
                    class="text-sm border-none focus:ring-0 text-gray-500 bg-transparent">

                    <option value="id_to_kom">

                        ID → KOM

                    </option>

                    <option value="kom_to_id">

                        KOM → ID

                    </option>

                </select>

            </div>

        </div>

        {{-- BODY --}}
        <div class="grid lg:grid-cols-2">

            {{-- INPUT --}}
            <div class="border-b lg:border-b-0 lg:border-r border-gray-200 flex flex-col">

                <textarea
                    type="text"
                    id="translateInput"
                    rows="12"
                    placeholder="Ketik teks..."
                    class="w-full flex-1 p-6 text-xl resize-none border-none focus:ring-0"></textarea>
                <!-- <div
                    id="autocompleteResults"
                    class="bg-white border border-gray-200 rounded-2xl shadow-lg mt-2 hidden"
                ></div> -->
                {{-- BUTTON --}}
                <div class="p-4 border-t border-gray-100">

                    <!-- <button
                        id="translate_button"
                        type="button"
                        class="bg-indigo-600 hover:bg-indigo-700 transition text-white px-6 py-3 rounded-2xl font-semibold">

                        Translate

                    </button> -->

                </div>

            </div>

            {{-- OUTPUT --}}
            <div
                id="autocompleteResults"
                class="p-6 text-xl text-gray-800 min-h-[320px] overflow-auto">

                <div class="text-gray-400">

                    Hasil translation...

                </div>

            </div>

        </div>

    </div>

</div>

</div>

<script>

// const sourceText =
//     document.getElementById('source_text');

// const resultBox =
//     document.getElementById('translation_result');

// const direction =
//     document.getElementById('translation_direction');

// const translateButton =
//     document.getElementById('translate_button');

// const swapButton =
//     document.getElementById('swap_language');

// async function translateText()
// {
//     const text = sourceText.value;

//     if(text.trim() === '')
//     {
//         resultBox.innerHTML = `
//             <div class="text-gray-400">
//                 Hasil translation akan muncul di sini...
//             </div>
//         `;

//         return;
//     }

//     resultBox.innerHTML = `
//         <div class="text-indigo-500">
//             Translating...
//         </div>
//     `;

//     try {

//         const response = await fetch(
//             '/translate/live',
//             {

//                 method: 'POST',

//                 headers: {

//                     'Content-Type':
//                         'application/json',

//                     'X-CSRF-TOKEN':
//                         '{{ csrf_token() }}',

//                     'Accept':
//                         'application/json'
//                 },

//                 body: JSON.stringify({

//                     text: text,

//                     direction: direction.value

//                 })

//             }
//         );

//         const data =
//             await response.json();

//         resultBox.innerHTML = `

//             <div class="text-gray-800 leading-relaxed text-lg">

//                 ${data.translation}

//             </div>

//         `;

//     } catch(error) {

//         resultBox.innerHTML = `

//             <div class="text-red-500">

//                 Translation failed

//             </div>

//         `;

//         console.error(error);
//     }
// }

// translateButton.addEventListener(
//     'click',
//     translateText
// );

// sourceText.addEventListener(
//     'keyup',
//     () => {

//         clearTimeout(window.translateTimeout);

//         window.translateTimeout =
//             setTimeout(() => {

//                 translateText();

//             }, 500);
//     }
// );

// swapButton.addEventListener(
//     'click',
//     async () => {

//         const currentInput =
//             sourceText.value;

//         const currentOutput =
//             resultBox.innerText.trim();

//         if(
//             direction.value ===
//             'id_to_kom'
//         ) {

//             direction.value =
//                 'kom_to_id';

//         } else {

//             direction.value =
//                 'id_to_kom';
//         }

//         if(
//             currentOutput &&
//             currentOutput !==
//             'Hasil translation...'
//         ) {

//             sourceText.value =
//                 currentOutput;
//         }

//         await translateText();
//     }
// );

const input = document.getElementById(
    'translateInput'
);

const resultsBox = document.getElementById(
    'autocompleteResults'
);

let debounce;

input.addEventListener(
    'input',
    function()
{

    clearTimeout(debounce);

    debounce = setTimeout(
        async () =>
    {

        const query = input.value;

        if(query.length < 1){

            resultsBox.classList.add(
                'hidden'
            );

            return;
        }

        const response = await fetch(

            `/translate/autocomplete?q=${query}`

        );

        const data = await response.json();

        resultsBox.innerHTML = '';

        if(data.length === 0){

            resultsBox.classList.add(
                'hidden'
            );

            return;
        }

        data.forEach(item => {

            resultsBox.innerHTML += `

                <div
                    class="p-4 hover:bg-gray-50 cursor-pointer border-b"
                >

                    <div class="font-semibold">
                       ${item.lemma.replace(

                            new RegExp(query, 'gi'),

                            match => `<strong>${match}</strong>`
                        )}
                    </div>

                    <div class="text-sm text-gray-500">
                        ${item.meaning}
                    </div>

                </div>
            `;
        });

        resultsBox.classList.remove(
            'hidden'
        );

    }, 250);
});
</script>

</x-app-layout>