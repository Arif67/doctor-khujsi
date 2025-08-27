<aside
    class="fixed inset-y-0 left-0 min-h-screen custom-scrollbar overflow-x-hidden overflow-y-scroll bg-white shadow-md transform transition-all duration-300 ease-in-out z-50 sidebar-border
    lg:static lg:translate-x-0"
    :class="{
        'translate-x-0': sidebarOpen, 
        '-translate-x-full': !sidebarOpen, 
        'w-20': sidebarCollapsed, 
        'w-64': !sidebarCollapsed
    }"
>
    <div class="flex flex-col justify-between h-full">
        <div>
            <!-- Logo -->
            <div class="flex items-center justify-center h-20 border-b">
                <a href="{{route('admin.dashboard')}}"> 
                    <img src="{{asset('assets/img/undraw_rocket.svg')}}" 
                            alt="Logo" 
                            class="transition-all duration-300" 
                            :class="sidebarCollapsed ? 'h-10' : 'h-20'">
                </a>
            </div>

            <!-- Navigation -->
            <nav class="mt-6">
                <div class="relative group">
                     <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-6 py-3 transition-all duration-300 text-[13px]"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.dashboard') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.dashboard') }}'
                        }">
                        <i class="fas fa-gauge"></i>
                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Dashboard
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Dashboard
                    </span>
                </div>
                <div 
                    :class="[
                        'pl-6 bg-[#A3AED0] py-1 my-2 text-white font-normal text-[13px] transition-opacity duration-300',
                        sidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100 block'
                    ]"
                >
                    User Managment
                </div>
                <div class="relative group">
                     <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-6 py-3 transition-all duration-300 text-[13px]"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.users.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.users.*') }}'
                        }">
                        <i class="fas fa-users"></i>
                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Users
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Users
                    </span>
                </div>
                <div 
                    :class="[
                        'pl-6 bg-[#A3AED0] py-1 my-2 text-white font-normal text-[13px] transition-opacity duration-300',
                        sidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100 block'
                    ]"
                >
                    Role Permissions
                </div>            
                <div class="relative group">
                    <a href="{{ route('admin.roles.index') }}"
                        class="flex items-center px-6 py-3 transition-all text-[13px] duration-300"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.roles.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.roles.*') }}'
                        }">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>

                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Roles
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Roles
                    </span>
                </div>
                <div class="relative group">
                    <a href="{{ route('admin.permissions.index') }}"
                        class="flex text-[13px] items-center px-6 py-3 transition-all duration-300"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.permissions.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.permissions.*') }}'
                        }">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>

                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Permissions
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Permissions
                    </span>
                </div>
                <div 
                    :class="[
                        'pl-6 bg-[#A3AED0] py-1 my-2 text-white font-normal text-[13px] transition-opacity duration-300',
                        sidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100 block'
                    ]"
                >
                    Doctor Managment
                </div>
                <div class="relative group">
                    <a href="{{ route('admin.departments.index') }}"
                        class="flex text-[13px] items-center px-6 py-3 transition-all duration-300"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.departments.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.departments.*') }}'
                        }">
                        <i class="fas fa-building"></i>
                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Department
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Department
                    </span>
                </div>
                <div class="relative group">
                    <a href="{{ route('admin.doctors.index') }}"
                        class="flex text-[13px] items-center px-6 py-3 transition-all duration-300"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.doctors.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.doctors.*') }}'
                        }">
                       <i class="fas fa-user-md"></i>
                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Doctors
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Doctors
                </span>
                </div>
                <div 
                    :class="[
                        'pl-6 bg-[#A3AED0] py-1 my-2 text-white font-normal text-[13px] transition-opacity duration-300',
                        sidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100 block'
                    ]"
                >
                    Blog Managment
                </div>
                <div class="relative group">
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex text-[13px] items-center px-6 py-3 transition-all duration-300"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.categories.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.categories.*') }}'
                        }">
                        <i class="fas fa-folder"></i>
                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Categories
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Categories
                    </span>
                </div>
                 <div class="relative group">
                    <a href="{{ route('admin.blogs.index') }}"
                        class="flex text-[13px] items-center px-6 py-3 transition-all duration-300"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.blogs.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.blogs.*') }}'
                        }">
                        <i class="fas fa-blog"></i>
                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Blogs
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Blogs
                    </span>
                </div>
                <div 
                    :class="[
                        'pl-6 bg-[#A3AED0] py-1 my-2 text-white font-normal text-[13px] transition-opacity duration-300',
                        sidebarCollapsed ? 'opacity-0 hidden' : 'opacity-100 block'
                    ]"
                >
                    App Settings
                </div> 
                {{-- <div class="relative group">
                    <a href="{{ route('admin.app.pages.index') }}"
                        class="flex text-[13px] items-center px-6 py-3 transition-all duration-300"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.app.pages.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.app.pages.*') }}'
                        }">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>

                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Pages
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Pages
                    </span>
                </div> --}}
                <div class="relative group">
                    <a href="{{ route('admin.services.index') }}"
                        class="flex text-[13px] items-center px-6 py-3 transition-all duration-300"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.services.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.services.*') }}'
                        }">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>

                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Services
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Services
                    </span>
                </div>
                <div class="relative group">
                    <a href="{{ route('admin.attentions.index') }}"
                        class="flex text-[13px] items-center px-6 py-3 transition-all duration-300"
                        :class="{
                            'justify-center': sidebarCollapsed,
                            'bg-indigo-600 text-white': '{{ Route::is('admin.attentions.*') }}',
                            'text-[#A3AED0] hover:bg-gray-200': '{{ !Route::is('admin.attentions.*') }}'
                        }">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>

                        <!-- Animated text -->
                        <span 
                            class="ml-4 font-medium origin-left transition-all duration-300"
                            :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                            Attentions
                        </span>
                    </a>
                    <span x-show="sidebarCollapsed" 
                       class="absolute left-full top-1/2 -translate-y-1/2 ml-2
                        bg-gray-800 text-white text-xs px-2 py-1 rounded-lg opacity-0
                        group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                        Attentions
                    </span>
                </div>
            </nav>
        </div>

        <!-- Logout -->
        <div class="px-6 py-4">
            <a href="#" 
                class="flex items-center text-gray-500 hover:text-gray-800 transition-all duration-300"
                :class="{'justify-center': sidebarCollapsed}">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 
                        4H7m6 4v1a3 3 0 01-3 
                        3H6a3 3 0 01-3-3V7a3 3 0 
                        013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span 
                    class="ml-4 font-medium origin-left transition-all duration-300"
                    :class="sidebarCollapsed ? 'opacity-0 scale-90 hidden' : 'opacity-100 scale-100 inline-block'">
                    Log Out
                </span>
            </a>
        </div>
    </div>
</aside>


 <!-- Mobile overlay -->
<div x-show="sidebarOpen" class="fixed inset-0 bg-black opacity-50 z-40 lg:hidden" @click="sidebarOpen = false"></div>
