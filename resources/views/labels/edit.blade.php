<x-app-layout>
    <x-slot name='header'>

        <div class=" mb-3 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            NO#
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                    </tr>
                </thead>
                <tbody>


                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $label->id }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('labels.show', $label) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $label->name }}</a>
                        </th>
                     
                       



                    </tr>


                </tbody>
            </table>
        </div>


        <form action="{{ route('labels.update', $label) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6 mt-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Label
                    Name</label>
                <input type="text" id="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-50 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Label Name" required>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </x-slot>
</x-app-layout>
