<x-guest-layout>
    @include('layouts.navigation')
    <!-- component -->
<section class="container mx-auto p-2 ">
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100  border-b border-gray-600">
              <th class="px-4 py-3">Thumbnail</th>
              <th class="px-4 py-3">Title</th>
              <th class="px-4 py-3">Action</th>
              <th class="px-4 py-3">Date</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ($histories as $item)
                
            <tr class="text-gray-700">
                <td class="px-4 py-3 border">
                    <img style="min-width:200px;height:112px;" class=" rounded-lg object-cover object-center rounded" src={{$item->thumbnail}} alt="">
                </td>
                <td class="px-4 py-3 text-ms border">
                    <div class="flex flex-col">
                        <span class="text-lg whitespace-nowrap"><b>{{$item->title}}</b></span>
                        <span class="text-base whitespace-nowrap">{{$item->channel}}</span>
                    </div>
                </td>
                <td class="px-4 py-3 text-xs border">
                    <div class="flex flex-wrap">
                        <a href="/video/{{$item->video_id}}" class="px-2 mx-1 my-1 py-1 font-semibold leading-tight text-orange-700 hover:bg-orange-200 bg-orange-100 rounded-sm"> Detail Video </a>
                        <a target="__blank" href={{$item->link_download}} class="px-2 py-1 mx-1 my-1 font-semibold leading-tight text-green-700 bg-green-100 hover:bg-green-200 rounded-sm"> Download </a>
                        <a href="#" onclick="deleteHistory({{$item->id}})" class="px-2 py-1 mx-1 my-1 font-semibold leading-tight text-red-700 bg-red-100 hover:bg-red-200 rounded-sm"> Delete </a>
                    </div>
                </td>
                <td class="px-4 py-3 text-sm border">{{$item->created_at}}</td>
            </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <script>
    function deleteHistory(id) {
        if (confirm("Data yang dihapus tidak dapat dikembalikan. Apakah anda yakin?")) {
            
            $.ajax({
                url: "/deleteHistory/"+id,
                type: "DELETE",
                data: {
                    "_token": '{{ csrf_token() }}',
                },
                success: function (res) {
                    window.location.reload()
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
            });
        }
    }
  </script>
</x-guest-layout>