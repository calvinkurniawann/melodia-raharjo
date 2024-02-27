<x-navbar />
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-md shadow-md w-full max-w-[90%] h-[90%]">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Contact Information') }}</h2>

            <div class="mb-4">
                <p class="text-lg"><strong>Email:</strong> calvinnkurniawan@gmail.com</p>
                <p class="text-lg"><strong>Phone:</strong> +62 838 5439 2901</p>
                <p class="text-lg"><strong>Address:</strong>Jl. Margo Rukun</p>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Contact Us') }}
                </x-primary-button>
            </div>
        </div>
    </div>
</x-guest-layout>
