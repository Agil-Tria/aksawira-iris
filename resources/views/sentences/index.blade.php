<x-app-layout>

    <div class="max-w-6xl mx-auto py-10">

        <div class="flex justify-between mb-6">

            <h1 class="text-2xl font-bold">
                Corpus Sentences
            </h1>

            <a
                href="{{ route('sentences.create') }}"
                class="bg-black text-white px-4 py-2 rounded">

                Tambah Corpus

            </a>

        </div>

        <div class="bg-white shadow rounded">

            <table class="w-full">

                <thead>
                    <tr class="border-b">

                        <th class="p-4 text-left">
                            Indonesia
                        </th>

                        <th class="p-4 text-left">
                            Komering
                        </th>

                        <th class="p-4 text-left">
                            Status
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @foreach($sentences as $sentence)

                    <tr class="border-b">

                        <td class="p-4">
                            {{ $sentence->source_text }}
                        </td>

                        <td class="p-4">
                            {{ $sentence->target_text }}
                        </td>

                        <td class="p-4">
                            {{ $sentence->status }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>