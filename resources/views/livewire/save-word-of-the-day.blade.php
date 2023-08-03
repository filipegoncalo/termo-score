<x-card>
    <x-h.2>Save Word Of The Day</x-h.2>

    @if($status)
        <x-alert.success>
            {{ $status }}
        </x-alert.success>
    @endif

    <x-form wire:submit.prevent="save">

        <x-input.text name="word" label="Word of the day"/>
        
        <x-input.text name="word_confirmation" label="Corfirm word of the day"/>
        
        <x-input.text name="game_id" label="Game Id"/>

        <x-primary-button class="px-6 py-3">Submit</x-primary-button>
    </x-form>

</x-card>