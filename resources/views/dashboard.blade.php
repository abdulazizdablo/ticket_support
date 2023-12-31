<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
    
        </div>
@can('manage-dashboard')
<div class="flex justify-evenly items-center">
    <div class=" flex flex-col items-center">
        <h2>Total Tickets</h2>
        <p class="font-medium">  {{ $tickets_total_count }}</p>
    </div>
    <div class=" flex flex-col items-center">
        <h2>Opened Tickets</h2>
        <p class="font-medium">       {{ $tickets_opened_count }}</p>
    </div>
    <div class=" flex flex-col items-center">
        <h2>Closed Tickets</h2>
       <p class="font-medium"> {{ $tickets_closed_count }}</p>
    </div>
</div>
@endcan
       



    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{ __("You're logged in!") }}
    </div>
</x-app-layout>
