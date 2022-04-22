<x-filament::page>

    <div class="grid grid-cols-1 gap-2">

        <div class="text-xl font-bold">Url Name: {{(new App\Models\Url)->find($data['url_id'])->name}}</div>

        <div class="text-xl font-bold">Url URI: {{(new App\Models\Url)->find($data['url_id'])->url}}</div>

        <div class="text-xl font-bold">Status: {{$data['response_ok']}}</div>

        <div class="text-xl font-bold">Request</div>
        <div class="bg-gray-400 w-full">{{$data['request']}}</div>

        <div class="text-xl font-bold">Request Date</div>
        <div class="bg-gray-400 w-full">{{$data['request_date']}}</div>

        <div class="text-xl font-bold">Response</div>
        <div class="bg-gray-400 w-full">{{$data['response']}}</div>

        <div class="text-xl font-bold">Response Date</div>
        <div class="bg-gray-400 w-full">{{$data['response_date']}}</div>

    </div>


</x-filament::page>
