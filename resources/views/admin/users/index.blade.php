<x-app-layout>

<div class="max-w-7xl mx-auto py-10 px-4">

    <h1 class="text-4xl font-bold mb-8">

        User Approval Management

    </h1>

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-4 text-left">

                        Name

                    </th>

                    <th class="px-6 py-4 text-left">

                        Email

                    </th>

                    <th class="px-6 py-4 text-left">

                        Status

                    </th>

                    <th class="px-6 py-4 text-right">

                        Action

                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                <tr class="border-t">

                    <td class="px-6 py-5">

                        {{ $user->name }}

                    </td>

                    <td class="px-6 py-5">

                        {{ $user->email }}

                    </td>

                    <td class="px-6 py-5">

                        {{ $user->status }}

                    </td>

                    <td class="px-6 py-5 text-right">

                    @if($user->status !== 'active')

                    <form
                        method="POST"
                        action="{{ route('admin.users.approve', $user) }}">

                        @csrf

                        @method('PATCH')

                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 transition text-white px-5 py-2 rounded-xl">

                            Approve

                        </button>

                    </form>

                    @endif

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>