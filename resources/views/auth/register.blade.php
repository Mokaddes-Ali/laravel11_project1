<x-guest-layout>
    <div class="flex flex-col items-center justify-center mb-2">
        <a href="/" class="flex flex-col items-center space-y-2">
            <img src="{{ asset('logo/' . $setting->logo) }}" class="w-24 h-24 rounded-lg" alt="LOGO" />
            <span class="text-center text-3xl font-black animate-pulse text-fuchsia-400 dark:text-white">Welcome to {{ $setting->company_name}}</span>
        </a>
    </div>
    <div class="border-4 p-4 rounded-md border-gradient-to-tl from-indigo-600 to-pink-600 p-4 border-indigo-200 border-x-indigo-500">
    <form method="POST" action="{{ route('register') }}" class="">
        @csrf

      <!-- Name -->
<div class="relative z-0 w-full mb-5 group">
    <x-text-input id="name" type="text" name="name"
        class="peer block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 dark:focus:border-blue-500"
        required autofocus autocomplete="name" placeholder=" " />

    <x-input-label for="name" value="Name"
        class="absolute text-md text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500" />

    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Email Address -->
<div class="relative z-0 w-full mb-5 group">
    <x-text-input id="email" type="email" name="email"
        class="peer block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 dark:focus:border-blue-500"
        required autocomplete="username" placeholder=" " />

    <x-input-label for="email" value="Email Address"
        class="absolute text-md text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500" />

    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="relative z-0 w-full mb-5 group">
    <x-text-input id="password" type="password" name="password"
        class="peer block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 dark:focus:border-blue-500"
        required autocomplete="new-password" placeholder=" " />

    <x-input-label for="password" value="Password"
        class="absolute text-md text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500" />

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="relative z-0 w-full mb-5 group">
    <x-text-input id="password_confirmation" type="password" name="password_confirmation"
        class="peer block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 dark:focus:border-blue-500"
        required autocomplete="new-password" placeholder=" " />

    <x-input-label for="password_confirmation" value="Confirm Password"
        class="absolute text-md text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500" />

    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-pink-600 dark:text-gray-300 hover:text-orange-500 dark:hover:text-yellow-400 transition-all duration-300 ease-in-out rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 dark:focus:ring-offset-gray-800"
            href="{{ url('/') }}">
            {{ __('Already registered?') }}
        </a>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
</x-guest-layout>
