{{-- <x-guest-layout>
    <a href="/">
        <button type="button"
            class="relative left-8 top-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
    </a>

    @if ($totalPrice !== 0)
        @foreach ($cartItems as $barang)
            <div class="container flex mx-auto my-8 p-5 bg-white rounded-md shadow-md w-11/12">
                <div class="w-1/2 flex items-center">
                    @if ($barang->gambar == 'default.jpg')
                        <img class="w-full max-w-40 h-48 max-h-20 object-cover rounded-t-lg" src="{{ asset('gambar/default.jpg') }}"
                            alt="" />
                    @else
                        <img class="w-full max-w-40 h-48 max-h-20 object-cover rounded-t-lg" src="{{ asset('storage/' . $barang->gambar) }}"
                            alt="" />
                    @endif
                    <p class="text-xl ml-10">{{ $barang['nama'] }}</p>
                </div>

                <div class="flex w-1/2 font-bold align-middle items-center justify-between">

                    <p>{{ $barang['pivot']['kuantitas'] }}</p>
                    <div class="mr-8">
                        <p class="font-semibold">{{ 'Rp. ' . number_format($barang['harga']) }}</p>
                    </div>
                    <div class="flex flex-row justify-between items-center mt-2">

                        <div class="flex gap-1 items-center justify-between">

                            <form action="{{ route('cart.update', ['id' => $barang->id]) }}" method="POST"
                                class="flex gap-1">
                                @csrf
                                <input type="hidden" value="increment" name="action">
                                <button
                                    class="flex text-center items-center justify-center w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                    type="submit" name="action" value="increment">
                                    <svg class="flex w-4 h-4 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="3" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </form>

                            <form action="{{ route('cart.update', ['id' => $barang->id]) }}" method="POST"
                                class="flex gap-1">
                                @csrf
                                <input type="hidden" value="decrement" name="action">
                                <button
                                    class="flex text-center items-center justify-center w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                    type="submit">
                                    <svg class="flex w-4 h-4 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="3" d="M1 1h16" />
                                    </svg>
                                </button>
                            </form>

                            <form action="{{ route('cart.delete', ['id' => $barang->id]) }}" method="POST">
                                @csrf
                                <button
                                    class="flex text-center items-center justify-center w-[30px] h-[30px] bg-red-600 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                    type="submit" name="action" value="delete">
                                    <svg class="flex w-5 h-5 text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="container flex justify-between mx-auto my-8 p-8 bg-white rounded-md shadow-md w-11/12">
        <div>
            <p class="font-semibold">Total harga: </p>
            <p class="font-bold">{{ 'Rp. ' . number_format($totalPrice) }}</p>
        </div>
    </div>
</x-guest-layout> --}}

<!-- resources/views/cart.blade.php -->

<x-guest-layout>
    <a href="/">
        <button type="button"
            class="relative left-8 top-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
    </a>
    <div class="container mx-auto my-8 ">
        <h2 class="text-4xl font-semibold mb-4 mx-auto text-center">Shopping Cart</h2>

        @if (count($cartItems) > 0)
            <table class="min-w-full bg-white border border-gray-300 rounded-md overflow-hidden ">
                <tbody class="align-middle text-center">
                    @foreach ($cartItems as $barang)
                        <tr class="flex items-center justify-between mx-5">
                            <td class="py-2 w-48  align-middle">
                                @if ($barang->gambar == 'default.jpg')
                        <div class="w-48 h-48 block overflow-hidden">
                            <img class="rounded-t-lg object-contain w-full h-full" src="{{ asset('gambar/default.jpg') }}"
                                alt="" />
                        </div>
                    @else
                        <div class="overflow-hidden w-48 h-48 block ">
                            <img class="rounded-t-lg object-contain w-full h-full" src="{{ asset('storage/' . $barang->gambar) }}" alt="" />
                        </div>
                    @endif
                            </td>
                            <td class="py-2 px-4  align-middle ">{{ $barang->nama }}</td>
                            <td class="py-9 px-4  align-middle flex flex-row items-center justify-center ">
                                <div class="flex border-[1px] items-center">
                                    <form action="{{ route('cart.update', ['id' => $barang->id]) }}" method="POST"
                                        class="flex gap-1">
                                        @csrf
                                        <input type="hidden" value="increment" name="action">
                                        <button
                                            class="flex text-center items-center justify-center w-[25px] h-[25px] border-gray-700 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                            type="submit" name="action" value="increment">
                                            <svg class="flex w-2 h-2 text-black" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="3" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </form>
                                    <p class="px-[9px] border-x-[1px] ">{{ $barang->pivot->kuantitas }}</p>
                                    <form action="{{ route('cart.update', ['id' => $barang->id]) }}" method="POST"
                                        class="flex gap-1">
                                        @csrf
                                        <input type="hidden" value="decrement" name="action">
                                        <button
                                            class="flex text-center items-center justify-center w-[25px] h-[25px] border-gray-700 rounded-lg transition-all duration-300 active:scale-95 text-white hover:brightness-125"
                                            type="submit">
                                            <svg class="flex w-2 h-2 text-black" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="3" d="M1 1h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="py-2 px-4  align-middle">Rp. {{ number_format($barang->harga) }}</td>
                            <td class="py-2 px-10  align-middle">
                                <form action="{{ route('cart.delete', ['id' => $barang->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 focus:outline-none focus:text-red-700">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end mt-4">
                <div class="bg-white p-4 rounded-md shadow-md">
                    <p class="text-lg font-semibold">Total Price: Rp. {{ number_format($totalPrice) }}</p>
                    <a href=""
                        class="mt-4 inline-block px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        @else
            <p class="text-lg">Your shopping cart is empty.</p>
        @endif
    </div>
</x-guest-layout>
