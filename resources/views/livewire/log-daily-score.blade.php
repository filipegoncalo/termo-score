
<x-card>
    <x-h.2>
        Log Daily Score
    </x-h.2>

    @if($status)
        <x-alert.success>
            {{ $status }}
        </x-alert.success>
    @endif

    <x-form wire:submit.prevent="save">

        <x-input.textarea name="data" label="Paste here your game result"/>

        <x-input.text name="word" label="Word of the day"/>
        
        <x-input.text name="word_confirmation" label="Corfirm word of the day"/>

        <x-primary-button class="px-6 py-3">Submit</x-primary-button>
    </x-form>
</x-card>