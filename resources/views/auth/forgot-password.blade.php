<x-guest-layout>
     <!-- Logo and Welcome Message -->
     <div class="flex flex-col items-center justify-center mb-5">
        <a href="/" class="flex flex-col items-center space-y-2">
            <img src="{{ asset('logo/' . $setting->logo) }}" class="w-24 h-24 rounded-lg" alt="LOGO" />
            <span class="text-center text-3xl font-black animate-pulse text-fuchsia-400 dark:text-white">Welcome to {{ $setting->company_name}}</span>
        </a>
    </div>
    <!-- Card Container -->
    <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-xl">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="relative z-0 w-full mb-8 group">
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    class="peer block py-2.5 px-0 w-full text-md text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 dark:focus:border-blue-500"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder=" "
                />

                <x-input-label
                    for="email"
                    value="Email Address"
                    class="absolute text-md text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-blue-600 peer-focus:dark:text-blue-500"
                />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="transition duration-300 ease-in-out transform hover:scale-105 hover:bg-blue-500 hover:text-white">
                    {{ __('Send Link') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Login Link -->
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                {{ __('Remember your password? Login here') }}
            </a>
        </div>
    </div>
</x-guest-layout>
