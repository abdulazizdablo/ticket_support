<x-app-layout>
    <x-slot name='header'>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
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
                        @can('manage-dashboard')
                            <td class="px-6 py-4">
                                <a href="{{ route('tickets.edit', $ticket) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        @endcan
                    </tr>


                </tbody>
            </table>
        </div>

        <h3 class="mb-4 mt-4">Comments on this ticket</h3>






        <div class="max-w-sm rounded overflow-hidden shadow-lg mt-6 mb-6">

            <div class="px-6 py-4 mt-3">
                <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                <p class="text-gray-700 text-base">

                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <span
                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>

            </div>
        </div>




        <div class="mb-6 mt-6">



            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add
                    Comment</label>
                <textarea type="text" rows="5" id="comment" name="comment"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
      </textarea>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
            Comment</button>

        </form>
    </x-slot>
</x-app-layout>
