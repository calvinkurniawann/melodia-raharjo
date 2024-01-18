<x-navbar/>
<x-guest-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white p-8 border rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-4">User Profile</h2>
    
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
    
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-600">Name:</p>
                <p class="text-lg">{{ auth()->user()->name }}</p>
            </div>
            
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-600">Email:</p>
                <p class="text-lg">{{ auth()->user()->email }}</p>
            </div>
            
            @if (auth()->user()->no_telepon == 'null')
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-600">Nomor Telepon:</p>
                <p class="text-lg">Nomor Telepon belum diisi</p>
            </div>
            @else
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-600">Nomor Telepon:</p>
                <p class="text-lg">{{ auth()->user()->no_telepon }}</p>
            </div>
            @endif
    
            <div class="flex items-center justify-between">
                <a href="{{ route('profile.edit') }}" class="text-blue-500">Edit Profile</a>
            </div>
        </div>
    </div>
</x-guest-layout>