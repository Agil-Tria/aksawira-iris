<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Aksawira Iris</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50 text-gray-900">

    @include('layouts.navigation')

    <section class="max-w-7xl mx-auto px-6 py-24">

        <div class="grid md:grid-cols-2 gap-16 items-center">

            <div>

                <h1 class="text-6xl font-bold leading-tight mb-6">

                    Digitalisasi Bahasa Komering
                    untuk Masa Depan

                </h1>

                <p class="text-xl text-gray-600 mb-8">

                    Platform crowdsourcing corpus,
                    kamus, dan translation engine
                    Bahasa Komering berbasis komunitas.

                </p>

                <div class="flex gap-4">

                    <a href="/translate"
                        class="bg-black text-white px-6 py-4 rounded-lg">

                        Mulai Translate

                    </a>

                    <a href="/dictionary"
                        class="border border-black px-6 py-4 rounded-lg">

                        Lihat Kamus

                    </a>

                </div>

            </div>

            <div class="bg-white shadow-xl rounded-2xl p-10">

                <div class="grid grid-cols-2 gap-6">

                    <div class="bg-gray-100 rounded-xl p-6">

                        <h2 class="text-4xl font-bold mb-2">

                            {{ $totalCorpus }}

                        </h2>

                        <p class="text-gray-600">

                            Approved Corpus

                        </p>

                    </div>

                    <div class="bg-gray-100 rounded-xl p-6">

                        <h2 class="text-4xl font-bold mb-2">

                            {{ $totalDictionary }}

                        </h2>

                        <p class="text-gray-600">

                            Dictionary Entries

                        </p>

                    </div>

                    <div class="bg-gray-100 rounded-xl p-6 col-span-2">

                        <h2 class="text-2xl font-bold mb-2">

                            Community Driven

                        </h2>

                        <p class="text-gray-600">

                            Dibangun bersama komunitas,
                            penutur asli, dan kontributor.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

</body>

</html>