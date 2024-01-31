<!-- Navbar.blade.php -->

<nav class="bg-slate-950 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-white font-bold text-3xl">Melo<span class="text-blue-400">Gita</span></a>
        <div class=" flex justify-between items-center m-2 mr-10">
            <a href="/category/page" class="text-white mx-4">Kategori</a>
            <a href="" class="text-white mx-4">Kontak</a>
            <a href="" class="text-white mx-4 ">Tentang Kami</a>
            <div class="relative text-blue-400 ml-12 mr-10">
                @guest
                <a href="{{ route('login') }}" class="mx-4">Login</a>
                <a href="{{ route('register') }}" class="mx-4">Register</a>
                @else
                <div class="group inline-block text-white relative">
                    <button class="text-white focus:outline-none">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="absolute hidden  pt-1 group-active:block bg-white text-black">
                        @if (Auth::user()->utype === 'ADM')
                        <li><a href="/dashboard/barang" class="text-left px-4 py-4">Dashboard</a></li>
                        @else 
                        <li><a href="{{ route('profile.show') }}" class="text-left px-4 py-4">Profile</a></li>
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
            <!-- component -->
        <div class=" flex justify-center items-center mb-3 h-2">
            <div class="relative py-2">
                {{-- <div class="t-0 absolute left-3">
                    <p class="flex h-2 w-2 items-center justify-center rounded-full bg-red-500 p-3 text-xs text-white">3</p>
                </div> --}}
                <a href="/cart"><svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="file: mt-4 h-6 w-6 ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg></a>
                
            </div>
        </div>
        </div>
        
    </div>
</nav>

<script>
    // Add JavaScript for dropdown
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.group');

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function () {
                this.querySelector('ul').classList.remove('hidden');
            });

            dropdown.addEventListener('mouseleave', function () {
                this.querySelector('ul').classList.add('hidden');
            });
        });
    });
</script>
