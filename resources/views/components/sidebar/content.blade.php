<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.dropdown
        title="Buttons"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Text button"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
        <x-sidebar.sublink
            title="Icon button"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')"
        />
        <x-sidebar.sublink
            title="Text with icon"
            href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')"
        />
    </x-sidebar.dropdown>

    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
      
    </div>


   

   
    <x-sidebar.link title="Tickets" href="{{route('tickets.index')}}"><x-slot name="icon">
        <x-icons.ticket class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot></x-sidebar.link>
@can('manage-dashboard')
    <x-sidebar.link title="Categories" href="#"><x-slot name="icon">
        <x-icons.categories class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot></x-sidebar.link>

    <x-sidebar.link title="Labels" href="#"><x-slot name="icon">
        <x-icons.label class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot></x-sidebar.link>


    <x-sidebar.link title="Users" href="#"><x-slot name="icon">
        <x-icons.users class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot></x-sidebar.link>

    <x-sidebar.link title="Ticket Logs" href="#"><x-slot name="icon">
        <x-icons.ticket_logs class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
    </x-slot></x-sidebar.link>

@endcan


</x-perfect-scrollbar>
