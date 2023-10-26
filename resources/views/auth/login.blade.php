<x-guest-layout>
    <section
        class="min-h-96 relative flex flex-1 shrink-0 items-center justify-center overflow-hidden bg-gray-100 py-16 shadow-lg md:py-20 xl:h-screen">

        <img src="{{ url('/img/youtube-banner.png') }}" loading="lazy" alt="Photo by Fakurian Design"
            class="absolute inset-0 h-full w-full object-cover object-center" />

        <!-- overlay - start -->
        <div class="absolute inset-0 bg-gray-700 mix-blend-multiply"></div>
        <!-- overlay - end -->

        <!-- text start -->
        <div class="relative flex flex-col items-center p-4 w-full">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div class="w-full mt-10 flex flex-col justify-center items-center w-full">
                <div class="bg-white p-5 rounded-lg w-1/3">

                    <span class="text-2xl">Log In</span>
                    <form method="POST" class="my-5" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                    name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline mr-auto text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    href="{{ route('home') }}">
                                    {{ __('Back To Home') }}
                                </a>
                            @endif

                            <x-primary-button class="ml-3">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
    </section>
</x-guest-layout>
