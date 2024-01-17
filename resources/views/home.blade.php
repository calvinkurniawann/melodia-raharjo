<x-navbar></x-navbar>
<x-guest-layout>
    <!-- <div x-data="{ activeSlide: 0 }" class="w-[90%] mx-10   ">
        <div class="flex overflow-hidden w-[90%]">
          <div x-show="activeSlide === 0" class="transition-transform ease-in-out"><img src="" alt=""></div>
        </div>
      
        <div class="flex justify-between mt-3">
          <button @click="activeSlide = (activeSlide - 1 + 3) % 3">Previous</button>
          <button @click="activeSlide = (activeSlide + 1) % 3">Next</button>
        </div>
    </div> -->
    <section class="bg-slate-950 h-[100vh] w-[100%] flex flex-col items-center justify-center " style="background-image: url({{ asset('gambar/home.jpg') }}); ">
        <div class="text-center mb-7">
            <h1 class="text-7xl text-yellow-400 font-bold ">Melangkah ke Dunia Musik</h1>
            <h1 class="text-7xl text-white font-bold m-auto ">Dengan Gaya dan Suara</h1>
        </div>
        <div class="w-full flex flex-col justify-center items-center">
            
<form class="w-[40%]">   
    <label for="default-search" class="mb-2 text-sm font-medium text-white sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white " placeholder="Guitar, Drum, Bass, etc..." required>
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
    </div>
</form>

        </div>
    </section>
    
    <section class="mt-10 flex justify-center items-center w-full">
    <div class="  p-3 w-full bg-white flex flex-col justify-center m-5">
        <p class="text-3xl m-3">Produk terbaru kami: </p>
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 w-full  p-5 ">
            @foreach ($barangs as $barang)
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
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</x-guest-layout>
