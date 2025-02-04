
<div class="flex justify-center items-center">
    <button {!! $attributes->merge(['type' => 'submit', 'class' => "relative inline-flex items-center justify-center p-0.5 overflow-hidden text-sm font-medium text-gray-900 rounded-lg shadow-lg shadow-blue-500/50 group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-700 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 transition-all duration-300 ease-in-out transform hover:scale-105"]) !!}>
        <span class="relative px-8 py-3 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
            {{ $slot }}
        </span>
    </button>
</div>


