@if(session()->has('success'))
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex flex-col items-center">
            <p>{{ session('success') }}</p>
            <button onclick="this.parentElement.remove()" class="mt-2 bg-white text-green-700 px-4 py-2 rounded hover:bg-green-200 transition">
                Close
            </button>
        </div>
    </div>
@endif

@if(session()->has('error'))
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex flex-col items-center">
            <p>{{ session('error') }}</p>
            <button onclick="this.parentElement.remove()" class="mt-2 bg-white text-red-700 px-4 py-2 rounded hover:bg-red-200 transition">
                Close
            </button>
        </div>
    </div>
@endif

