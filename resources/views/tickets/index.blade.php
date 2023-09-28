<x-app-layout>

    <x-slot name='header'>



        @if (Session::has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium"> {{ session('message') }}</span>
            </div>
        @endif


        <form action="{{ route('tickets.filter') }}" method="GET">
            @csrf
            <label for="grid-state"> Filter by</label>
            <select onchange="this.form.submit()"
                class="block mb-4 mt-1 appearance-none w-8 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-state" name="filter">
                <option value="" disabled selected>Select Filter</option>
                <option value="status_id">Status</option>
                <option value="priority">Priority</option>
                <option value="category">Category</option>
            </select>
        </form>

        <a href="{{ route('tickets.create') }}" class=" mb-2"><button type="submit"
                class="text-white bg-blue-700   mb-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                Ticket</button></a>
        <div class=" mt-4 w-48  relative overflow-x-hidden shadow-md sm:rounded-lg">
            <table class="w-48 text-sm text-left  text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-5 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-5 py-3">
                            Description
                        </th>

                        <th scope="col" class="px-5 py-3">
                            Priority
                        </th>
                        <th scope="col" class="px-5 py-3">
                            Label
                        </th>

                        <th scope="col" class="px-5 py-3">
                            Category
                        </th>

                        <th scope="col" class="px-5 py-3">
                            Files
                        </th>
                        <th scope="col" colspan="2" class="px-5 py-3">
                            Operations
                        </th>
                    </tr>
                </thead>
                <tbody>



                    @foreach ($tickets as $key => $ticket)
                        @if ($key % 2 == 0)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-5 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="{{ route('tickets.show', $ticket) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $ticket->title }}</a>
                                </th>
                                <td class="px-5 py-4">
                                    {{ $ticket->description }}
                                </td>

                                <td class="px-5 py-4">
                                    {{ $ticket->priority }}
                                </td>


                                <td class="px-5 py-4">
                                    @foreach ($ticket->labels as $label)
                                        {{ $label->name }}
                                    @endforeach
                                </td>

                                <td class="px-5 py-4">
                                    @foreach ($ticket->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </td>

                                <td class="px-5 py-4">
                                    {{ $ticket->files }}
                                </td>
                                @can('manage-dashboard')
                                    <td class="px-5 py-4">
                                        <a href="{{ route('tickets.edit', $ticket) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            <x-button variant="primary"> Edit</x-button></a>
                                    </td>



                                    <td class="px-5 py-4">
                                        <x-button variant="danger" x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-ticket-deletion')">
                                            {{ __('Delete') }}
                                        </x-button>
                                        <x-modal name="confirm-ticket-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                            <form method="POST" action="{{ route('tickets.destroy', $ticket) }}"
                                                class="p-6">
                                                @csrf
                                                @method('DELETE')
                                                <h2 class="text-lg font-medium">
                                                    Are you sure you want to delete this ticket?
                                                </h2>
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Once ticket deleted, all of its resources and data will be permanently deleted.') }}
                                                </p>



                                                <div class="mt-6 flex justify-end">
                                                    <x-button type="button" variant="secondary"
                                                        x-on:click="$dispatch('close')">
                                                        {{ __('Cancel') }}
                                                    </x-button>

                                                    <x-button variant="danger" class="ml-3">
                                                        {{ __('Delete') }}
                                                    </x-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                @endcan
                            </tr>
                        @else
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-5 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="{{ route('tickets.show', $ticket) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ $ticket->title }}</a>
                                </th>
                                <td class="px-5 py-4">
                                    {{ $ticket->description }}
                                </td>
                                <td class="px-5 py-4">
                                    {{ $ticket->priority }}
                                </td>
                                <td class="px-5 py-4">
                                    @foreach ($ticket->labels as $label)
                                        {{ $label->name }}
                                    @endforeach
                                </td>

                                <td class="px-5 py-4">
                                    @foreach ($ticket->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </td>

                                <td class="px-5 py-4">
                                    {{ $ticket->files }}
                                </td>
                                @can('manage-dashboard')
                                    <td class="px-5 py-4">
                                        <a href="{{ route('tickets.edit', $ticket) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            <x-button variant="primary"> Edit</x-button></a>
                                    </td>

                                    <td class="px-5 py-4">
                                        <x-button variant="danger" x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-ticket-deletion')">
                                            {{ __('Delete') }}
                                        </x-button>

                                    </td>
                                @endcan
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>
