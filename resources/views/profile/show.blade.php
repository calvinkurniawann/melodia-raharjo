<x-navbar/>
<x-guest-layout>
    <div class="flex justify-center">
        <div class="bg-white overflow-hidden shadow rounded-lg border w-[80%] mb-52 mt-10">
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    User Profile
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    This is some information about the user.
                </p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Nama
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ auth()->user()->name }}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Email
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ auth()->user()->email }}
                        </dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        @if (auth()->user()->no_telepon == 'null')
                        <dt class="text-sm font-medium text-gray-500">
                            Nomor Telepon
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            Nomor Telepon belum Diisi
                        </dd>
                        @else
                        <dt class="text-sm font-medium text-gray-500">
                            Nomor Telepon
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ auth()->user()->no_telepon }}
                        </dd>
                        @endif
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        @if (auth()->user()->alamat == 'null')
                        <dt class="text-sm font-medium text-gray-500">
                            Alamat
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            Alamat belum Diisi
                        </dd>
                        @else
                        <dt class="text-sm font-medium text-gray-500">
                            Alamat
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ auth()->user()->alamat }}
                        </dd>
                        @endif
                    </div>
                </dl>
                <div class="flex items-center justify-between m-5">
                    <a href="{{ route('profile.edit') }}" class="text-blue-500">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
</x-guest-layout>