@props(['eyebrow' => '', 'title', 'text' => null])<div {{ $attributes->merge(['class' => 'mb-9 max-w-[690px]']) }}>
@if($eyebrow)<p class="mb-5 flex items-center gap-2.5 text-[11px] font-bold uppercase leading-[1.65] tracking-[.17em] text-teal before:h-2 before:w-2 before:rounded-full before:bg-coral">{{ $eyebrow }}</p>
@endif<h2 class="max-w-[640px] font-display text-[clamp(30px,3vw,46px)] font-semibold leading-[1.05] tracking-[-.045em] text-navy">{{ $title }}</h2>
@if($text)<p class="mt-[18px] max-w-[580px] text-[17px] text-muted">{{ $text }}</p>
@endif</div>
