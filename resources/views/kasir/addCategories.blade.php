<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="max-w-2xl mx-4 sm:max-w-sm md:max-w-lg lg:max-w-lg xl:max-w-lg sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto mt-36 bg-white shadow-xl rounded-lg text-gray-900">

                <div class="text-center mt-2">
                    <h2 class="font-semibold">Add Category</h2>
                    <p class="text-gray-500">Category for Products</p>
                </div>

                <div class="p-10">
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf
                        <div>
                            <x-input-label for="category_name" :value="__('Category Name')" />
                            <x-text-input id="category_name" class="block mt-1 w-full" type="text"
                                name="category_name" :value="old('category_name')" required autofocus
                                autocomplete="category_name" />
                            <x-input-error :messages="$errors->get('category_name')" class="mt-2" />
                        </div>

                        <div class="flex items-center space-x-4 justify-end mt-4">
                            <a href="{{ route('dashboard') }}"
                                class="ms-3 px-4 py-2 border-solid border-2 border-[#1963D2] rounded-md text-base text-[#1963D2] font-semibold"
                                type="button">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                class="ms-3 inline-flex items-center px-4 py-2 bg-[#1963D2] border border-transparent rounded-md font-semibold text-base text-white tracking-widest hover:bg-[#1963D2] focus:bg-[#1963D2] active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Confirm') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
