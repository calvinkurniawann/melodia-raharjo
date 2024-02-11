<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function payAndCreateOrder(Request $request)
    {
        $requestData = $request->json()->all();

        DB::transaction(function () use ($requestData) {
            $user = auth()->user();

            $orderDetail = \App\Models\OrderDetail::create([
                'id_user' => $user->id,
                'unique_string' => Str::random(10),
                'total_harga' => $requestData['totalPrice'],
                'payment_status' => $requestData['payment_status'],
            ]);


            $barangData = $requestData['barangData'];

            foreach ($barangData as $barangKeranjang) {
                $barang = Barang::where('id', $barangKeranjang["id"])->first();

                $orderItem = new OrderItem([
                    'id_order_detail' => $orderDetail->id,
                    'id_barang' => $barang->id,
                    'nama_barang' => $barang->nama,
                    'harga'      => $barangKeranjang['harga'],
                    'kuantitas'   => $barangKeranjang['pivot']['kuantitas'],
                ]);
                $orderDetail->orderItems()->save($orderItem);

                $barang->update([
                    'stok' => $barang->stok - $barangKeranjang['pivot']['kuantitas']
                ]);
            }

            Cart::destroy($requestData['id_cart']);

            $payload = [
                'transaction_details' => [
                    'order_id' => $orderDetail->unique_string,
                    'gross_amount' => $orderDetail->total_harga,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email'      => $user->email,
                    'nomor_hp'   => $user->no_telepon,
                ],
                
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);
            $orderDetail->snap_token = $snapToken;
            $orderDetail->save();

            $this->response['snap_token'] = $snapToken;
        });

        return response()->json([
            'status'     => 'success',
            'snap_token' => $this->response,
        ]);
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.serverKey');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $order = OrderDetail::where('unique_string', $request->order_id)->first();
                $order->update(['payment_status' => 'paid']);
            }
        }
    }

    public function PesananPendingView()
    {
        $user = auth()->user();

        $orderDataPending = OrderDetail::with(['orderItems', 'user'])
            ->where('id_user', $user->id)
            ->where('payment_status', 'pending')
            ->get();

        return view('pesanan.pesananPending', ['orderDataPending' => $orderDataPending]);
    }

    public function PesananPaidView()
    {
        $user = auth()->user();

        $orderDataPaid = OrderDetail::with(['orderItems', 'user'])
            ->where('id_user', $user->id)
            ->where('payment_status', 'paid')
            ->get();

        return view('pesanan.pesananPaid', ['orderDataPaid' => $orderDataPaid]);
    }

    public function terima(Request $request) 
    {
        $order = OrderDetail::where('id', $request->input('id_order'))->first();
        $order->update(['status' => 'Proses']);

        return redirect()->back()->with('success', 'success update status order');
    }

    public function selesai(Request $request) 
    {
        $order = OrderDetail::where('id', $request->input('id_order'))->first();
        $order->update(['status' => 'Selesai']);

        return redirect()->back()->with('success', 'success update status order');
    }


    public function destroy(Request $request)
    {
        $id_order = $request->input('id_order');
        $orderData = OrderDetail::with('orderItems')
            ->where('id', $id_order)
            ->get();
        foreach ($orderData as $order) {
            foreach ($order->orderItems as $orderItem) {
                $product = barang::where('id', $orderItem["id_product"])->first();

                $product->update([
                    'stok' => $barang->stok + $orderItem->kuantitas
                ]);
            }
        }
        OrderDetail::destroy($id_order);

        return redirect()->back()->with('success', 'success hapus order');
    }
}