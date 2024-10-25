<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- CRUD BUTTON --}}
            <div class="flex justify-end gap-3 overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('category.create') }}"
                    class="inline-flex items-center px-4 py-2 w-36 h-10 bg-blue-800 border border-transparent rounded-md font-medium text-xs text-white tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add Category
                </a>
                <a href="{{ route('product.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>

                    Add Products
                </a>
                <a href="{{ route('cart.show') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">
                    Cart
                </a>
            </div>

            {{-- PRODUCTS --}}
            <div x-data="productFilter()" x-init="fetchProducts(1)" class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">

                {{-- FILTERS --}}
                <div class="border-b mb-5 flex justify-start text-sm">
                    @foreach ($categories as $category)
                        <button
                            class="text-indigo-600 flex items-center pb-2 pr-2 border-b-2 border-indigo-600 uppercase font-semibold"
                            @click="fetchProducts({{ $category->id }})">
                            {{ $category->category_name }}
                        </button>
                    @endforeach
                </div>

                <div class="grid lg:grid-cols-5 sm:grid-cols-2 md:grid-cols-3 gap-9 justify-items-center">

                    <template x-for="product in products" :key="product.id">
                        <!-- CARD ITEMS -->
                        <div class="rounded overflow-hidden shadow-lg flex flex-col max-w-52">
                            <a href="#"></a>
                            <div class="relative">
                                <a href="#">
                                    <img class="w-[200px] h-[165px] object-cover"
                                        :src="`{{ asset('storage') }}/${product.image}`" alt="Sunset in the mountains">
                                    <div
                                        class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                                    </div>
                                </a>
                                {{-- <a href="#">
                                    <div
                                        class="text-xs absolute top-0 right-0 bg-indigo-600 px-4 py-2 text-white mt-3 mr-3 hover:bg-white hover:text-indigo-600 transition duration-500 ease-in-out">
                                        Cooking
                                    </div>
                                </a> --}}
                            </div>
                            <div class="px-4 py-4 mb-auto">
                                <div class="flex justify-between">
                                    <a href="#"
                                        class="font-normal text-sm inline-block hover:text-indigo-600 transition duration-500 ease-in-out mb-2"
                                        x-text="product.product_name"></a>
                                    <button @click="deleteProduct(product.id)"
                                        class="inline-flex items-center px-1 py-1 bg-red-700 rounded-lg text-xs text-white ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>

                                    </button>
                                </div>
                                <span>Rp. <p class="text-black font-bold text-lg" x-text="product.price"></p></span>

                            </div>
                            <div class="px-6 py-3 flex flex-row items-center justify-center bg-gray-100">

                                <button @click="addToCart(product.id)"
                                    class="inline-flex items-center px-4 py-2 bg-blue-800 rounded-md font-semibold text-xs text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-3">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <p class="mx-1">Add To Cart</p>
                                </button>
                            </div>
                        </div>
                    </template>

                </div>
            </div>

            <div class="flex justify-center lg:justify-end md:justify-end sm:justify-end content-center">
                <div
                    class="bg-[#1963D2] w-52 h-14 rounded-lg text-white font-semibold text-center flex justify-center items-center">
                    Total Bill : Rp 1.000.000
                </div>
            </div>
        </div>
    </div>

    <script>
        function productFilter() {
            return {
                products: [],
                fetchProducts(categoryId = null) {
                    let url = categoryId ? `dashboard/${categoryId}` : `/dashboard`;
                    fetch(`/dashboard/${categoryId}`, {
                            headers: {
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            this.products = data;
                        })
                        .catch(error => console.error('Error fetching products:', error));
                },

                addToCart(productID) {
                    fetch(`/cart/add/${productID}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.success);
                        })
                        .catch(error => console.error('Error adding to cart:', error));
                },

                deleteProduct(productID) {
                    if (confirm('Are you sure you want to delete this product?')) {
                        fetch(`/product/delete/${productID}`, {
                                method: 'DELETE',
                                headers: {
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                alert(data.success);
                                this.fetchProducts(1);
                            })
                            .catch(error => console.error('Error deleting product:', error));
                    }
                }
            };
        }
    </script>
</x-app-layout>
