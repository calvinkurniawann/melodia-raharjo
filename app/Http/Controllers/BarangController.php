<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::with('category')->get();
        return view('dashboard.barangManagement', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.createbarang', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust allowed image types and size
        ]);

        // Handle the image upload
        $gambarPath = $request->file('gambar')->store('gambar', 'public');

        // Create a new Barang instance
        $barang = new Barang([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'category_id' => $request->input('category_id'),
            'stok' => $request->input('stok'),
            'gambar' => $gambarPath,
        ]);

        // Save the Barang instance to the database
        $barang->save();

        // Redirect to a specific route or perform any other action after saving

        return redirect()->route('dashboard.barang.index')->with('success', 'Barang has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        $barang->load('category');
        return view('barangDetail', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.    
     */
    public function edit(Barang $barang)
    {
        // $barang = Barang::findOrFail($barang->id);
        $barang->load('category');
        $categories = Category::all();
        return view('dashboard.barangEdit', compact('barang','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust allowed image types and size
        ]);

        // Handle the image upload if a new file is provided
        if ($request->hasFile('gambar')) {
            // Delete the old image if it exists
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }

            // Upload the new image
            $gambarPath = $request->file('gambar')->store('gambar', 'public');
            $barang->gambar = $gambarPath;
        }

        // Update other fields
        $barang->nama = $request->input('nama');
        $barang->deskripsi = $request->input('deskripsi');
        $barang->category_id = $request->input('category_id');
        $barang->harga = $request->input('harga');
        $barang->stok = $request->input('stok');

        // Save the changes to the database
        $barang->save();

        // Redirect to a specific route or perform any other action after updating

        return redirect()->route('dashboard.barang.index')->with('success', 'Barang has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        // Delete the record from the database
        $barang->delete();

        // Redirect to a specific route or perform any other action after deletion

        return redirect()->route('dashboard.barang.index')->with('success', 'Barang has been deleted successfully!');
    }

    public function search(Request $request)
{
    $search = $request->input('search');
    $categories = Category::all();

    $barangs = Barang::leftJoin('categories', 'barangs.category_id', '=', 'categories.id')
        ->where('barangs.nama', 'like', "%$search%")
        ->orWhere('categories.name', 'like', "%$search%")
        ->get();

    // Dump the results for better visibility
    // dd([
    //     'results' => $barangs->toArray(),
    // ]);

    return view('category.index', compact('barangs', 'search', 'categories'));
}


}
