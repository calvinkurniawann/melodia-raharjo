<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="w-full text-sm text-gray-500 dark:text-gray-400 flex justify-between flex-wrap">
            <div class="w-full grid grid-cols-3 gap-5">
                @if ($orderData->count() > 0)
                    {{-- {{ $orderData }} --}}
                    @foreach ($orderData as $order)
                        @php
                            $firstOrder = $order;
                            $orderItems = $firstOrder['order_items'];
                            $order->load('orderItems');
                        @endphp
                        <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow col-span-1">
                            <div class="flex w-full items-center justify-between">
                                <div>
                                    <span class="text-[10px]">Tanggal:</span>
                                    <p class="mb-2 text-sm font-semibold tracking-tight text-gray-900 ">
                                        {{ $order->created_at }}</p>
                                </div>
                                <div>
                                    <span class="text-[10px]">Order id:</span>
                                    <p class="mb-2 text-sm font-semibold tracking-tight text-gray-900 ">
                                        {{ $order->unique_string }}</p>
                                </div>
                            </div>
                            <div class="flex w-full items-center justify-between">
                                <div>
                                    <span class="text-[10px]">
                                        Nama Pelanggan: 
                                    </span>
                                    <p class="mb-2 text-sm font-semibold tracking-tight ">
                                        {{ $order->user->name }}
                                    </p>
                                    <span class="text-[10px]">
                                        Alamat Pelanggan: 
                                    </span>
                                    <p class="mb-2 text-sm font-semibold tracking-tight ">
                                        {{ $order->user->alamat }}
                                    </p>
                                    <span class="text-[10px]">Status:</span>
                                    @if ($order->status == 'Menunggu Konfirmasi')
                                        <p
                                            class="mb-2 text-sm font-semibold tracking-tight text-orange-500 ">
                                            {{ $order->status }}</p>
                                    @elseif ($order->status == 'Proses')
                                        <p class="mb-2 text-sm font-semibold tracking-tight text-blue-400 ">
                                            {{ $order->status }}</p>
                                    @elseif ($order->status == 'Selesai')
                                        <p class="mb-2 text-sm font-semibold tracking-tight text-green-600 ">
                                            {{ $order->status }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex w-full items-start flex-col">
                                <span class="text-[10px]">Produk:</span>
                                <div class="w-full flex justify-between items-center mt-2">
                                    <p class=" text-sm text-gray-700">Nama: </p>
                                    <p class=" text-sm text-gray-700">Kuantitas: </p>
                                    <p class=" text-sm text-gray-700">Harga: </p>
                                </div>
                                @foreach ($order->orderItems as $barang)
                                    <div class="w-full flex justify-between items-center mt-2 border-b-2 pb-2">
                                        <p class=" text-sm text-gray-700">{{ $barang->nama_barang }}</p>
                                        <p class=" text-sm text-gray-700">{{ $barang->kuantitas }}</p>
                                        <p class=" text-sm text-gray-700">Rp. {{ number_format($barang->harga) }}</p>
                                    </div>
                                @endforeach
                                <div class="w-full flex justify-between items-center mt-1 border-b-2 pb-2">
                                    <p class=" text-sm text-gray-700">Ongkos Kirim: </p>
                                    <p class=" text-sm text-gray-700">Rp. 15,000</p>
                                </div>
                            </div>
                            <div class="flex w-full justify-between mt-8">
                                <div>
                                    @if ($order->status == 'Menunggu Konfirmasi')
                                        <form action="/order/terima" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id_order" value="{{ $order->id }}">
                                            <button type="submit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Terima</button>
                                        </form>
                                    @elseif ($order->status == 'Proses')
                                        <form action="/order/selesai" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id_order" value="{{ $order->id }}">
                                            <button type="submit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Selesai</button>
                                        </form>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-gray-700 mr-2">Total:</p>
                                    <p class="text-gray-700 font-bold text-xl">Rp. {{ number_format($order->total_harga) }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>