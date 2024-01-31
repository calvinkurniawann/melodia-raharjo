<x-app-layout>
    <x-slot name="header">
        <a href="/dashboard/barang/create" class="font-semibold text-xl text-gray-800 leading-tight">
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create
                Barang</button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 mt-2">
                    <thead>
                        <tr>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gambar
                            </td>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </td>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </td>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga
                            </td>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stok
                            </td>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </td>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            @foreach ($barangs as $barang)
                                <td class="px-6 py-4">
                                    @if ($barang->gambar == 'default.jpg')
                                        <img class="h-28 object-contain" alt="Image"
                                            src="{{ asset('gambar/default.jpg') }}" />
                                    @else
                                        <img class="h-28 object-contain" alt="Image"
                                            src="{{ asset('storage/' . $barang->gambar) }}" />
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $barang->nama }}
                                </td>
                                <td class="px-6 py-4 break-words">
                                    {{ $barang->deskripsi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    Rp. {{ number_format($barang->harga) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $barang->stok }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ '/dashboard/barang/' . $barang->id }}" method="post" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                                    </form>
                                    <a href="{{ '/dashboard/barang/' . $barang->id . '/edit' }}"
                                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
