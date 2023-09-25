<x-app-layout>

    <x-slot name='header'>


        @if (Session::has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium"> {{ session('message') }}</span>
            </div>
        @endif



        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No#
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>


                    </tr>
                </thead>
                <tbody>


                    @foreach ($labels as $key => $label)
                        @if ($key % 2 == 0)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $key }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $label->name }}
                                </td>

                            </tr>
                        @else
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $key }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $label->name }}
                                </td>
                        @endif
                    @endforeach


                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>
