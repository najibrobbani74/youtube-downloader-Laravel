<x-guest-layout>
    @include('layouts.navigation')
    <section class="text-gray-600 body-font overflow-hidden mt-5">
        <div class="container px-5 mx-auto">
            <div class=" mx-auto flex flex-col items-center">
                <img alt="ecommerce" style="width: 800px;height:450px" class=" rounded-lg object-cover object-center rounded"
                    src={{ $video->snippet->thumbnails->high->url }}>
                <div class="lg:w-4/5 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $video->snippet->title }}</h1>
                    <div class="flex border-t border-gray-200 py-2 w-full">
                        <span class="text-gray-500">Download</span>
                        <span onclick="scrollWindow('#downloadSection')" class="ml-auto inline-flex items-center bg-red-500 border-0 py-1 px-3 focus:outline-none hover:bg-red-700 rounded text-white mt-4 md:mt-0">Download
                        </span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2 w-full">
                        <span class="text-gray-500">Channel</span>
                        <span class="ml-auto text-gray-900"
                            name="videoChannel">{{ $video->snippet->channelTitle }}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2 w-full">
                        <span class="text-gray-500">Published at: </span>
                        <span class="ml-auto text-gray-900"
                            name="videoPublishedAt">{{ $video->snippet->publishedAt }}</span>
                    </div>
                    <div class="flex flex-col border-t border-gray-200 py-2 w-full">
                        <span class="text-gray-500 mb-3">Description: </span>
                        <span style="white-space:pre-line" class="mr-auto text-gray-900 mb-3"
                            name="videoDescription">{{ $video->snippet->description }}</span>
                    </div>
                    <div>
                        @if (isset($video->snippet->tags))
                        @foreach ($video->snippet->tags as $tag)
                        <span class="inline-block py-1 px-2 rounded  bg-red-100 text-red-500 text-xs font-medium tracking-widest">{{$tag}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
    </section>
    <section class="bg-white pb-10" id="downloadSection">
        <div class="flex flex-col overflow-x-auto mx-5">
            <div class="sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-3 py-4">Download</th>
                                    <th scope="col" class="px-3 py-4">Mime Type</th>
                                    <th scope="col" class="px-3 py-4">Audio Quality</th>
                                    <th scope="col" class="px-3 py-4">Audio Sample Rate</th>
                                    <th scope="col" class="px-3 py-4">Height</th>
                                    <th scope="col" class="px-3 py-4">Width</th>
                                    <th scope="col" class="px-3 py-4">I Tag</th>
                                    <th scope="col" class="px-3 py-4">Quality</th>
                                    <th scope="col" class="px-3 py-4">Quality Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($downloadDetails as $item)
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-3 py-4">
                                            @if (Auth::check())
                                            <button onclick="downloadAction('{{Auth::user()->id}}','{{$video->id}}','{{$video->snippet->thumbnails->high->url}}','{{$video->snippet->title}}','{{$video->snippet->channelTitle}}','{{$item->url}}')" target="__blank"
                                                class=" inline-flex items-center bg-red-500 border-0 py-1 px-3 focus:outline-none hover:bg-red-700 rounded text-white my-auto md:mt-0">Download
                                            </button>
                                            @else
                                            <a href={{$item->url}} target="__blank"
                                                class=" inline-flex items-center bg-red-500 border-0 py-1 px-3 focus:outline-none hover:bg-red-700 rounded text-white my-auto md:mt-0">Download
                                            </a>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4">{{ explode(';', $item->mimeType)[0] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4">{{ $item->audioQuality }}</td>
                                        <td class="whitespace-nowrap px-3 py-4">{{ $item->audioSampleRate }}</td>
                                        <td class="whitespace-nowrap px-3 py-4">{{ $item->height }}</td>
                                        <td class="whitespace-nowrap px-3 py-4">{{ $item->width }}</td>
                                        <td class="whitespace-nowrap px-3 py-4">{{ $item->itag }}</td>
                                        <td class="whitespace-nowrap px-3 py-4">{{ $item->quality }}</td>
                                        <td class="whitespace-nowrap px-3 py-4">{{ $item->qualityLabel }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
        function downloadAction(user_id, video_id, thumbnail, title, channel, link_download) {
            $.ajax({
                url: "/storeHistory",
                type: "POST",
                data: {
                    "_token": '{{ csrf_token() }}',
                    "user_id":user_id,
                    "video_id":video_id,
                    "thumbnail":thumbnail,
                    "title":title,
                    "channel":channel,
                    "link_download":link_download
                },
                success: function (res) {
                    window.open(link_download) 
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
            });

        }
    </script>
</x-guest-layout>
