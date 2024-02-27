

<x-guest-layout>
    @if(session('success'))
    <div class="bg-green-500 text-white p-4 mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-500 text-white p-4 mb-4">
        {{ session('error') }}
    </div>
    @endif
    <a href="/">
        <button type="button"
            class="relative left-8 top-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
    </a>
    <div class="container mx-auto my-8 ">
        <h2 class="text-4xl font-semibold mb-4 mx-auto text-center">Shopping Cart</h2>

        @php
            $barangData = [];
            foreach ($cartItems as $item) {
                $barangData[] = $item;
            }
            foreach ($cartItems as $item) {
                $quantity = $item->pivot->kuantitas;
            }
        @endphp

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
                        <tr class="flex items-center justify-between mx-5 border-t-2 py-5">
                            <td class="py-2 px-4  align-middle ">

                            </td>
                            <td class="py-2 px-4  align-middle ">
                                Ongkos Kirim
                            </td>
                            <td class="py-2 px-4  align-middle ">

                            </td>
                            <td class="py-2 px-4  align-middle ">
                                Rp. 15,000
                            </td>
                            <td class="py-2 px-4  align-middle ">
                                
                            </td>
                        </tr>
                </tbody>
            </table>
            
            <div class="w-full bg-white p-5 rounded mt-5">
                {{-- <div class=" bg-white  w-full">
                    <label for="deliveryOption" class="block text-sm font-medium text-gray-700">Delivery Option</label>
                    <select id="deliveryOption" name="deliveryOption" class="mt-1 p-2 block w-full border rounded-md bg-gray-100" onchange="toggleAddressForm()">
                        <option value="Ambil di Toko">Ambil di Toko</option>
                        <option value="Kirim" selected>Kirim</option>
                    </select>
                </div> --}}
                <form action="{{ route('cart.address') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" class="mt-1 p-2 block w-full border rounded-md bg-gray-100" placeholder="Enter your delivery address">{{ auth()->user()->alamat }}</textarea>
                    </div>
            
            
                    <button type="submit" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                        Perbarui Alamat
                    </button>
                </form>
            </div>

            <div class="flex justify-end mt-4">
                <div class="bg-white p-4 rounded-md shadow-md">
                    <p class="text-lg font-semibold">Total Price: Rp. {{ number_format($totalPrice) }}</p>
                    <button type="button" id="checkoutButton"
                        class="mt-4 inline-block px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        @else
            <p class="text-lg">Your shopping cart is empty.</p>
        @endif
    </div>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script>
        $(document).ready(function() {

            const baseTotalPrice = {!! json_encode($totalPrice) !!};
            // const ongkir = 15000;
            const totalPrice = baseTotalPrice ;

            $("#checkoutButton").click(function(event) {
                event.preventDefault();

                const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                const barangData = ({!! json_encode($barangData) !!});


                fetch('order/pay-and-create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        credentials: 'include',
                        body: JSON.stringify({
                            barangData: barangData,
                            totalPrice: totalPrice,
                            id_cart: barangData[0].pivot.id_cart,
                            payment_status: 'pending'
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        snap.pay(data.snap_token.snap_token, {
                            onSuccess: function(result) {
                                window.location.href = '/order/pesanan-paid'
                            },
                            onPending: function(result) {
                                window.location.href = '/order/pesanan-pending'
                            },
                            onClose: function(result) {
                                window.location.href = '/order/pesanan-pending'
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error during fetch:', error);
                    });
            });
        });
    </script>
</x-guest-layout>
