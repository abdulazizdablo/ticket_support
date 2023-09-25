<x-app-layout>

    <x-slot name="header">



        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ticket Title" required>
            </div>
            <div class="mb-6">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea type="text" rows="10" id="description" name="description" value="{{ old('description') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
      </textarea>
            </div>



            <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Labels</h3>
            <div class="flex  items-start content-center mb-6">
                @foreach ($labels as $label)
                    <div class="flex justify-evenly items-center ml-3 h-5">
                        <input id={{ $label->name }} type="checkbox" value={{ $label->id }} name="label[]"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                        <label for={{ $label->name }}
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label->name }}</label>
                    </div>
                @endforeach
            </div>

            <!--     <div class="flex justify-evenly ml-3 items-center h-5">

                <input id="question" type="checkbox" value="question" name="label[]"
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                <label for="question" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">question</label>
            </div>
            <div class="flex justify-evenly   ml-3  items-center h-5">

                <input id="enhancment" type="checkbox" value="enhancment" name="label[]"
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                <label for="enhancment"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">enhancment</label>
            </div>





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
        -->

            <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Categories</h3>
            <div class="flex items-start content-center mb-6">
                @foreach ($categories as $category)
                    <div class="flex items-center ml-3 h-5">
                        <input id="{{ $category->name }}" type="checkbox" value="{{ $category->id }}"
                            name="category[]"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                        <label for="{{ $category->name }}"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">"{{ $category->name }}"</label>
                    </div>
                @endforeach



                <!--    <div class="flex  ml-3 items-center h-5">

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


            </div>-->

                <label for="priority" class="mt-2">Priority</label>

                <select
                    class=" mb-2 block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="priority" name="priority" value="{{ old('priority') }}">

                    @foreach (App\Enums\Priorities::cases() as $priority)
                        <option value="{{ $priority->value }}">{{ $priority->value }}</option>
                    @endforeach

                </select>


                <label for="status" class="mb-2">Status</label>

                <select
                    class="block mt-2 appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="status_id" name="status_id">

                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ ucfirst($status->name) }}</option>
                    @endforeach

                </select>



                @if ($errors->has('files.*'))
                    @foreach ($errors->get('files.*') as $errors)
                        @foreach ($errors as $error)
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400"
                                role='alert'>{{ $error }}</div>
                        @endforeach
                    @endforeach
                @endif

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="multiple_files">Upload
                    multiple files</label>

                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="multiple_files" name="files[]" type="file" multiple required>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PDF,DOCX,CSV,XLSX</p>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </x-slot>
</x-app-layout>
