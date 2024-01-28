<x-guest-layout>
    <div class="max-w-7xl px-10 py-5 min-h-[200px]">
        <div class="w-full rounded-lg p-5 mb-10">
            <div class="w-full h-10 flex justify-between">
                <p class="text-xl font-semibold">Detail Produk</p>
            </div>
            <div class="w-full flex justify-between items-center space-x-3">
                @if ($barang->gambar == 'default.jpg')
                    <img src="{{ asset('gambar/default.jpg') }}"
                        class="h-32 object-contain bg-[rgb(209,211,212)] rounded-lg" alt="" />
                @else
                    <img src="{{ asset('storage/' . $barang->gambar) }}"
                        class="h-32 object-contain bg-[rgb(209,211,212)] rounded-lg" alt="" />
                @endif

                <div class="w-full flex flex-col">
                    <div class="w-full min-h-[40%] p-4">
                        <p class="text-xl">Nama</p>
                        <span class="text-3xl font-bold mt-5 break-all">{{ $barang->nama }}</span>
                    </div>
                    <div class="w-full min-h-[40%] p-4">
                        <p class="text-xl">Deskripsi</p>
                        <span class="text-3xl font-bold mt-5 break-all">{{ $barang->deskripsi }}</span>
                    </div>
                    <form action="{{ route('cart.add') }}" method='POST'>
                        @csrf
                        @method('post')
                        <input type="hidden" value="{{ $barang->id }}" name="id_product">
                        <input type="hidden" value="1" name="kuantitas">
                        <div class="w-full flex justify-between items-center">
                            <button type="submit" class="bg-red-600 mt-2 w-32 h-10 font-semibold">Add to Cart</button>
                            <div>
                                <p>Stok: </p>
                                <p>{{ $barang->stok }}</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h2>Customer Reviews</h2>
@forelse ($barang->reviews as $review)
    <div>
        <p><strong>Rating: </strong>{{ $review->rating }}</p>
        <p><strong>User: </strong>{{ $review->user->name }}</p>
        <p>{{ $review->comment }}</p>
    </div>
@empty
    <p>No reviews yet.</p>
@endforelse

{{-- Add a Form for Adding Reviews (Assuming authenticated users) --}}
@auth
    <form method="post" action="{{ route('reviews.store') }}">
        @csrf
        <input type="hidden" name="barang_id" value="{{ $barang->id }}">
        <label for="rating">Rating:</label>
        <input type="number" name="rating" min="1" max="5" required>
        <label for="comment">Comment:</label>
        <textarea name="comment" required></textarea>
        <button type="submit">Submit Review</button>
    </form>
@else
    <p>Please log in to leave a review.</p>
@endauth
        </div>
    </div>
</x-guest-layout>
