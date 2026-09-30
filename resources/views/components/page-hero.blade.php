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
<section class="public-hero relative overflow-hidden border-b border-slate-200 bg-slate-50 py-20 text-slate-950 max-[640px]:py-14">
<div class="pointer-events-none absolute -left-20 -top-20 h-60 w-60 rounded-full bg-orange/15 blur-3xl"></div><div class="pointer-events-none absolute bottom-0 right-0 h-72 w-72 rounded-full bg-teal/15 blur-3xl"></div>
<div class="relative mx-auto w-[calc(100%-48px)] max-w-7xl max-[640px]:w-[calc(100%-32px)]">
<p class="inline-flex items-center gap-2 rounded-full border border-orange/30 bg-orange/10 px-3 py-1.5 text-[10px] font-extrabold uppercase tracking-[.15em] text-[#ffc89f]"><i class="fa-solid {{ $heroIcon }}" aria-hidden="true"></i>{{ $eyebrow }}</p>
<h1 class="mt-5 max-w-[980px] text-[clamp(40px,5.5vw,70px)] font-extrabold leading-[1.02] tracking-[-.05em] text-white">{{ $title }}</h1>
<p class="mt-6 max-w-[760px] text-[17px] leading-8 text-slate-300 max-[640px]:text-[15px]">{{ $text }}</p>
</div>
</section>
