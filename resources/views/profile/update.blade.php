<x-navbar/>
<x-guest-layout>
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white p-8 border rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Update Profile</h2>
    
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
    
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="mt-1 p-2 border rounded-md w-full">
                </div>
    
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="mt-1 p-2 border rounded-md w-full">
                </div>
    
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>