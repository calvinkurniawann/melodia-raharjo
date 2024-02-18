<x-navbar></x-navbar>
<x-guest-layout>
    <section class="sm:h-screen h-[100vh] w-full flex flex-col items-center justify-center bg-slate-950" style="background-image: url({{ asset('gambar/home.jpg') }});">
        <div class="text-center mb-7 px-4">
            <h1 class="text-4xl sm:text-7xl text-white font-bold">Melangkah ke Dunia Musik</h1>
            <h1 class="text-4xl sm:text-7xl text-white font-bold m-auto">Dengan Gaya dan Suara</h1>
        </div>
        <div class="w-full flex flex-col justify-center items-center">
            <form class="w-full sm:w-[60%] md:w-[50%] lg:w-[40%] mx-auto" action="/barang/search" method="GET">
                <label for="default-search" class="mb-2 text-sm font-medium text-white sr-only dark:text-white">Search</label>
                <div class="relative flex items-center border rounded-lg bg-gray-50 focus-within:ring-blue-500 focus-within:border-blue-500">
                    <div class="flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="default-search" name="search" value="{{ isset($search) ? $search : ''}}" class="block w-full p-3 sm:p-4 pl-10 pr-8 text-sm text-gray-900 placeholder-gray-500 focus:outline-none bg-transparent" placeholder="Guitar, Drum, Bass, etc..." required>
                    <button type="submit" class="text-white bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 sm:py-3">Search</button>
                </div>
            </form>                                                    
        </div>
    </section>
    
    <section class="mt-10 flex justify-center items-center w-full">
    <div class="  p-3 w-full bg-white flex flex-col justify-center m-5">
        <p class="text-3xl m-3"> <span class="font-bold">Terbaru</span> kami : </p>
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 w-full  p-5 ">
            @foreach ($barangs as $barang)
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
                        <h2 class="text-2xl font-bold mb-2">{{ $barang->excerpt() }}</h2>
                        <div class="flex justify-center items-center text-center mt-4">
                            <span class="text-gray-800 text-center"> Rp. {{ number_format($barang->harga, 0, '.', '.') }}</span>
                        </div>
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $barang->id }}" name="id_product">
                            <button type="submit" class="mt-4 bg-black text-white p-2 rounded-full">
                                <i class="fas fa-shopping-cart "></i>
                            </button>
                        </form>
                    </div>
                </a>
            @endforeach
        </div>
        <a href="/category/page">
        <div class="flex justify-center pb-7">
            <button class="flex items-center justify-center space-x-2 text-black font-semibold px-4 rounded">
                <span class="text-3xl">Tampilkan Semua Produk</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
        </a>
    </div>
    </section>
    <section class="mt-10 flex justify-center items-center w-full">
    <div class="  p-3 w-full bg-white flex flex-col justify-center m-5">
        <p class="text-3xl m-3"> <span class="font-bold">Kategori</span> Gitar : </p>
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 w-full  p-5 ">
            @foreach ($guitarProducts as $barang)
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
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $barang->id }}" name="id_product">
                            <button type="submit" class="mt-4 bg-black text-white p-2 rounded-full">
                                <i class="fas fa-shopping-cart "></i>
                            </button>
                        </form>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
    </section>
    <section class="mt-10 flex justify-center items-center w-full">
    <div class="  p-3 w-full bg-white flex flex-col justify-center m-5">
        <p class="text-3xl m-3"> <span class="font-bold">Kategori</span> Keyboard : </p>
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 w-full  p-5 ">
            @foreach ($keyboardProducts as $barang)
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
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $barang->id }}" name="id_product">
                            <button type="submit" class="mt-4 bg-black text-white p-2 rounded-full">
                                <i class="fas fa-shopping-cart "></i>
                            </button>
                        </form>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
    </section>
    <section class="mt-10 flex justify-center items-center w-full">
    <div class="  p-3 w-full bg-white flex flex-col justify-center m-5">
        <p class="text-3xl m-3"> <span class="font-bold">Kategori</span> Drum : </p>
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 w-full  p-5 ">
            @foreach ($drumProducts as $barang)
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
                        <form action="{{ route('cart.add') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $barang->id }}" name="id_product">
                            <button type="submit" class="mt-4 bg-black text-white p-2 rounded-full">
                                <i class="fas fa-shopping-cart "></i>
                            </button>
                        </form>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</x-guest-layout>
