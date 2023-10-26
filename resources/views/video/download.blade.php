<x-guest-layout>
    @include('layouts.navigation')
    <!-- component -->
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
                            @foreach ($video as $item)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-3 py-4">
                                        @if (Auth::check())
                                        <button onclick="downloadAction('{{Auth::user()->id}}','{{$video_id}}','{{$item->id}}','{{$video_id}}','{{$video_id}}','{{$video_id}}')" target="__blank"
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
    <script>
        console.log({!! json_encode($video) !!});
        function downloadAction(user_id, video_id, thumbnail, title, channel, link_download) {
            $.ajax({
                url: "/storeHistory",
                type: "post",
                data: {
                    "user_id":user_id,
                    "video_id":video_id,
                    "thumbnail":thumbnail,
                    "title":title,
                    "channel":channel,
                    "link_download":link_download
                },
                success: function (res) {
                    console.log(res);
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
            });

        }
    </script>
</x-guest-layout>
