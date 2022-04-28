<x-filament::page>

    <div class="grid grid-cols-1 gap-2">

        <div class="text-xl font-bold pt-2">Url Name: {{(new App\Models\Url)->find($data['url_id'])->name}}</div>

        <div class="text-xl font-bold pt-2">Url URI: {{(new App\Models\Url)->find($data['url_id'])->url}}</div>

        <div class="text-xl font-bold pt-2">Status: {{$data['response_ok']}}</div>

        <div class="text-xl font-bold pt-2">Request</div>
        <div class="bg-gray-400 w-full">{{$data['request']}}</div>

        <div class="text-xl font-bold pt-2">Request Date</div>
        <div class="bg-gray-400 w-full">{{$data['request_date']}}</div>

        <div class="text-xl font-bold pt-2">Response</div>
        <div class="bg-gray-400 w-full">{{$data['response']}}</div>

        <div class="text-xl font-bold pt-2">Response Date</div>
        <div class="bg-gray-400 w-full">{{$data['response_date']}}</div>

        <div class="text-xl font-bold pt-2">Time to response</div>
        <div class="bg-gray-400 w-full">{{$data['response_time']}} microseconds ({{$data['response_time']/1000000}} seconds)</div>

    </div>


</x-filament::page>
