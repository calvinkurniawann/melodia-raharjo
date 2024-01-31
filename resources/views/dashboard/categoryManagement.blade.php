<x-app-layout>
    <x-slot name="header">
        <div class="">
            <form action="/dashboard/category" method="POST" class="flex flex-col">
                @csrf
                <label for="name">Tambah Kategori:</label>
                <div class="flex flex-row">
                    <input type="text" name="name" id="name " class="w-44 mr-7" required>
                    <button type="submit" class="bg-blue-400 p-5 text-white rounded">Submit</button>
                </div> 
            </form>  
        </div>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 mt-2">
                    <thead>
                        <tr>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </td>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </td>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            @foreach ($categories as $category)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ '/dashboard/category/' . $category->id }}" method="post" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                                    </form>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
