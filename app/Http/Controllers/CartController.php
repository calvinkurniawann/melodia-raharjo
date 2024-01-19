<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function CartView(Request $request)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            $user = auth()->user();
            $cart = $user->cart;
    
            // Check if the user has a cart; create one if not
            if ($cart === null) {
                $cart = $user->cart()->create(['id_user' => $user->id]);
            }
    
            $cartItems = $cart->products()->withPivot('kuantitas')->get();
    
            $calculateTotalHarga = function ($cartItems) {
                return $cartItems->reduce(function ($total, $item) {
                    $productHarga = $item['harga'] * $item['pivot']['kuantitas'];
                    return $total + $productHarga;
                }, 0);
            };
    
            $totalPrice = $calculateTotalHarga($cartItems);
    
            return view('cart', compact('cartItems', 'totalPrice'));
        } else {
            // Handle the case where the user is not authenticated
            return redirect()->route('login'); // You can redirect to the login page or handle it according to your application logic.
        }
    }
    


    public function addToCart(Request $request)
    {
        $productId = (int)$request->input('id_product');
        $product = Barang::findOrFail($productId);
        $user = auth()->user();

        if ($user) {
            $cart = $user->cart ?? $user->cart()->create(['id_user' => $user->id]);
        } else {
            return redirect()->route('login')->with('error', 'Please log in to add items to your cart.');
        }

        $kuantitas = $request->input('kuantitas', 1);

        if ($cart->products()->where('id_product', $productId)->exists()) {
            $currentKuantitas = $cart->products()->where('id_product', $productId)->first()->pivot->kuantitas;
            $newKuantitas = $currentKuantitas + 1;

            if ($newKuantitas <= $product->stok) {
                Log::info($product->stok);
                $cart->products()->updateExistingPivot($productId, ['kuantitas' => DB::raw($newKuantitas)]);
                return redirect()->route('cart')->with('success', 'Item added to cart successfully!');
            } else {
                return redirect()->back()->with('error', 'Stok tidak cukup');
            }
        } else {
            $cart->products()->attach($productId, ['kuantitas' => $kuantitas]);
            return redirect()->route('cart')->with('success', 'Kuantitas added to the product successfully!');
        }

        return redirect()->back()->with('error', 'Item failed to go to cart..');
    }

    public function delete($productId)
    {
        $user = auth()->user();
        $cart = $user->cart;
        if ($cart->products()->where('id_product', $productId)->exists()) {
            $cart->products()->detach($productId);
            return redirect('/cart')->with('success', 'Product deleted successfully');
        }

        return redirect('/home')->with('error', 'Product not found');
    }

    // UPDATE
    public function update(Request $request, $productId)
    {
        $action = $request->input('action');
        $user = auth()->user();
        $cart = $user->cart;
        $product = Barang::findOrFail($productId);


        if (!$cart) {
            return redirect()->route('home')->with('error', 'Product not found.');
        }
        if ($cart->products()->where('id_product', $product->id)->exists()) {
            $currentKuantitas = $cart->products()->where('id_product', $product->id)->first()->pivot->kuantitas;

            $newKuantitas = ($action === 'increment') ? $currentKuantitas + 1 : max($currentKuantitas - 1, 0);

            if ($newKuantitas > 0) {
                if ($newKuantitas <= $product->stok) {
                    $cart->products()->updateExistingPivot($product->id, ['kuantitas' => DB::raw($newKuantitas)]);
                    return redirect()->route('cart')->with('success', 'Cart updated successfully.');
                } else {
                    return redirect()->route('cart')->with('eror', 'Stok tidak mencukupo');
                }
            } else {
                // Remove the record from the pivot table
                $cart->products()->detach($product->id);
                return redirect()->route('cart')->with('success', 'Cart updated successfully.');
            }
        }
        return response()->json(['error' => 'Invalid product in the cart.'], 400);
    }
}
