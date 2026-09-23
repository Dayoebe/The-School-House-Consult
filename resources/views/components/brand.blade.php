@props(['footer' => false])
@php($logo = $footer ? (config('site.footer_logo') ?: config('site.logo')) : config('site.logo'))
<a class="inline-flex shrink-0 items-center gap-2.5 text-navy" href="{{ route('home') }}" aria-label="The School House Consult home">
    @if($logo)
        <img class="h-12 w-12 rounded-lg bg-white object-contain" src="{{ asset($logo) }}" alt="" width="52" height="52" decoding="async">
    @endif
    <span class="text-[10px] font-extrabold leading-[1.3] tracking-[.07em]">
        THE SCHOOL HOUSE
        <span class="block text-[23px] leading-[1.05] tracking-[.055em]">CONSULT<span class="text-orange">.</span></span>
    </span>
</a>
