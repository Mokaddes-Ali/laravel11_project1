<x-guest-layout>
    <div class="flex flex-col items-center justify-center mb-8">
        <a href="/" class="flex flex-col items-center space-y-2">
            <img src="{{ asset('logo/' . $setting->logo) }}" class="w-24 h-24 rounded-lg" alt="LOGO" />
            <span class="text-center text-3xl font-black animate-pulse text-fuchsia-400 dark:text-white">Welcome to {{ $setting->company_name}}</span>
        </a>
    </div>

    <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <!-- Card Content -->
        <div class="mb-6 text-md text-gray-600 dark:text-gray-400">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 font-medium text-md text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="mt-6 flex items-center justify-between space-x-4">
            <!-- Resend Verification Email Form -->
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <x-primary-button class="w-full sm:w-auto bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-indigo-600 hover:via-purple-600 hover:to-pink-600 text-white">
                    {{ __('Resend') }}
                </x-primary-button>
            </form>

            <!-- Log Out Form -->
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full sm:w-auto text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>



