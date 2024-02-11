<x-guest-layout>
    @if ($orderDataPending->count() > 0)
        {{-- {{ $orderDataPending }} --}}
        <div class="w-full grid grid-cols-3 my-10 gap-4 px-10">
            @foreach ($orderDataPending as $order)
                @php
                    $firstOrder = $order;
                    $orderItems = $firstOrder['order_items'];
                    $order->load('orderItems');
                @endphp

                <div id="toggleButton_{{ $order->id }}" data-order-id="{{ $order->id }}"
                    class="relative cursor-pointer col-span-1 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 max-h-[200px] overflow-hidden">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Order id:</h5>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $order->unique_string }}</h5>
                    <p class="mt-2 font-normal text-gray-700 dark:text-gray-400">
                        Total harga:
                    </p>
                    <p class="mb-3 text-black font-semibold dark:text-gray-400">
                        Rp. {{ number_format($order->total_harga) }}
                    </p>
                    <div class="absolute bottom-3 right-2 flex justify-between items-center space-x-2">
                        <form action="/order/destroy" method="post">
                            @csrf
                            @method('post')
                            <input type="hidden" name="id_order" value="{{ $order->id }}">
                            <button type="submit" id="delete-button"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><svg
                                    viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 group">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M10 12L14 16M14 12L10 16M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                            stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </g>
                                </svg></button>
                        </form>
                        <div id="pay-button_{{ $order->id }}" data-snap-token="{{ $order->snap_token }}"
                            class="flex pay-button cursor-pointer items-center w-32 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Bayar sekarang
                        </div>
                    </div>
                </div>

                <div id="invoice_{{ $order->id }}"
                    class="hidden bg-[rgba(0,0,0,0.5)] min-h-screen overflow-y-auto bg-overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 py-10">
                    <div class="relative w-[500px] bg-white rounded-lg z-10 shadow-lg px-8 py-10 mx-auto top-0">
                        <div class="border-b-2 border-gray-300 pb-3 mb-8 flex justify-end items-center">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                class="w-7 h-7 group fill" id="closeInvoice_{{ $order->id }}">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z"
                                        fill="#0F0F0F" class="group-hover:fill-red-500"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center">
                                <img class="h-8 w-8 mr-2"
                                    src="https://tailwindflex.com/public/images/logos/favicon-32x32.png" alt="Logo" />
                                <div class="text-gray-700 font-semibold text-lg">Asal Gemi</div>
                            </div>
                            <div class="text-gray-700">
                                <div class="font-bold text-xl mb-2">INVOICE</div>
                                <div class="text-sm">{{ $order->created_at }}</div>
                                <div class="text-sm">{{ $order->unique_string }}</div>
                            </div>
                        </div>
                        <div class="border-b-2 border-gray-300 pb-8 mb-8">
                            <h2 class="text-2xl font-bold mb-4">Bill To:</h2>
                            <div class="text-gray-700 mb-2">{{ $firstOrder->user->name }}</div>
                            {{-- <div class="text-gray-700 mb-2">{{ $firstOrder->user->alamat }}</div> --}}
                            <div class="text-gray-700">{{ $firstOrder->user->emeil }}</div>
                        </div>
                        <table class="w-full text-left mb-8">
                            <thead>
                                <tr>
                                    <th class="text-gray-700 font-bold uppercase py-2">Description</th>
                                    <th class="text-gray-700 font-bold uppercase py-2">Quantity</th>
                                    <th class="text-gray-700 font-bold uppercase py-2">Price</th>
                                    <th class="text-gray-700 font-bold uppercase py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $product)
                                    <tr>
                                        <td class="py-4 text-gray-700">{{ $product->nama_product }}</td>
                                        <td class="py-4 text-gray-700">{{ $product->kuantitas }}</td>
                                        <td class="py-4 text-gray-700">Rp. {{ number_format($product->harga) }}</td>
                                        <td class="py-4 text-gray-700">Rp.
                                            {{ number_format($product->harga * $product->kuantitas) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-end mb-8">
                            <div class="text-gray-700 mr-2">Total:</div>
                            <div class="text-gray-700 font-bold text-xl">Rp. {{ number_format($order->total_harga) }}</div>
                        </div>
                        <div class="border-t-2 border-gray-300 pt-8 mb-8 flex justify-between items-center">
                            <form action="/order/destroy" method="post">
                                @csrf
                                @method('post')
                                <input type="hidden" name="id_order" value="{{ $order->id }}">
                                <button type="submit"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><svg
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 group">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M10 12L14 16M14 12L10 16M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                                stroke="#FFF" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </path>
                                        </g>
                                    </svg></button>
                            </form>
                            <div id="pay-button2_{{ $order->id }}" data-snap-token="{{ $order->snap_token }}"
                                class="flex pay-button cursor-pointer items-center w-32 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Bayar sekarang
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="w-full mx-auto text-center">
            <p class="text-3xl mt-20">Belum ada order apapun yang kamu buat</p>
        </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('[id^="toggleButton"]');

            toggleButtons.forEach(function(toggleButton) {
                toggleButton.addEventListener('click', function() {
                    const orderId = toggleButton.dataset.orderId;
                    const invoiceDiv = document.getElementById(`invoice_${orderId}`);
                    const closeInvoiceButton = document.getElementById(`closeInvoice_${orderId}`);
                    const deleteButton = document.getElementById(`delete-button_${orderId}`);
                    const payButton = document.getElementById(`pay-button_${orderId}`);

                    if (!event.target.closest('#delete-button') && !event.target.closest(
                            '.pay-button')) {
                        if (invoiceDiv) {
                            invoiceDiv.classList.toggle('hidden');
                        }
                        if (closeInvoiceButton) {
                            closeInvoiceButton.addEventListener('click', () => {
                                invoiceDiv.classList.add('hidden');
                            });
                        }
                    }
                });
            });

            const paymentButtons = document.querySelectorAll('[id^="pay-button"]');

            paymentButtons.forEach(function(paymentButton) {
                paymentButton.addEventListener('click', function() {
                    const snapToken = paymentButton.dataset.snapToken;

                    try {
                        snap.pay(snapToken, {
                            onSuccess: function(result) {
                                window.location.href = '/order/pesanan'
                            },
                            onPending: function(result) {
                                window.location.href = '/order/pesanan'
                            },
                            onClose: function(result) {
                                window.location.href = '/order/pesanan'
                            }
                        });
                    } catch (error) {
                        console.error('Error during fetch:', error);
                    };

                });
            });
            const paymentButtons2 = document.querySelectorAll('[id^="pay-button2"]');

            paymentButtons2.forEach(function(paymentButton) {
                paymentButton.addEventListener('click', function() {
                    const snapToken = paymentButton.dataset.snapToken;

                    try {
                        snap.pay(snapToken, {
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
                    } catch (error) {
                        console.error('Error during fetch:', error);
                    };

                });
            });
        });
    </script>
</x-guest-layout>