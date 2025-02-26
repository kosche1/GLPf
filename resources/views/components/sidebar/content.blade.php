<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @if(auth()->user()->hasRole('teacher'))
        <x-sidebar.dropdown title="Class Challenges" :active="Str::startsWith(request()->route()->uri(), 'challenges')">
            <x-slot name="icon">
                <x-heroicon-o-academic-cap class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>

            <x-sidebar.sublink title="All Challenges" 
                href="{{ route('challenges.index') }}" 
                :active="request()->routeIs('challenges.index')" />
            
            <x-sidebar.sublink title="Create Challenge" 
                href="{{ route('challenges.create') }}" 
                :active="request()->routeIs('challenges.create')" />
            
            <x-sidebar.sublink title="Student Progress" 
                href="{{ route('challenges.progress') }}" 
                :active="request()->routeIs('challenges.progress')" />
        </x-sidebar.dropdown>
    @endif

    @if(auth()->user()->hasRole('superadmin'))
        <x-sidebar.dropdown title="User Management" :active="Str::startsWith(request()->route()->uri(), ['users', 'roles', 'levels'])">
            <x-slot name="icon">
                <x-heroicon-o-users class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>

            <x-sidebar.sublink title="View All Users" 
                href="{{ route('users.index') }}" 
                :active="request()->routeIs('users.index')" />
            
            <x-sidebar.sublink title="Add New User" 
                href="{{ route('users.create') }}" 
                :active="request()->routeIs('users.create')" />
            
            <x-sidebar.sublink title="Manage Roles" 
                href="{{ route('roles.index') }}" 
                :active="request()->routeIs('roles.index')" />
            
            <x-sidebar.sublink title="Level Management" 
                href="{{ route('levels.index') }}" 
                :active="request()->routeIs('levels.index')" />
            
            <x-sidebar.sublink title="Export Users" 
                href="{{ route('users.export') }}" 
                :active="request()->routeIs('users.export')" />
        </x-sidebar.dropdown>
    @endif

    <x-sidebar.dropdown title="Buttons" :active="Str::startsWith(request()->route()->uri(), 'buttons')">
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink title="Text button" href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')" />
        <x-sidebar.sublink title="Icon button" href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')" />
        <x-sidebar.sublink title="Text with icon" href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')" />
    </x-sidebar.dropdown>

    @if(config('app.env') === 'local')
        <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">Dummy Links</div>

        @php
            $links = array_fill(0, 20, '');
        @endphp

        @foreach ($links as $index => $link)
            <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
        @endforeach
    @endif
       
</x-perfect-scrollbar>