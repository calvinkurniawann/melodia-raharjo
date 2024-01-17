<!-- Navbar.blade.php -->

<nav class="bg-slate-950 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-white font-bold text-3xl">Melo<span class="text-yellow-400">Gita</span></a>
        <div class=" flex justify-between items-center m-2 ">
            <a href="" class="text-white mx-4">Kategori</a>
            <a href="" class="text-white mx-4">Kontak</a>
            <a href="" class="text-white mx-4 ">Tentang Kami</a>
            <div class="relative text-yellow-400 ml-12">
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
                        <li><a href="dashboard/barang">Dashboard</a></li>
                        @else 
                        <li><a href="profile">Profile</a></li>
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
