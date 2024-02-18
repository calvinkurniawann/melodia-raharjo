<x-guest-layout>
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
