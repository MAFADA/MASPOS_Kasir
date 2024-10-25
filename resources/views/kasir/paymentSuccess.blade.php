<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-semibold mb-4">Payment Successful</h1>
            <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="50" fill="#36B37E" />
                <path
                    d="M44.8438 61.7854L34.5312 51.4729L37.4771 48.5271L44.8469 55.8886L44.8438 55.8917L62.5208 38.2146L65.4667 41.1604L47.7896 58.8396L44.8458 61.7833L44.8438 61.7854Z"
                    fill="white" />
            </svg>
            <p class="text-lg font-semibold mt-4">Rp. {{ number_format($totalPricePayment, 2) }}</p>
            <a href="{{ route('dashboard') }}"
                class="mt-6 inline-block bg-[#1963D2] text-white py-2 px-4 rounded-lg">Back to Home</a>
        </div>
    </div>
</x-app-layout>
