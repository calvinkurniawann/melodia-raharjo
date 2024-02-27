<x-guest-layout>
    <div class="flex mb-0 overflow-hidden">
        <div class="text-white z-10 w-full h-[50%] flex flex-col ">
            <div class="z-10 flex flex-row w-5 h-1 p-9 text-white">
                <h1 class="font-bold text-4xl">Melo<span class="text-blue-400">Gita</span></h1>
            </div>
            <div class="pl-9 mt-[80%]">
                <h2 class="text-3xl font-bold font-sans">Masuk ke Dunia Melodi dengan Melogita</h2>
                <h2 class="text-2xl font-bold font-sans">Dimana Setiap Klik Membuat Simfoni Melodimu!</h2>
            </div> 
        </div>
        
        <img src="{{ asset('gambar/auth.jpg') }}" alt="" class="w-[50%] h-screen absolute">
        
        <div class="w-full flex flex-col items-center justify-center h-full mt-[15%] ml-[10%] mr-[3%]">
            <!-- Session Status -->
            <x-auth-session-status class="" :status="session('status')" />
            
            <form method="POST" action="{{ route('login') }}" class="w-full">
                @csrf
    
                <h1 class="text-center text-5xl font-bold mb-10"> Login</h1>
    
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
    
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
    
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
    
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                @if (Route::has('password.request'))
                <a class="text-sm text-black hover:text-gray-600 dark:hover:text-gray-100 rounded-md focus:outline-none"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
    
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                        {{ __('Don\'t have an account?') }}
                    </a>
    
                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
