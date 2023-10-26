<x-guest-layout>
    @include('layouts.navigation')
    <section
        class="min-h-96 relative flex flex-1 shrink-0 items-center justify-center overflow-hidden bg-gray-100 py-16 shadow-lg md:py-20 xl:py-48">

        <img src="{{ url('/img/youtube-banner.png') }}" loading="lazy" alt="Photo by Fakurian Design"
            class="absolute inset-0 h-full w-full object-cover object-center" />

        <!-- overlay - start -->
        <div class="absolute inset-0 bg-gray-700 mix-blend-multiply"></div>
        <!-- overlay - end -->

        <!-- text start -->
        <div class="relative flex flex-col items-center p-4 sm:w-xl">
            <h1 class="mb-8 text-center text-4xl font-bold text-white sm:text-5xl md:mb-5 md:text-6xl">Temukan <span
                    class="text-red-500">video</span> menarik anda dan <span class="text-red-500">download</span> dengan
                mudah</h1>
            <p class="mb-4 text-center text-lg text-indigo-200 sm:text-xl md:mb-8">Cukup tempel link video youtube anda
                dan download dengan mudah </p>

            <div class="flex w-full flex-col gap-2.5 sm:w-2/3 sm:justify-center">
                <div class="flex mb-4">
                    <input type="text" id="search-input" name="full-name"
                        class="w-full bg-white border rounded-l-lg border-gray-300 focus:border-indigo-500 focus:ring-2  focus:ring-indigo-200 text-2xl outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out"
                        placeholder="Paste your youtube video link">
                    <button onclick="findVideo()"
                        class="text-white bg-red-500 border-0 py-2 px-8 rounded-r-lg focus:outline-none hover:bg-red-600  text-lg">Search</button>
                </div>
            </div>
        </div>
    </section>
    <section class="text-gray-600 body-font">
        <div id="list-video">


        </div>
    </section>
    <section id="example-element" class="hidden">
        <div class="container mx-auto flex px-5 py-5 md:flex-row flex-col items-center">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0 p-auto">
                <img class="object-cover object-center rounded m-auto" style="width: 400px;height: 225px;" alt="hero"
                    name="videoThumbnail" src="https://dummyimage.com/720x600">
            </div>
            <div
                class="lg:flex-grow md:w-1/2 lg:p-5 md:p-auto flex flex-col md:items-start md:text-left items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900" name="videoTitle">
                </h1>
                <div class="flex border-t border-gray-200 py-2 w-full">
                    <span class="text-gray-500">Channel</span>
                    <span class="ml-auto text-gray-900" name="videoChannel"></span>
                </div>
                <div class="flex border-t border-gray-200 py-2 w-full">
                    <span class="text-gray-500">Published at: </span>
                    <span class="ml-auto text-gray-900" name="videoPublishedAt"></span>
                </div>
                <div class="flex flex-col border-t border-gray-200 py-2 w-full">
                    <span class="text-gray-500 mb-3">Description: </span>
                    <span class="ml-auto text-gray-900 mb-3" name="videoDescription"></span>
                </div>
                <!-- <button name="videoDescription"
                    class=" inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg my-3">Lihat
                    deskripsi</button> -->
                <div class="flex justify-center">
                    <button name="videoDetail"
                        class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Lihat
                        detail</button>

                </div>
            </div>
        </div>
    </section>
    <script>
        function scrollWindow(hash) {
            $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function () {});
        }
        function findVideo() {
            let searchInput = document.getElementById('search-input').value
            let search;
            if (searchInput.split("https://youtu.be/").length > 1) {
                var url = new URL(searchInput);
                search = url.searchParams.get("v");
                if (!search) {
                    search = url.pathname.split("/")
                    search = search[search.length - 1]
                }
                window.location = "/video/" + search
            }
            $.ajax({
                url: "/video?search=" + searchInput,
                type: 'GET',
                dataType: 'json', // added data type
                success: function (res) {
                    if (res.items.length == 0) {
                        alert('Video tidak ditemukan')
                    }
                    document.getElementById('list-video').innerHTML = "";
                    res.items.map((data) => {
                        // console.log(data);
                        let clone = document.getElementById('example-element').children[0].cloneNode(true)
                        clone.querySelector('img[name="videoThumbnail"]').src = data.snippet.thumbnails.high.url;
                        clone.querySelector('h1[name="videoTitle"]').innerHTML = data.snippet.title;
                        clone.querySelector('span[name="videoChannel"]').innerHTML = data.snippet.channelTitle;
                        clone.querySelector('span[name="videoPublishedAt"]').innerHTML = data.snippet.publishedAt;
                        clone.querySelector('span[name="videoDescription"]').innerHTML = data.snippet.description
                        clone.querySelector('button[name="videoDetail"]').onclick = () => {
                            window.location = '/video/' + data.id.videoId;
                        }
                        document.getElementById('list-video').append(clone)
                    })
                    scrollWindow("#list-video")
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
            });
        }
    </script>
</x-guest-layout>