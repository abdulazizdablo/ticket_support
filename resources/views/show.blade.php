<x-app-layout>
    <x-slot name='header'>

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
                            Priority
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Label
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>

                        </th>
                        <th scope="col" class="px-6 py-3">
                            Files
                        </th>
                    </tr>
                </thead>
                <tbody>


                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
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
                            @foreach ($ticket->labels as $label)
                                {{ $label->name }}
                            @endforeach
                        </td>

                        <td class="px-6 py-4">
                            @foreach ($ticket->categories as $category)
                                {{ $category->name }}
                            @endforeach
                        </td>

                        <td class="px-6 py-4">
                            {{ $ticket->files }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('tickets.edit', $ticket) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
        <form action="{{ route('comments.store') }}" method="POST" >
            @csrf
            <div class="mb-6">
                <label for="comment"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add Comment</label>
                <textarea type="text" rows="5" id="comment" name="comment"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
      </textarea>
            </div>
        </form>
    </x-slot>
</x-app-layout>