<header class="text-gray-600 body-font bg-white">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <a href="/" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
        <span class="ml-3 text-xl">Youtube<span class="text-red-500">Downloader</span></span>
      </a>
      {{-- <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
        <a class="mr-5 hover:text-gray-900">First Link</a>
        <a class="mr-5 hover:text-gray-900">Second Link</a>
        <a class="mr-5 hover:text-gray-900">Third Link</a>
        <a class="mr-5 hover:text-gray-900">Fourth Link</a>
      </nav> --}}
      <div class="md:ml-auto">
        <a href={{route('login')}} class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 mr-2 focus:outline-none hover:bg-red-100  rounded text-red-500 mt-4 md:mt-0">Sign Up
        </a>
        <a href={{route('register')}} class="inline-flex items-center bg-red-500 border-0 py-1 px-3 focus:outline-none hover:bg-red-700 rounded text-white mt-4 md:mt-0">Sign In
        </a>
      </div>
    </div>
  </header>