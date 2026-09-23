@props(['eyebrow' => '', 'title', 'text' => null])<div {{ $attributes->merge(['class' => 'mb-9 max-w-[690px]']) }}>
@if($eyebrow)<p class="mb-5 flex items-center gap-2.5 text-[11px] font-bold uppercase leading-[1.65] tracking-[.17em] text-orange">{{ $eyebrow }}</p>
@endif<h2 class="max-w-[640px] text-[clamp(30px,3vw,43px)] font-semibold leading-[1.15] tracking-[-.035em] text-navy">{{ $title }}</h2>
@if($text)<p class="mt-[18px] max-w-[580px] text-[17px] text-muted">{{ $text }}</p>
@endif</div>
