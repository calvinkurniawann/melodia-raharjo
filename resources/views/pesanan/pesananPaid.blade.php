<x-navbar></x-navbar>
<x-guest-layout>
    <div
    class="bg-slate-300 text-white pt-2 pb-2 w-full z-50 border-b-2 border-gray-400 flex justify-start items-center space-x-4">
    <a href="/order/pesanan-pending" class="text-black hover:text-gray-500 transition duration-300 ease-in-out border-r-4 px-2">PESANAN PENDING</a>
    <a href="/order/pesanan-paid" class="text-black hover:text-gray-500 transition duration-300 ease-in-out border-r-4 px-2">PESANAN PAID</a>
    </div>
    @if ($orderDataPaid->count() > 0)
    {{-- {{ $orderDataPaid }} --}}
    <div class="w-full grid grid-cols-3 my-10 gap-4 px-10">
        @foreach ($orderDataPaid as $order)
            @php
                $firstOrder = $order;
                $orderItems = $firstOrder['order_items'];
                $order->load('orderItems');
            @endphp

            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow col-span-1">
                <div class="flex w-full items-center justify-between">
                    <div>
                        <span class="text-[10px]">Tanggal:</span>
                        <p class="mb-2 text-sm font-semibold tracking-tight text-gray-900">
                            {{ $order->created_at }}</p>
                    </div>
                    <div>
                        <span class="text-[10px]">Order id:</span>
                        <p class="mb-2 text-sm font-semibold tracking-tight text-gray-900">
                            {{ $order->unique_string }}</p>
                    </div>
                </div>
                <div class="flex w-full items-center justify-between">
                    <div>
                        <span class="text-[10px]">Status:</span>
                        @if ($order->status == 'Menunggu Konfirmasi')
                            <p class="mb-2 text-sm font-semibold tracking-tight text-orange-500 ">
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
                        <p class=" text-sm text-gray-700">Rp. 2.000</p>
                    </div>
                </div>
                <div class="flex justify-end mt-8">
                    <div class="text-gray-700 mr-2">Total:</div>
                    <div class="text-gray-700 font-bold text-xl">Rp. {{ number_format($order->total_harga) }}</div>
                </div>

            </div>
        @endforeach
    </div>
@else
    <div class="w-full mx-auto text-center">
        <p class="text-3xl mt-20">Belum ada order yang kamu bayar</p>
    </div>
@endif
</x-guest-layout>