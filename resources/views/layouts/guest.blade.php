<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="font-sans text-gray-900 antialiased ">
    <div class="min-h-screen flex flex-col w-full pt-6 sm:pt-0 bg-gray-200">
        <div class=" overflow-hidden ">
            {{ $slot }}
            <section>
                <footer class="bg-white dark:bg-gray-900">
                    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                        <div class="md:flex md:justify-between">
                          <div class="mb-6 md:mb-0">
                            <a href="/" class="text-white font-bold text-3xl">Melo<span class="text-blue-400">Gita</span></a>
                          </div>
                          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                              <div>
                                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                      <li class="mb-4">
                                          <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                                      </li>
                                      <li>
                                          <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                                      </li>
                                  </ul>
                              </div>
                              <div>
                                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                      <li class="mb-4">
                                          <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                                      </li>
                                      <li>
                                          <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                                      </li>
                                  </ul>
                              </div>
                              <div>
                                  <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                                  <ul class="text-gray-500 dark:text-gray-400 font-medium">
                                      <li class="mb-4">
                                          <a href="#" class="hover:underline">Privacy Policy</a>
                                      </li>
                                      <li>
                                          <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                      <div class="sm:flex sm:items-center sm:justify-between">
                          <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
                          </span>
                          <div class="flex mt-4 sm:justify-center sm:mt-0">
                              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                                    </svg>
                                  <span class="sr-only">Facebook page</span>
                              </a>
                              <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 17">
                                    <path fill-rule="evenodd" d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z" clip-rule="evenodd"/>
                                </svg>
                                  <span class="sr-only">Twitter page</span>
                              </a>
                          </div>
                      </div>
                    </div>
                </footer>
                    </section>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("#dropdownNavbarLink").click(function() {
            $("#dropdownNavbar").toggle();
            $("#dropdownIcon").toggleClass('transform rotate-180');
        });

        $(document).click(function(event) {
            if (!$(event.target).closest("#dropdownNavbarLink, #dropdownNavbar").length) {
                $("#dropdownNavbar").hide();
                $("#dropdownIcon").removeClass('transform rotate-180');
            }
        });
    });
</script>

</html>
