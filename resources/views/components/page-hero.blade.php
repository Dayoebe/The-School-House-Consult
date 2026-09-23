@props(['eyebrow', 'title', 'text'])
@php
	$heroIcon = match (true) {
		str_contains(strtolower($eyebrow), 'about') => 'fa-compass',
		str_contains(strtolower($eyebrow), 'service'), str_contains(strtolower($eyebrow), 'expertise') => 'fa-compass-drafting',
		str_contains(strtolower($eyebrow), 'program'), str_contains(strtolower($eyebrow), 'training') => 'fa-graduation-cap',
		str_contains(strtolower($eyebrow), 'resource') => 'fa-lightbulb',
		str_contains(strtolower($eyebrow), 'case') => 'fa-chart-line',
		str_contains(strtolower($eyebrow), 'team') => 'fa-people-group',
		str_contains(strtolower($eyebrow), 'question') => 'fa-circle-question',
		str_contains(strtolower($eyebrow), 'contact') => 'fa-comments',
		default => 'fa-sparkles',
	};
@endphp
<section class="relative overflow-hidden border-b border-[#e8dfd4] bg-[linear-gradient(120deg,#f6eee4_0%,#fffaf2_52%,#dce9e3_100%)] py-[88px] max-[640px]:py-12">
<div class="pointer-events-none absolute inset-0 opacity-35 [background-image:linear-gradient(rgba(15,118,110,.08)_1px,transparent_1px),linear-gradient(90deg,rgba(15,118,110,.08)_1px,transparent_1px)] [background-size:42px_42px]"></div>
<div class="relative mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[1190px]:w-[calc(100%-64px)] max-[640px]:w-[calc(100%-40px)]">
<p class="mb-5 flex items-center gap-2.5 text-[11px] font-bold uppercase leading-[1.65] tracking-[.17em] text-teal"><i class="fa-solid {{ $heroIcon }} text-[15px] text-coral" aria-hidden="true"></i>{{ $eyebrow }}</p>
<h1 class="max-w-[890px] font-display text-[clamp(40px,5.4vw,76px)] font-semibold leading-[.98] tracking-[-.06em] text-navy max-[640px]:text-[42px]">{{ $title }}</h1>
<p class="mt-[25px] max-w-[715px] text-[18px] text-muted max-[640px]:text-[15px]">{{ $text }}</p>
</div>
</section>
