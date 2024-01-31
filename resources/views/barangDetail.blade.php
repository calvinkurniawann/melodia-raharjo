<x-guest-layout>
    {{-- <div class="max-w-7xl px-10 py-5 min-h-[200px]">
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
    </div> --}}
    <!-- component -->
    <section class="text-gray-700 body-font overflow-hidden bg-white h-full">
        <a href="/">
            <button type="button"
                class="relative left-8 top-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-7 py-4 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kembali</button>
        </a>
    <div class="container py-24 mx-auto">
      <div class="lg:w-4/5 mx-auto flex flex-wrap">
        @if ($barang->gambar == 'default.jpg')
                    <img src="{{ asset('gambar/default.jpg') }}"
                        class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" alt="" />
                @else
                    <img src="{{ asset('storage/' . $barang->gambar) }}"
                        class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200" alt="" />
                @endif
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
          <h2 class="text-sm title-font text-gray-500 tracking-widest">{{$barang->category->name}}</h2>
          <h1 class="text-gray-900 text-5xl title-font font-bold mb-5">{{ $barang->nama }}</h1>
          <p class="leading-relaxed text-md">{{ $barang->deskripsi }}</p>
          <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
          </div>
          <div class="flex items-center">
            <span class="title-font font-medium text-2xl text-gray-900">Rp. {{ number_format($barang->harga, 0, '.', '.') }}
            </span>
            <form action="{{ route('cart.add') }}" method='POST' class="flex justify-between items-center">
                @csrf
                @method('post')
                <input type="hidden" value="{{ $barang->id }}" name="id_product">
                <div class="flex ml-6 items-center">
                    <span class="mr-3">Quantity</span>
                    <div class="relative">
                      <input type="number" name="kuantitas" min="1" value="1" class="border rounded-md px-3 py-2 mt-1 w-16 mr-[120px]">
                    </div>
                </div>
                <button class="flex text-white bg-black border-0 py-2 px-6 focus:outline-none hover:bg-white hover:border-r-[3px] hover:border-b-[3px] hover:border-[1px] hover:text-black hover:border-black rounded " type="submit">Add to Cart</button>
            </form>
          </div>
          <div class="flex flex-col justify-center mt-10">
            <h1 class="text-gray-900 text-4xl title-font font-bold mb-5">Product Comment</h1>
            <form method="post" action="{{ route('reviews.store') }}">
                @csrf
                <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                <textarea name="comment" placeholder="Ketik Ulasanmu disini" required class="p-5 min-w-full"></textarea>
                <button class="flex text-white bg-black border-0 py-2 px-6 focus:outline-none hover:bg-white hover:border-r-[3px] hover:border-b-[3px] hover:border-[1px] hover:text-black hover:border-black rounded " type="submit">Send</button>
            </form>
            <div class="mt-6">
                @forelse ($barang->reviews as $review)
                <div class="bg-white p-4 rounded shadow-md my-4">
                    <div class="flex items-center mb-2">
                        <div>
                            <h4 class="font-semibold">{{ $review->user->name }}</h4>
                        </div>
                    </div>
                    <p class="text-gray-800">{{ $review->comment }}</p>
                </div>
                @empty
                <p class="text-md">No reviews yet.</p>
                @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-guest-layout>
