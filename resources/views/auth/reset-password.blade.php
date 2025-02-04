<x-guest-layout>
    <div class="flex flex-col items-center justify-center mb-8">
        <a href="/" class="flex flex-col items-center space-y-2">
            <img src="{{ asset('logo/' . $setting->logo) }}" class="w-24 h-24 rounded-lg" alt="LOGO" />
            <span class="text-center text-3xl font-black animate-pulse text-fuchsia-400 dark:text-white">Welcome to {{ $setting->company_name}}</span>
        </a>
    </div>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="relative z-0 w-full mb-5 group">
            <x-text-input id="email" class="block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder=" " />
            <label for="email" class="peer-focus:font-medium absolute text-md text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Email Address
            </label>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="relative z-0 w-full mb-5 group">
            <x-text-input id="password" class="block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                type="password" name="password" required autocomplete="new-password" placeholder=" " />
            <label for="password" class="peer-focus:font-medium absolute text-md text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Password
            </label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="relative z-0 w-full mb-5 group">
            <x-text-input id="password_confirmation" class="block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                type="password" name="password_confirmation" required autocomplete="new-password" placeholder=" " />
            <label for="password_confirmation" class="peer-focus:font-medium absolute text-md text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Confirm Password
            </label>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex  justify-end mt-4">
            <x-primary-button>
                {{ __('Reset') }}
            </x-primary-button>

    </form>
</x-guest-layout>



