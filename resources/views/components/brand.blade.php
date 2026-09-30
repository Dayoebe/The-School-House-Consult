@props(['footer' => false])
@php($logo = $footer ? (config('site.footer_logo') ?: config('site.logo')) : config('site.logo'))
<a class="inline-flex shrink-0 items-center gap-3 text-navy" href="{{ route('home') }}" aria-label="The School House Consult home">
    @if($logo)
        <img class="h-[54px] w-[54px] object-contain" src="{{ asset($logo) }}" alt="" width="54" height="54" decoding="async">
    @endif
    <span class="font-sans text-[9px] font-extrabold leading-[1.3] tracking-[.14em] {{ $footer ? 'text-white' : 'text-navy' }}">
        THE SCHOOL HOUSE
        <span class="block text-[22px] leading-[1.05] tracking-[.09em]">CONSULT<span class="text-orange">.</span></span>
    </span>
</a>
