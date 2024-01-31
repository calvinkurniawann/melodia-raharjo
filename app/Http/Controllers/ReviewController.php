<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
    // Validate the request data
    $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'comment' => 'required|string',
    ]);

    // Create a new review
    $review = new Review([
        'barang_id' => $request->input('barang_id'),
        'user_id' => Auth::id(), // Assuming users are authenticated
        'comment' => $request->input('comment'),
    ]);

    // Save the review
    $review->save();

    // Redirect back to the product detail page with a success message
    return redirect()->route('dashboard.barang.show', ['barang' => $request->input('barang_id')])
    ->with('success', 'Review submitted successfully!');
    }

}