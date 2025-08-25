 <header class="flex items-center justify-between px-6 py-4 bg-white border-b-2 border-gray-200">
    <div class="flex items-center">
        <!-- Mobile toggle -->
        <button @click.stop="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                <path d="M4 6H20M4 12H20M4 18H20"
                        stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>

        <!-- Desktop collapse toggle -->
        <button @click="sidebarCollapsed = !sidebarCollapsed" class="hidden lg:block ml-4 text-gray-500 focus:outline-none">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                <path d="M4 6H20M4 12H20M4 18H20"
                        stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>

    <!-- User -->
    <div class="relative" x-data="{ open: false }">
        <!-- Profile button -->
        <button @click="open = !open" class="flex items-center focus:outline-none">
            <img class="w-8 h-8 rounded-full object-cover" 
                src="{{ asset('admin/img/undraw_profile.svg') }}" 
                alt="User avatar">
            <span class="ml-2 text-sm font-inter font-normal text-[14px] text-[#1C1C1C] hidden lg:inline">
                ByeWind
            </span>
            <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div 
            x-show="open" 
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 z-50"
        >
            <a href="{{ route('admin.users.profile',Auth::id()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Profile
            </a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Settings
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Log Out
                </button>
            </form>
        </div>
    </div>

</header>
