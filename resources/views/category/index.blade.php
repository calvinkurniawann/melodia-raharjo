<x-navbar></x-navbar>
<x-guest-layout>
<div class="ml-5 mt-10 flex">
    <ul class="max-w-xs flex flex-col mr-5 w-[30%]">
        <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium border border-gray-200 text-white -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg bg-black ">
            <h1 class="text-3xl ">Kategori</h1>
        </li>
        @foreach ($categories as $category)
        <a href="" class="bg-white border-b-2 "> 
            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 mb-1">
            {{ $category->name }}
            </li>
        </a>
        @endforeach
    </ul>

    <div class=" w-full bg-white flex flex-col justify-center mr-10">
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 w-full  p-5 ">
            @foreach ($categories as $category)
            @foreach ($category->barangs as $barang)
                <a href="{{ "/dashboard/barang/".$barang->id }}"
                    class="w-full bg-white rounded-md overflow-hidden text-center flex flex-col justify-center">
                    @if ($barang->gambar == 'default.jpg')
                        <div class="w-sm h-48 block overflow-hidden">
                            <img class="rounded-t-lg object-contain w-full h-full" src="{{ asset('gambar/default.jpg') }}"
                                alt="" />
                        </div>
                    @else
                        <div class="overflow-hidden w-sm h-48 block ">
                            <img class="rounded-t-lg object-contain w-full h-full" src="{{ asset('storage/' . $barang->gambar) }}" alt="" />
                        </div>
                    @endif
                    <div class="p-4 flex flex-col justify-center">
                        <p class="text-gray-700 mb-4">{{ $barang->kategori }}</p>
                        <h2 class="text-2xl font-bold mb-2">{{ $barang->nama }}</h2>
                        <div class="flex justify-center items-center text-center mt-4">
                            <span class="text-gray-800 text-center"> Rp. {{ number_format($barang->harga, 0, '.', '.') }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
            @endforeach
        </div>
    </div>
</div>
    
        {{-- @foreach ($categories as $category)
            <a href=""><li>{{ $category->name }}</li></a>
        @endforeach --}}
</x-guest-layout>