<x-app-layout>
    <x-slot name="header">
        <p class="text-3xl">Create User</p>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-5">
                <form class="max-w-sm mx-auto" action="/dashboard/user" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="nama"
                            class="block mb-2 text-[15px] font-medium text-gray-900">Name:
                        </label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-[15px] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Username" required>
                    </div>
                    <div class="mb-5">
                        <label for="email"
                            class="block mb-2 text-[15px] font-medium text-gray-900 ">Email
                        </label>
                        <input type="email" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-[15px] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5   dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="user@example.com" required>
                    </div>
                    <div class="mb-5">
                        <label for="password"
                            class="block mb-2 text-[15px] font-medium text-gray-900 ">Password
                        </label>
                        <input type="password" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-[15px] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Password" required>
                    </div>
                    <div class="mb-5">
                        <label for="utype"
                            class="block mb-2 text-[15px] font-medium text-gray-900">Tipe User 
                        </label>
                        <input type="text" id="utype" name="utype"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-[15px] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="ADM/USR" required>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-[15px] w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>