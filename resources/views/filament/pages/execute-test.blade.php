<x-filament::page>

    <form wire:submit.prevent="submit" class="space-y-6">
        {{ $this->form }}

        <div class="flex flex-wrap items-center gap-4 justify-start">
            <x-filament::button type="submit">
                Execute Test
            </x-filament::button>

        </div>
    </form>

    <code class="block whitespace-pre overflow-x-scroll">
<pre class="p-3">
{!! $output !!}
</pre>
    </code>

</x-filament::page>
