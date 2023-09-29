<x-app-layout>
    <x-slot name='header'>
@foreach ($errors->all() as $error )
{{$error}}    
@endforeach
        <div class="mb-3 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="mb-3 w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                     
                    </tr>


                </tbody>
            </table>
        </div>


        <form class="mt-6" action="{{ route('tickets.update',$ticket) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                @foreach ($labels as $label)
                    <div class="flex justify-evenly items-center ml-3 h-5">
                        <input id={{ $label->name }} type="checkbox" value="{{ $label->name }}" name="label[{{ $label->id }}][]"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                        <label for={{ $label->name }}
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label->name }}</label>
                    </div>
                @endforeach
            </div>

         
            <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Categories</h3>
            <div class="flex items-start content-center mb-6">
                @foreach ($categories as $category)
                    <div class="flex items-center ml-3 h-5">
                        <input id={{ $category->name }} type="checkbox" value="{{$category->name }}"
                        name="category[{{ $category->id }}][]"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                        <label for={{ $category->name }}
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
     
            <label for="priority" class="mt-2">Priority</label>

            <select
                class=" mb-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="priority" name="priority" value="{{ old('priority') }}">

                @foreach (App\Enums\Priorities::cases() as $priority)
                    <option value="{{ $priority->value }}">{{ $priority->value }}</option>
                @endforeach

            </select>


                <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agents</h3>

                <select
                    class=" mb-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="agent_id" name="agent_id">


                  

                    @foreach ($agents as $id => $agent)
                        <option value={{ $id }}>{{ $agent }}</option>
                    @endforeach

                </select>
                <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</h3>

                <select
                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="status_id" name="status_id">

                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}">{{ucfirst($status->name) }}</option>
                @endforeach

            </select>

            
            <label class="mt-5 mb-3 block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload
                multiple files</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="multiple_files" name="files[]" type="file" multiple>
            <p class="mt-3 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PDF,DOCX,CSV,XLSX</p>

            <button type="submit"
                class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </x-slot>
</x-app-layout>
