<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }} Products
        </h2>
    </x-slot>

    <div>
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 w-full  p-5 ">
            @foreach ($category->products as $product)
                <a href="{{ "/dashboard/barang/".$barang->id }}"
                    class="w-full bg-white rounded-md overflow-hidden text-center flex flex-col justify-center">
                    @if ($barang->gambar == 'default.jpg')
                        <div class="w-sm h-48 block overflow-hidden">
                            <img class="rounded-t-lg object-cover w-full h-full" src="{{ asset('gambar/default.jpg') }}"
                                alt="" />
                        </div>
                    @else
                        <div class="overflow-hidden w-sm h-48 block">
                            <img class="rounded-t-lg " src="{{ asset('storage/' . $barang->gambar) }}" alt="" />
                        </div>
                    @endif
                    <div class="p-4 flex flex-col justify-center">
                        <p class="text-gray-700 mb-4">{{ $barang->kategori }}</p>
                        <h2 class="text-2xl font-bold mb-2">{{ $barang->nama }}</h2>
                        <div class="flex justify-center items-center text-center mt-4">
                            <span class="text-gray-800 text-center"> Rp. {{ number_format($barang->harga) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-guest-layout>