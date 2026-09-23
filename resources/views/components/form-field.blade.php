@props(['name', 'label', 'type' => 'text', 'required' => false, 'autocomplete' => null, 'maxlength' => null, 'wide' => false])
<div @class(['min-w-0', 'col-span-2' => $wide])>
<label class="mb-2 block text-[12px] font-semibold text-navy max-[640px]:text-[13px]" for="{{ $attributes->get('id', $name) }}">{{ $label }} @if($required)<span class="text-[#a44706]" aria-hidden="true">*</span>
@else<span class="text-[10px] font-normal text-muted">(optional)</span>
@endif</label>
@if($type === 'textarea')<textarea {{ $attributes->except('id') }} id="{{ $attributes->get('id', $name) }}" wire:model="{{ $name }}" name="{{ $name }}" rows="5" @required($required) maxlength="{{ $maxlength ?? 5000 }}" @error($name) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @enderror>
</textarea>
@elseif($type === 'select')<select {{ $attributes->except('id') }} id="{{ $attributes->get('id', $name) }}" wire:model="{{ $name }}" name="{{ $name }}" @required($required) @error($name) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @enderror>{{ $slot }}</select>
@else<input {{ $attributes->except('id') }} id="{{ $attributes->get('id', $name) }}" wire:model="{{ $name }}" name="{{ $name }}" type="{{ $type }}" @required($required) @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif @if($maxlength) maxlength="{{ $maxlength }}" @endif @error($name) aria-invalid="true" aria-describedby="{{ $attributes->get('id', $name) }}-error" @enderror>
@endif
@error($name)<p id="{{ $attributes->get('id', $name) }}-error" class="mt-1.5 text-[12px] text-[#b42318]">{{ $message }}</p>
@enderror</div>
