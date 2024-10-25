<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 h-screen py-8">
                <div class="container mx-auto px-4">
                    <div class="flex flex-col md:flex-row gap-4" x-data="cartData({{ json_encode($cart, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }})">
                        <div class="md:w-3/4">
                            <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                                <table class="w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-left font-semibold">Product</th>
                                            <th class="text-left font-semibold">Price</th>
                                            <th class="text-left font-semibold">Quantity</th>
                                            <th class="text-left font-semibold">Sub Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(item,id) in cart" :key="id">
                                            <tr>
                                                <td class="py-4">
                                                    <div class="flex items-center">
                                                        <img class="h-16 w-16 mr-4"
                                                            :src="`{{ asset('storage') }}/${item.image}`"
                                                            alt="Product image">
                                                        <span x-text="item.name" class="font-semibold"></span>
                                                    </div>
                                                </td>
                                                <td x-text="`Rp. ${item.price}`" class="py-4"></td>
                                                <td class="py-4">
                                                    <div class="flex items-center">
                                                        <button @click="updateQuantity(id, item.qty-1)"
                                                            class="border rounded-md py-2 px-4 mr-2"
                                                            :disabled="item.qty <= 1">-</button>
                                                        <span class="text-center w-8" x-text="item.qty"></span>
                                                        <button @click="updateQuantity(id, item.qty+1)"
                                                            class="border rounded-md py-2 px-4 ml-2">+</button>
                                                    </div>
                                                </td>
                                                <td class="py-4" x-text="`Rp. ${item.price * item.qty}`"></td>
                                                <td class="py-4">
                                                    <button @click="removeItem(id)"
                                                        class="inline-flex items-center px-3 py-3 bg-red-700 rounded-lg text-xs text-white ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>

                                                    </button>
                                                </td>
                                            </tr>
                                        </template>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="md:w-1/4">
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h2 class="text-lg font-semibold mb-4">Summary</h2>

                                <div class="flex justify-between mb-2">
                                    <span class="font-semibold">Total</span>
                                    <span class="font-semibold" x-text="`Rp. ${totalPrice}`"></span>
                                </div>
                                <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full"
                                    @click="checkout()">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cartData(initCart) {
            return {
                cart: initCart,
                get totalPrice() {
                    return Object.values(this.cart).reduce((acc, item) => acc + (item.price * item.qty), 0);
                },
                updateQuantity(productID, quantity) {
                    if (quantity < 1) return;

                    fetch(`/cart/update`, {
                            method: 'PATCH',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                productId: productID,
                                qty: quantity
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Updated item:', this.cart[productID]);
                                this.cart[productID].qty = quantity;
                            }
                        })
                        .catch(error => console.error('Error updating cart:', error));
                },
                checkout() {
                    fetch('/checkout', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            }
                        })
                        .then(response => {
                            if (response.redirected) {
                                window.location.href = response.url;
                            }
                        })
                        .catch(error => console.error('Error during checkout:', error));
                },
                removeItem(productID) {
                    fetch('/cart/remove', {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                productID: parseInt(productID)
                            })
                        })
                        .then(response => {
                            return response.json()
                        })
                        .then(data => {
                            if (data.success) {
                                delete this.cart[productID];
                            }
                        })
                        .catch(error => console.error('Error removing item:', error))
                }
            }
        }
    </script>
</x-app-layout>
