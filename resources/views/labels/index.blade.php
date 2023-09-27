<x-app-layout>

    <x-slot name='header'>


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
                        <th scope="col" colspan="2" class="px-6 py-3">
                            Operations
                        </th>

                    </tr>
                </thead>
                <tbody>


                    @foreach ($labels as $key => $label)
                        @if ($key % 2 == 0)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $key }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $label->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('labels.edit', $label) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <x-button variant="primary"> Edit</x-button></a>
                                </td>



                                <td class="px-6 py-4">
                                    <x-button variant="danger" x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-label-deletion')">
                                    {{ __('Delete') }}
                                </x-button>
                                </td>
                            </tr>
                        @else
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">

                                <td class="px-6 py-4">
                                    {{ $key }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $label->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('labels.edit', $label) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <x-button variant="primary"> Edit</x-button></a>
                                </td>



                                <td class="px-6 py-4">
                                    <x-button variant="danger" x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-label-deletion')">
                                    {{ __('Delete') }}
                                </x-button>
                                <x-modal name="confirm-label-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                    <form method="POST" action="{{ route('labels.destroy', $label) }}"
                                        class="p-6">
                                        @csrf
                                        @method('DELETE')
                                        <h2 class="text-lg font-medium">
                                            Are you sure you want to delete this label?
                                        </h2>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ __('Once Label deleted, all of its resources and data will be permanently deleted.') }}
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
                            </tr>
                        @endif
                    @endforeach


                </tbody>
            </table>
        </div>
    </x-slot>
</x-app-layout>
