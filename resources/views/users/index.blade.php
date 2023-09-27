<x-app-layout>

    <x-slot name='header'>
        @if (Session::has('message'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium"> {{ session('message') }}</span>
        </div>
    @endif

        <a href="{{ route('users.create') }}" class=" mb-2"><button type="submit"
                class="text-white bg-blue-700   mb-3 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                User</button></a>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>


                    </tr>
                </thead>
                <tbody>



                    @foreach ($users as $key => $user)
                        @if ($key % 2 == 0)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                    {{ $user->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>


                                <td class="px-6 py-4">
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <x-button variant="primary"> Edit</x-button></a>
                                </td>



                                <td class="px-6 py-4">
                                    <x-button variant="danger" x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                        {{ __('Delete') }}
                                    </x-button>
                                   
                                </td>



                            </tr>
                        @else
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                    {{ $user->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>



                                <td class="px-6 py-4">
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <x-button variant="primary"> Edit</x-button></a>
                                </td>



                                <td class="px-6 py-4">
                                    <x-button variant="danger" x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                        {{ __('Delete') }}
                                    </x-button>
                                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                        <form method="POST" action="{{ route('users.destroy', $user) }}"
                                            class="p-6">
                                            @csrf
                                            @method('DELETE')
                                            <h2 class="text-lg font-medium">
                                                Are you sure you want to delete this user?
                                            </h2>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                {{ __('Once user deleted, all of its resources and data will be permanently deleted.') }}
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
        {{ $users->links() }}
    </x-slot>
</x-app-layout>
