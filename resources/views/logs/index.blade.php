<x-app-layout>

    <x-slot name='header'>





        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Created By
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Updated By
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Created at
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Updated at
                        </th>

                    </tr>
                </thead>
                <tbody>



                    @foreach ($logs as $key => $log)
                        @if ($key % 2 == 0)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                    {{ $log->created_by }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $log->updated_by }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $log->created_at->diffForHumans() }}
                                </td>


                                <td class="px-6 py-4">

                                    @if ($log->updated_at)
                                        {{ $log->updated_at->diffForHumans() }}
                                    @endif
                                </td>




                            </tr>
                        @else
                            <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                    {{ $log->created_by }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $log->updated_by }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $log->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4">


                                    @if ($log->updated_at)
                                        {{ $log->updated_at->diffForHumans() }}
                                    @endif
                                </td>





                            </tr>
                        @endif
                    @endforeach



                </tbody>
            </table>
        </div>
        {{ $logs->links() }}
    </x-slot>
</x-app-layout>
