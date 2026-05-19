<x-app-layout>

<div class="min-h-screen bg-gray-100 py-14">

    <div class="max-w-6xl mx-auto px-6">

        <h1 class="text-4xl font-bold mb-10">

            Translation History

        </h1>

        <div class="space-y-6">

            @forelse($histories as $history)

                <div class="bg-white rounded-3xl shadow p-6">

                    <div class="flex justify-between mb-4">

                        <span class="text-sm text-gray-500">

                            {{ $history->created_at
                                ->diffForHumans() }}

                        </span>

                        <span class="bg-indigo-100 text-indigo-700 px-4 py-1 rounded-xl text-sm">

                            {{ $history->direction }}

                        </span>

                    </div>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>

                            <h2 class="font-semibold mb-2">
                                Input
                            </h2>

                            <div class="bg-gray-50 rounded-2xl p-4">

                                {{ $history->input_text }}

                            </div>

                        </div>

                        <div>

                            <h2 class="font-semibold mb-2">
                                Result
                            </h2>

                            <div class="bg-gray-50 rounded-2xl p-4">

                                {{ $history->translated_text }}

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-3xl shadow p-10 text-center text-gray-500">

                    Belum ada riwayat translation

                </div>

            @endforelse

        </div>

        <div class="mt-10">

            {{ $histories->links() }}

        </div>

    </div>

</div>

</x-app-layout>