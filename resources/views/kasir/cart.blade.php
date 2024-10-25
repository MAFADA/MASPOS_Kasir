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
                }
            }
        }
    </script>
</x-app-layout>
