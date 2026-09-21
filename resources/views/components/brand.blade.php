@props(['footer' => false])
@php($logo = $footer ? (config('site.footer_logo') ?: config('site.logo')) : config('site.logo'))
<a class="brand" href="{{ route('home') }}" aria-label="The School House Consult home">
    @if($logo)
        <img class="brand-symbol" src="{{ asset($logo) }}" alt="" width="52" height="52" decoding="async">
    @endif
    <span class="brand-name">
        THE SCHOOL HOUSE
        <span>CONSULT<span class="brand-dot">.</span></span>
    </span>
</a>
