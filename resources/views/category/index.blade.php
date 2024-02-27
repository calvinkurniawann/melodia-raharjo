<x-navbar></x-navbar>
<x-guest-layout>
    <div class="ml-5 mt-10 flex flex-col sm:flex-row">
        <ul class="max-w-xs w-full sm:w-[30%]">
            <li class="py-3 px-4 text-sm font-medium border-b border-gray-200 text-white bg-black">
                <h1 class="text-3xl">Kategori</h1>
            </li>
            @foreach ($categories as $category)
                <a href="{{ route('dashboard.category.show', $category) }}" class="block bg-white border-b border-gray-200">
                    <li class="py-3 px-4 text-sm font-medium text-gray-800 mb-1">
                        {{ $category->name }}
                    </li>
                </a>
            @endforeach
        </ul>

        <div class="w-full bg-white flex flex-col justify-center mt-5 sm:mt-0 p-5">
            <div class="w-full flex flex-col justify-center items-center">
                <form class="w-full sm:w-[60%] md:w-[50%] lg:w-[40%] mx-auto" action="/barang/search" method="GET">
                    <label for="default-search" class="mb-2 text-sm font-medium text-white sr-only dark:text-white">Search</label>
                    <div class="relative flex items-center border rounded-lg bg-gray-50 focus-within:ring-blue-500 focus-within:border-blue-500">
                        <div class="flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" id="default-search" name="search" value="{{ isset($search) ? $search : ''}}" class="block w-full p-3 sm:p-4 pl-10 pr-8 text-sm text-gray-900 placeholder-gray-500 focus:outline-none outline-none bg-transparent" placeholder="Guitar, Drum, Bass, etc..." required>
                        <button type="submit" class="text-white bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 sm:py-3">Search</button>
                    </div>
                </form>                                                    
            </div>
            
            @if(isset($search))
                <p class="m-7 text-xl">Search results for "{{ isset($search) ? $search : ''}}"</p>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 p-5">
                @foreach ($barangs as $barang)
                    <a href="{{ "/dashboard/barang/".$barang->id }}" class="w-full bg-white rounded-md overflow-hidden text-center flex flex-col justify-center">
                        @if ($barang->gambar == 'default.jpg')
                            <div class="w-sm h-48 block overflow-hidden">
                                <img class="rounded-t-lg object-contain w-full h-full" src="{{ asset('gambar/default.jpg') }}" alt="" />
                            </div>
                        @else
                            <div class="overflow-hidden w-sm h-48 block">
                                <img class="rounded-t-lg object-contain w-full h-full" src="{{ asset('storage/' . $barang->gambar) }}" alt="" />
                            </div>
                        @endif
                        <div class="p-4 flex flex-col justify-center">
                            <h2 class="text-xl font-bold mb-1">{{ $barang->nama }}</h2>
                            <div class="flex justify-center items-center text-center mt-4">
                                <span class="text-gray-800 text-center"> Rp. {{ number_format($barang->harga, 0, '.', '.') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <x-footer></x-footer>
</x-guest-layout>
