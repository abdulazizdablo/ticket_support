<x-app-layout>

    <x-slot name="header">
        <form action="{{route('tickets.store')}}" method="POST">
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

            <div class="flex justify-evenly content-center mb-6">

                <div class="flex justify-evenly items-center ml-3 h-5">
                    <input id="bug" type="radio" value="bug" name="label"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                        required>
                    <label for="bug" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">bug</label>
                </div>
                <div class="flex justify-evenly ml-3 items-center h-5">

                    <input id="question" type="radio" value="question" name="label"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                        required>
                    <label for="question"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">question</label>
                </div>
                <div class="flex justify-evenly   ml-3  items-center h-5">

                    <input id="enhancment" type="radio" value="enhancment" name="label"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                        required>
                    <label for="enhancment"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">enhancment</label>
                </div>


            </div>


            <h3 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Categories</h3>

            <div class="flex justify-evenly content-center mb-6">

                <div class="flex justify-evenly items-center ml-3 h-5">
                    <input id="uncategorized" type="radio" value="uncategorized" name="category"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                        required>
                    <label for="uncategorized"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Uncategorized</label>
                </div>
                <div class="flex justify-evenly  ml-3    items-center h-5">

                    <input id="billing\payment" type="radio" value="question" name="category"
                        class="w-4 h-4  border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                        required>
                    <label for="billing\payment"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Billing\Payment</label>
                </div>
                <div class="flex justify-evenly   ml-3  items-center h-5">

                    <input id="technical_question" type="radio" value="technical_question" name="category"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                        required>
                    <label for="technical_question"
                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Technical question</label>
                </div>


            </div>


            <select
                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="status">

                @foreach (App\Enums\Priorities::cases() as $priority)
                    <option value="{{ $priority->value }}">{{ $priority->value }}</option>
                @endforeach

            </select>

            <div class="mb-6 pt-4">
                <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                    Upload File
                </label>

                <div class="mb-8">
                    <input type="file" name="file" id="file" class="sr-only" />
                    <label for="file"
                        class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                        <div>
                            <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                Drop files here
                            </span>
                            <span class="mb-2 block text-base font-medium text-[#6B7280]">
                                Or
                            </span>
                            <span
                                class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                Browse
                            </span>
                        </div>
                    </label>
                </div>

                <div class="mb-5 rounded-md bg-[#F5F7FB] py-4 px-8">
                    <div class="flex items-center justify-between">


                    </div>
                </div>

            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </x-slot>
</x-app-layout>
