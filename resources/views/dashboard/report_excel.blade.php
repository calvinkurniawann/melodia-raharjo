<div class="flex justify-center">
    <table class="min-w-full divide-y divide-gray-200 mt-2 border">
        <thead class="border-2">
            <tr class="border-2">
                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Tanggal
                </td>
                <td class="px-6 py-3 w-fit text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Order ID
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nama Customer
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Alamat
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Barang
                </td>
                <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Harga Total
                </td>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @php
                $grandTotal = 0;
            @endphp
            @foreach ($groupedOrders as $status => $orders)
                @foreach ($orders as $order)
                    @if ($order->created_at >= $startDate && $order->created_at <= $endDate)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $order->created_at }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-[15px] break">
                            @if ($order->status == 'Menunggu Konfirmasi')
                                <span class="text-orange-400 tracking-tight flex uppercase">
                                    {{ $order->status }}
                                </span>
                            @elseif ($order->status == 'Proses')
                                <span class="text-blue-400 tracking-tight flex uppercase">
                                    {{ $order->status }}
                                </span>
                            @elseif ($order->status == 'Selesai')
                                <span class="text-green-400 tracking-tight flex uppercase">
                                    {{ $order->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $order->unique_string }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $order->user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $order->user->alamat }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($order->orderItems as $product)
                                {{ $product->kuantitas }}x {{ $product->nama_barang }}<br>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Rp. {{ number_format($order->total_harga) }}
                        </td>
                    </tr>
                    @php
                        $grandTotal += $order->total_harga;
                    @endphp
                    @endif
                @endforeach
            @endforeach
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    Total
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    Rp. {{ number_format($grandTotal) }}
                </td>
            </tr>
        </tbody>
    </table>
</div>