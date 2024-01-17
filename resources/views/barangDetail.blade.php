<x-guest-layout>
    <div class="max-w-7xl px-10 py-5 min-h-[200px]">
        <div class="w-full rounded-lg p-5 mb-10">
            <div class="w-full h-10 flex justify-between">
                <p class="text-xl font-semibold">Detail Produk</p>
            </div>
            <div class="w-full flex justify-between items-center space-x-3">
                @if ($barang->gambar == 'default.jpg')
                    <img src="{{ asset('gambar/default.jpg') }}"
                        class="h-32 object-contain bg-[rgb(209,211,212)] rounded-lg" alt="" />
                @else
                    <img src="{{ asset('storage/' . $barang->gambar) }}"
                        class="h-32 object-contain bg-[rgb(209,211,212)] rounded-lg" alt="" />
                @endif

                <div class="w-full flex flex-col">
                    <div class="w-full min-h-[40%] p-4">
                        <p class="text-xl">Nama</p>
                        <span class="text-3xl font-bold mt-5 break-all">{{ $barang->nama }}</span>
                    </div>
                    <div class="w-full min-h-[40%] p-4">
                        <p class="text-xl">Deskripsi</p>
                        <span class="text-3xl font-bold mt-5 break-all">{{ $barang->deskripsi }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
