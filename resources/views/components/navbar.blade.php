
<nav class="bg-slate-950 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex flex-row items-center">
            <img src="{{ asset('gambar/logo.png') }}" alt="" class="w-16 h-16">
            <a href="/" class="text-white font-bold text-2xl">Melo<span class="text-[#00ccff]">Gita</span></a>
        </div>

        <div class="flex flex-row">
            <div class="flex justify-center items-center mb-3 h-2 lg:hidden">
                <div class="relative py-2">
                    <a href="/cart">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="file: mt-4 h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        @if ($cartItemCount > 0)
                        <span class="bg-red-600 top-4 left-4 right-0 flex items-center justify-center text-sm text-white rounded-full h-5 w-5 absolute">
                            {{ $cartItemCount }}
                        </span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="block lg:hidden ml-7">
                <button id="mobile-menu-btn" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="hidden lg:flex justify-between items-center m-2 mr-10">
            <a href="/category/page" class="text-white mx-4">Produk</a>
            <a href="/kontak" class="text-white mx-4">Kontak</a>
            <a href="/order/pesanan-pending" class="text-white mx-4">Order</a>

            <!-- Dropdown for User -->
            <div class="relative text-blue-400 ml-12 mr-10">
                @guest
                    <a href="{{ route('login') }}" class="mx-4">Login</a>
                    <a href="{{ route('register') }}" class="mx-4">Register</a>
                @else
                    <!-- Dropdown for Authenticated User -->
                    <div class="group inline-block text-white relative">
                        <button class="text-white focus:outline-none">
                            {{ Auth::user()->name }}
                            <span class="text-[12px]">&#9660;</span>
                        </button>
                        <ul class="absolute hidden pt-1 group-active:block bg-white text-black">
                            @if (Auth::user()->utype === 'ADM')
                                <li><a href="/dashboard/report" class="text-left px-4 py-6 mb-2">Dashboard</a></li>
                            @else 
                                <li><a href="{{ route('profile.show') }}" class="text-left px-4 py-6 mb-2">Profile</a></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>

            <!-- Cart Icon -->
            <div class="flex justify-center items-center mb-3 h-2">
                <div class="relative py-2">
                    <a href="/cart">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="file: mt-4 h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        @if ($cartItemCount > 0)
                        <span class="bg-red-600 top-4 left-4 right-0 flex items-center justify-center text-sm text-white rounded-full h-5 w-5 absolute">
                            {{ $cartItemCount }}
                        </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden">
        <div class="flex flex-col items-center bg-slate-950 text-white py-2">
            <a href="/category/page" class="my-2">Produk</a>
            <a href="/kontak" class="my-2">Kontak</a>
            {{-- <a href="" class="my-2">Tentang Kami</a> --}}
            <a href="/order/pesanan-pending" class="my-2">Order</a>

            <div class="relative text-blue-400 mt-2">
                @guest
                    <a href="{{ route('login') }}" class="my-2">Login</a>
                    <a href="{{ route('register') }}" class="my-2">Register</a>
                @else
                    <div class="group inline-block relative">
                        <button class="text-white focus:outline-none">
                            {{ Auth::user()->name }}
                            <span class="text-[12px]">&#9660;</span>
                        </button>
                        <ul class="absolute hidden pt-1 group-active:block bg-white text-black">
                            @if (Auth::user()->utype === 'ADM')
                                <li><a href="/dashboard/barang" class="text-left px-4 py-2">Dashboard</a></li>
                            @else 
                                <li><a href="{{ route('profile.show') }}" class="text-left px-4 py-2">Profile</a></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </div>
    
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document
            mobileMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function () {
            mobileMenu.classList.add('hidden');
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.group');

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document
            const ul = this.querySelector('ul');
            ul.classList.toggle('hidden');
        });
    });

    document.addEventListener('click', function () {
        dropdowns.forEach(dropdown => {
            const ul = dropdown.querySelector('ul');
            ul.classList.add('hidden');
        });
    });
});

</script>
