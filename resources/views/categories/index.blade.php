<x-app-layout>

    <x-slot name='header'>
        <a href="{{ route('categories.create') }}" class=" mb-2"><button type="submit"
            class="text-white bg-blue-700   mb-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
            Category</button></a>

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


                    @foreach ($categories as $key => $category)
                        @if ($key % 2 == 0)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $key }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $category->name }}
                                </td>

                            </tr>
                        @else
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $key }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $category->name }}
                                </td>
                        @endif
                    @endforeach


                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>
