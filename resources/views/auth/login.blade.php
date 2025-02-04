<x-guest-layout>
    <!-- Logo and Welcome Message -->
    <div class="flex flex-col items-center justify-center mb-5">
        <a href="/" class="flex flex-col items-center space-y-2">
            <img src="{{ asset('logo/' . $setting->logo) }}" class="w-24 h-24 rounded-lg" alt="LOGO" />
            <span class="text-center text-3xl font-black animate-pulse text-fuchsia-400 dark:text-white">Welcome to {{ $setting->company_name}}</span>
        </a>
    </div>

    <!-- Login Form Container -->
    <div class="shadow-md p-4 border-4 border-dotted border-green-300 rounded-xl">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="relative z-0 w-full mb-8 group">
                <x-text-input id="email" type="email" name="email"
                    class="peer block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 dark:focus:border-blue-500"
                    required autofocus autocomplete="username" placeholder=" " />

                <x-input-label for="email" value="Email Address"
                    class="absolute text-md text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500" />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="relative z-0 w-full mb-8 group">
                <x-text-input id="password" type="password" name="password"
                    class="peer block py-2.5 px-0 w-full text-md text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 dark:focus:border-blue-500"
                    required autocomplete="current-password" placeholder=" " />

                <x-input-label for="password" value="Password"
                    class="absolute text-md text-white dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600" name="remember">
                    <span class="ml-2 text-sm text-white dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition duration-200">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div>
                <x-primary-button class="animate-pulse">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Register Section -->
        <div class="mt-3 text-center">
            <p class="text-md pt-2 pb-2 text-red-600 dark:text-gray-400">{{ __('Don’t have an account?') }}</p>
            <a href="{{ route('register') }}" class="animate-bounce inline-flex items-center mt-2 px-6 py-2 bg-green-600 hover:bg-green-500 text-white font-semibold rounded-md transition duration-200">
                {{ __('Create an account') }}
            </a>
        </div>
    </div>
</x-guest-layout>
