@props(['name', 'label', 'type' => 'text', 'required' => false, 'autocomplete' => null, 'maxlength' => null, 'wide' => false])
<div @class(['min-w-0', 'col-span-2' => $wide])>
<label class="mb-2 block text-[12px] font-semibold text-navy max-[640px]:text-[13px]" for="{{ $attributes->get('id', $name) }}">{{ $label }} @if($required)<span class="text-[#a44706]" aria-hidden="true">*</span>
@else<span class="text-[10px] font-normal text-muted">(optional)</span>
@endif</label>
@if($type === 'textarea')<textarea class="min-h-[47px] w-full max-w-full resize-y rounded border border-[#b9c3d1] bg-white px-3 py-3 text-[14px] text-ink max-[640px]:min-h-[51px] max-[640px]:rounded-lg max-[640px]:p-[13px]" {{ $attributes->except('id') }} id="{{ $attributes->get('id', $name) }}" wire:model="{{ $name }}" name="{{ $name }}" rows="5" @required($required) maxlength="{{ $maxlength ?? 5000 }}" @error($name) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @enderror>
</textarea>
@elseif($type === 'select')<select class="min-h-[47px] w-full max-w-full rounded border border-[#b9c3d1] bg-white px-3 py-3 text-[14px] text-ink max-[640px]:min-h-[51px] max-[640px]:rounded-lg max-[640px]:p-[13px]" {{ $attributes->except('id') }} id="{{ $attributes->get('id', $name) }}" wire:model="{{ $name }}" name="{{ $name }}" @required($required) @error($name) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @enderror>{{ $slot }}</select>
@else<input class="min-h-[47px] w-full max-w-full rounded border border-[#b9c3d1] bg-white px-3 py-3 text-[14px] text-ink max-[640px]:min-h-[51px] max-[640px]:rounded-lg max-[640px]:p-[13px]" {{ $attributes->except('id') }} id="{{ $attributes->get('id', $name) }}" wire:model="{{ $name }}" name="{{ $name }}" type="{{ $type }}" @required($required) @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif @if($maxlength) maxlength="{{ $maxlength }}" @endif @error($name) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @enderror>
@endif
@error($name)<p id="{{ $attributes->get('id', $name) }}-error" class="mt-1.5 text-[12px] text-[#b42318]">{{ $message }}</p>
@enderror</div>
