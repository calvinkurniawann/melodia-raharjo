<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full">
            <div class="bg-white shadow-sm w-full">
                <div class="p-6 bg-white border-b border-gray-200 w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-blue-500 text-white p-4 rounded-md">
                            <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                            <p class="text-3xl">{{$totalUsers}}</p>
                        </div>

                        <div class="bg-green-500 text-white p-4 rounded-md">
                            <h3 class="text-lg font-semibold mb-2">Total Orders</h3>
                            <p class="text-3xl">{{$totalOrders}}</p>
                        </div>

                        <div class="bg-yellow-500 text-white p-4 rounded-md">
                            <h3 class="text-lg font-semibold mb-2">Total Pendapatan</h3>
                            <p class="text-3xl">Rp. {{ number_format($totalRevenue) }}</p>
                        </div>
                    </div>

                    <div class="mt-8 w-full">
                        <div class="flex flex-col justify-between">
                            <p class="text-lg font-semibold mb-2">Order Report</p>
                            <div class="flex flex-row justify-between">
                                <div class="mb-7">
                                    <label for="start_date" class="block mb-2">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" required class="mb-2">
                                
                                    <label for="end_date" class="block mb-2">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" required class="mb-2">
                                
                                    <button onclick="filterTable()" class="p-2 mx-2 bg-blue-600 text-white rounded">Filter</button>
                                    <button onclick="refreshTable()" class="p-2 mx-2 bg-green-600 text-white rounded">Refresh</button>
                                </div>
                                
                                <form action="{{ route('export-excel') }}" method="GET" class="mb-7">
                                    <label for="start_date" class="block mb-2">Start Date:</label>
                                    <input type="date" name="start_date" id="start_date" class="mb-2">
                                    
                                    <label for="end_date" class="block mb-2">End Date:</label>
                                    <input type="date" name="end_date" id="end_date" class="mb-2">
                                    
                                    <button type="submit" class="p-2 mx-2 bg-blue-600 text-white rounded">
                                        <svg class="w-7 h-7 inline-block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                                        </svg>            
                                        <span class="ml-2 pt-[1px] font-medium">Cetak EXCEL</span>
                                    </button>
                                </form>
                            </div>
                        
                        <div class="mx-auto flex justify-center px-4 ">
                            <div class="bg-white shadow-sm sm:rounded-lg min-w-full flex justify-center px-20">
                                <table id="sortable" class=" divide-y divide-gray-200 mt-2 border">
                                    <thead class="border-2">
                                        <tr class="border-2 cursor-pointer">
                                            <th onclick="sortBy(0)" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tanggal
                                            </th>
                                            <th onclick="sortBy(1)" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th onclick="sortBy(2)" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Order ID
                                            </th>
                                            <th onclick="sortBy(3)" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Nama Customer
                                            </th>
                                            <th onclick="sortBy(4)" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Alamat
                                            </th>
                                            <th onclick="sortBy(5)" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Barang
                                            </th>
                                            <th onclick="sortBy(6)" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Harga Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($groupedOrders as $status => $orders)
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $order->created_at }}
                                                    </td>
                                                    <td class="px-4 py-4 text-[15px] break">
                                                        @if ($order->status == 'Menunggu Konfirmasi')
                                                            <span class="text-orange-400 flex uppercase break text-[15px]">
                                                                {{ $order->status }}
                                                            </span>
                                                        @elseif ($order->status == 'Proses')
                                                            <span class="text-blue-400 flex uppercase break text-[15px]">
                                                                {{ $order->status }}
                                                            </span>
                                                        @elseif ($order->status == 'Selesai')
                                                            <span class="text-green-400 flex uppercase break text-[15px]">
                                                                {{ $order->status }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $order->unique_string }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap break">
                                                        {{ $order->user->name }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $order->user->alamat }}
                                                    </td>
                                                    <td class="px-6 py-4 break-words text-[15px]">
                                                        @foreach ($order->orderItems as $product)
                                                            {{ $product->kuantitas }}x {{ $product->nama_barang }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        Rp. {{ number_format($order->total_harga) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#invoice-table').DataTable({
                "order": [[0, 1, 3, 4, 5, "asc"]], // Sort by the first column (Tanggal) in ascending order
                "columnDefs": [
                    { "orderable": false, "targets": [2, 7] } // Disable sorting for other columns
                ]
            });
        });
        function filterTable() {
    var startDate = new Date($('#start_date').val());
    var endDate = new Date($('#end_date').val());

    if (isNaN(startDate) || isNaN(endDate)) {
        // Handle invalid date input
        alert('Invalid date input. Please enter valid dates.');
        return;
    }

    $('tbody tr').hide();

    $('tbody tr').filter(function() {
        var orderDate = new Date($(this).find('td:eq(0)').text()); // Assuming the date column is the first column

        // Adjust the condition based on your date comparison needs
        return (orderDate >= startDate && orderDate <= endDate);
    }).show();
}

function refreshTable() {
    $('tbody tr').show();
    $('#start_date, #end_date').val(''); // Clear input values
}

cPrev = -1; 

function sortBy(c) {
    rows = document.getElementById("sortable").rows.length; 
    columns = document.getElementById("sortable").rows[0].cells.length;
    arrTable = [...Array(rows)].map(e => Array(columns)); 

    for (ro=0; ro<rows; ro++) { 
        for (co=0; co<columns; co++) { 
            arrTable[ro][co] = document.getElementById("sortable").rows[ro].cells[co].innerHTML;
        }
    }

    th = arrTable.shift();
    
    if (c !== cPrev) { 
        arrTable.sort(
            function (a, b) {
                if (a[c] === b[c]) {
                    return 0;
                } else {
                    return (a[c] < b[c]) ? -1 : 1;
                }
            }
        );
    } else {
        arrTable.reverse();
    }
    
    cPrev = c; 

    arrTable.unshift(th); 

    for (ro=0; ro<rows; ro++) {
        for (co=0; co<columns; co++) {
            document.getElementById("sortable").rows[ro].cells[co].innerHTML = arrTable[ro][co];
        }
    }
}


    </script>
</x-app-layout>