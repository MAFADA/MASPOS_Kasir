<x-app-layout>
    <div class="py-10">
        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="max-w-2xl mx-4 sm:max-w-screen-md md:max-w-screen-md lg:max-w-screen-md xl:max-w-screen-md sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto mt-36 bg-white shadow-xl rounded-lg text-gray-900">
                    <div class="grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-2">
                        <div>
                            <div class=" font-sans text-gray-900 bg-gray-300 border-box">
                                <div class="flex justify-center w-full mx-auto sm:max-w-lg">
                                    <div
                                        class="flex flex-col items-center justify-center w-full h-auto my-20 bg-white sm:w-3/4 sm:rounded-lg sm:shadow-xl">
                                        <div class="mt-10 mb-10 text-center">
                                            <h2 class="text-2xl font-semibold mb-2">Upload your files</h2>
                                            <p class="text-xs text-gray-500">File should be of .jpg, .png, .jpeg
                                            </p>
                                        </div>
                                        <div
                                            class="relative w-4/5 h-32 max-w-xs mb-10 bg-gray-100 rounded-lg shadow-inner">
                                            <input type="file" id="file-upload" name="image" class="hidden"
                                                onchange="previewImage(event)">
                                            <label for="file-upload"
                                                class="z-20 flex flex-col-reverse items-center justify-center w-full h-full cursor-pointer">
                                                <p class="z-10 text-xs font-light text-center text-gray-500">Drag & Drop
                                                    your files here</p>
                                                <svg class="z-10 w-8 h-8 text-indigo-400" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z">
                                                    </path>
                                                </svg>
                                            </label>
                                            <img src="#" alt="Preview" id="image-preview"
                                                class="hidden absolute top-0 left-0 w-full h-full object-cover rounded-lg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="text-center mt-2">
                                <h2 class="font-semibold">Add Category</h2>
                                <p class="text-gray-500">Category for Products</p>
                            </div>
                            <div class="p-10">
                                <div>
                                    <x-input-label for="product_name" :value="__('Product Name')" />
                                    <x-text-input id="product_name" class="block mt-1 w-full" type="text"
                                        name="product_name" :value="old('product_name')" required autofocus
                                        autocomplete="product_name" />
                                    <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                                </div>
                                <div class="mt-4">
                                    <x-input-label for="price" :value="__('Price')" />
                                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                                        :value="old('price')" required autofocus autocomplete="price" />
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <div x-data="{ open: false }" class="relative inline-block text-left">
                                        <button @click="open = !open" type="button"
                                            class="inline-flex justify-center w-full  px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                                            Select Category <svg class="h-5 w-5 ml-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false"
                                            class="origin-top-left absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 px-2 py-2">
                                            <div class="py-2">
                                                @foreach ($categories as $category)
                                                    <a href="#"
                                                        @click="open = false; $refs.selectedCategory.value = '{{ $category->id }}'"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">{{ $category->category_name }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <input type="hidden" name="category_id" x-ref="selectedCategory">
                                    </div>
                                </div>


                                <div class="flex items-center space-x-4 justify-end mt-4">
                                    <a href="{{ route('dashboard') }}"
                                        class="ms-3 px-4 py-2 border-solid border-2 border-[#1963D2] rounded-md text-base text-[#1963D2] font-semibold"
                                        type="button">
                                        {{ __('Cancel') }}
                                    </a>
                                    <x-primary-button-2 class="ms-3">
                                        {{ __('Confirm') }}
                                    </x-primary-button-2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script>
        function previewImage(event) {
            const image = event.target;
            const preview = document.getElementById('image-preview');

            if (image.files && image.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(image.files[0]);
            }
        }
    </script>
</x-app-layout>
