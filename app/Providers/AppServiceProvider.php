<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use App\Models\OrderDetail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.navbar', function ($view) {
            // Fetch the cart item count here
            $cartItemCount = 0;
    
            // Assuming you have a Cart model with a relationship to products
            $user = auth()->user();
            if ($user) {
                $cart = $user->cart;
                if ($cart) {
                    $cartItemCount = $cart->products->count();
                }
            }
    
            $view->with('cartItemCount', $cartItemCount);
        });

        View::composer('layouts.navigation', function ($view) {
            $orderCount = 0;
        
            $order = OrderDetail::where('status' , 'Menunggu Konfirmasi')->get(); 
            if ($order->count() > 0) {
                $orderCount = $order->count();
            }
        
            $view->with('orderCount', $orderCount);
        });

    }
}
