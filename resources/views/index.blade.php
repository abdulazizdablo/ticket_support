<x-app-layout>

    <x-slot name='header'>

        <label for="grid-state"> Filter by</label>
        <select
            class="block appearance-none w-3 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-state">
            <option>Status</option>
            <option>Priority</option>
            <option>Category</option>
        </select>
        {{ session('message') }}
        <a href="{{ route('tickets.create') }}"><button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                Ticket</button></a>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Label
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Priority
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($tickets as $key => $ticket)
                        @if ($key % 2 == 0)
                            {
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $ticket->description }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $ticket->priority }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $ticket->title }}
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($ticket->labels as $label)
                                        {{ $label->name }}
                                    @endforeach
                                </td>

                                @foreach ($ticket->categories as $category)
                                    {{ $category->name }}
                                @endforeach
                                </td>
                                <td class="px-6 py-4">
                                    {{ $ticket->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $ticket->files }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                            }
                        @else{
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="{{ route('tickets.show', $ticket) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $ticket->title }}</a>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $ticket->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $ticket->priority }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $ticket->files }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>



                            }
                        @endif
                    @endforeach



                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>
