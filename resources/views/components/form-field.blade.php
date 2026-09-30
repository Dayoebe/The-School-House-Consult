@props(['name', 'label', 'type' => 'text', 'required' => false, 'autocomplete' => null, 'maxlength' => null, 'wide' => false])
<div @class(['min-w-0', 'col-span-2 max-[640px]:col-span-1' => $wide])>
<label class="mb-2 block text-[11px] font-extrabold text-slate-700 max-[640px]:text-[12px]" for="{{ $attributes->get('id', $name) }}">{{ $label }} @if($required)<span class="text-orange" aria-hidden="true">*</span>
@else<span class="text-[10px] font-normal text-muted">(optional)</span>
@endif</label>
@php($controlClass = 'min-w-0 w-full max-w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-[13px] text-slate-900 outline-none transition hover:border-slate-400 focus:border-teal focus:bg-white focus:ring-4 focus:ring-teal/10 max-[640px]:text-base')
@if($type === 'textarea')<textarea class="min-h-[120px] resize-y placeholder:text-slate-400 {{ $controlClass }}" {{ $attributes->except('id') }} id="{{ $attributes->get('id', $name) }}" wire:model="{{ $name }}" name="{{ $name }}" rows="5" @required($required) maxlength="{{ $maxlength ?? 5000 }}" @error($name) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @enderror>
</textarea>
@elseif($type === 'select')<select class="min-h-[50px] {{ $controlClass }}" {{ $attributes->except('id') }} id="{{ $attributes->get('id', $name) }}" wire:model="{{ $name }}" name="{{ $name }}" @required($required) @error($name) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @enderror>{{ $slot }}</select>
@else<input class="min-h-[50px] placeholder:text-slate-400 {{ $controlClass }}" {{ $attributes->except('id') }} id="{{ $attributes->get('id', $name) }}" wire:model="{{ $name }}" name="{{ $name }}" type="{{ $type }}" @required($required) @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif @if($maxlength) maxlength="{{ $maxlength }}" @endif @error($name) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @enderror>
@endif
@error($name)<p id="{{ $attributes->get('id', $name) }}-error" class="mt-1.5 break-words text-[12px] text-[#b42318]">{{ $message }}</p>
@enderror</div>
