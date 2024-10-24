<nav x-data="{ open: false }" class="bg-blue-700 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <h2 class="font-semibold text-xl text-white leading-tight">
                        {{ __('MASPOS') }}
                    </h2>
                </div>
                {{--
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div> --}}
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-transparent hover:text-gray-200 focus:outline-none transition ease-in-out duration-150">
                            <div class="px-3">{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="40" height="40" rx="20" fill="url(#pattern0_4658_157)" />
                                    <rect x="28" y="28" width="13" height="13" rx="6.5" fill="#36B37E" />
                                    <rect x="28" y="28" width="13" height="13" rx="6.5" stroke="white"
                                        stroke-width="2" />
                                    <defs>
                                        <pattern id="pattern0_4658_157" patternContentUnits="objectBoundingBox"
                                            width="1" height="1">
                                            <use xlink:href="#image0_4658_157"
                                                transform="translate(-0.00260417) scale(0.00520833)" />
                                        </pattern>
                                        <image id="image0_4658_157" width="193" height="192"
                                            xlink:href="data:image/png;base64,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" />
                                    </defs>
                                </svg>

                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
