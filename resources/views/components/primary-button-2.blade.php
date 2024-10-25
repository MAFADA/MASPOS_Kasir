<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#1963D2] border border-transparent rounded-md font-semibold text-base text-white tracking-widest hover:bg-[#1963D2] focus:bg-[#1963D2] active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
