<x-filament::page>

    <div class="grid grid-cols-1 gap-2">

        <div class="text-xl font-bold pt-2">Name: {{(new App\Models\Url)->find($data['url_id'])->name}}</div>

        <div class="text-xl font-bold pt-2">URI: {{$data['called_url']}}</div>

        <div class="text-xl font-bold pt-2">Status: {{$data['response_ok'] ? 'OK' : "FAILED"}}</div>
        <div class="text-xl font-bold pt-2">Response Time</div>
        <div class="bg-gray-400 w-full">{{$data['response_time']}} microseconds ({{$data['response_time']/1000000}}
            seconds)
        </div>
        <div class="text-xl font-bold pt-2">Curl Info</div>
        <code class="block whitespace-pre overflow-x-scroll">
            <pre class="p-3">
{!! htmlentities($data['curl_info']) !!}
            </pre>
        </code>
    </div>

    <div class="text-xl font-bold">Request</div>
    <div class="bg-gray-400 w-full">{{$data['request_date']}}</div>
    <div class="bg-gray-400 w-full">
        <code class="block whitespace-pre overflow-x-scroll">
            <pre class="p-3">
{{$data['request']}}
            </pre>
        </code>
    </div>

    <div class="text-xl font-bold">Response</div>
    <div class="bg-gray-400 w-full">{{$data['response_date']}}</div>
    <div class="bg-gray-400 w-full">
        <code class="block whitespace-pre overflow-x-scroll">
            <pre class="p-3">
{{$data['response']}}
            </pre>
        </code>
    </div>

    <div class="text-xl font-bold">Request Headers</div>
    <div class="bg-gray-400 w-full">
        <code class="block whitespace-pre overflow-x-scroll">
            <pre class="p-3">
{{$data['request_headers']}}
            </pre>
        </code>
    </div>

    <div class="text-xl font-bold">Request Certificates</div>
    <div class="bg-gray-400 w-full">
        <code class="block whitespace-pre overflow-x-scroll">
            <pre class="p-3">
{{json_encode(json_decode($data['certificates_used']), JSON_PRETTY_PRINT)}}
            </pre>
        </code>
    </div>

</x-filament::page>
