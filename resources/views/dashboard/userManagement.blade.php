<x-app-layout>
    <x-slot name="header">
        <a href="/dashboard/user/create" class="font-semibold text-xl text-gray-800 leading-tight">
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create
                User</button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table id="sortable" class="min-w-full divide-y divide-gray-200 mt-2">
                    <thead>
                        <tr>
                            <th onclick="sortBy(1)" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th onclick="sortBy(2)" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th onclick="sortBy(3)" class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipe User
                            </th>
                            <td class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </td>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="">
                            @foreach ($users as $user)
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 break-words">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->utype }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ '/dashboard/user/' . $user->id }}" method="post" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                                    </form>
                                    <a href="{{ '/dashboard/user/' . $user->id . '/edit' }}"
                                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        cPrev = -1;

function sortBy(c) {
    rows = document.getElementById("sortable").rows.length;
    columns = document.getElementById("sortable").rows[0].cells.length;
    arrTable = [...Array(rows)].map(e => Array(columns));

    for (ro=0; ro<rows; ro++) {
        for (co=0; co<columns; co++) {
            arrTable[ro][co] = document.getElementById("sortable").rows[ro].cells[co].innerHTML;
        }
    }

    th = arrTable.shift();

    if (c !== cPrev) {
        arrTable.sort(
            function (a, b) {
                if (a[c] === b[c]) {
                    return 0;
                } else {
                    return (a[c] < b[c]) ? -1 : 1;
                }
            }
        );
    } else {
        arrTable.reverse();
    }
    
    cPrev = c;

    arrTable.unshift(th);

    for (ro=0; ro<rows; ro++) {
        for (co=0; co<columns; co++) {
            document.getElementById("sortable").rows[ro].cells[co].innerHTML = arrTable[ro][co];
        }
    }
}
    </script>
</x-app-layout>