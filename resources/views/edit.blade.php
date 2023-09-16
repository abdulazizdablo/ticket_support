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


        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="title" name="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ticket Title" required>
            </div>
            <div class="mb-6">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea type="text" rows="10" id="description" name="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
      </textarea>
            </div>


            <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Labels</h3>

            <div class="flex  items-start content-center mb-6">

                <div class="flex justify-evenly items-center ml-3 h-5">
                    <input id="bug" type="checkbox" value="bug" name="label[]"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    <label for="bug" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">bug</label>
                </div>
                <div class="flex justify-evenly ml-3 items-center h-5">

                    <input id="question" type="checkbox" value="question" name="label[]"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    <label for="question"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">question</label>
                </div>
                <div class="flex justify-evenly   ml-3  items-center h-5">

                    <input id="enhancment" type="checkbox" value="enhancment" name="label[]"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    <label for="enhancment"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">enhancment</label>
                </div>


            </div>


            <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Categories</h3>

            <div class="flex items-start content-center mb-6">

                <div class="flex items-center ml-3 h-5">
                    <input id="uncategorized" type="checkbox" value="uncategorized" name="category[]"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    <label for="uncategorized"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Uncategorized</label>
                </div>
                <div class="flex   ml-3    items-center h-5">

                    <input id="billing\payment" type="checkbox" value="billing\payment" name="category[]"
                        class="w-4 h-4  border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    <label for="billing\payment"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Billing\Payment</label>
                </div>
                <div class="flex justify-evenly   ml-3  items-center h-5">

                    <input id="technical_question" type="checkbox" value="technical_question" name="category[]"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    <label for="technical_question"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Technical question</label>
                </div>


            </div>


            <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agents</h3>

            <select
                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="agent_id" name="agent_id">

                @foreach ($agents as $agent)
                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                @endforeach

            </select>

            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload
                multiple files</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="multiple_files" name="files[]" type="file" multiple>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PDF,DOCX,CSV,XLSX</p>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </x-slot>
</x-app-layout>
