@props(['label', 'name'])

		<div class="flex flex-col space-y-1">
            <label for="{{ $name }}" class=" text-base font-semibold text-slate-700">{{ $label }}</label>
            <textarea wire:model="{{ $name }}" name="{{ $name }}" id="{{ $name }}" rows="7"
                class="text-sm rounded border-slate-300 focus:ring-0 focus:border-slate-300">
            </textarea>
            @error($name)<span class="text-sm font-thin text-rose-400">{{ $message }}</span>@enderror
        </div>