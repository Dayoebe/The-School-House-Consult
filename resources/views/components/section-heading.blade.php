@props(['eyebrow' => '', 'title', 'text' => null])
@php
	$eyebrowIcon = match (true) {
		str_contains(strtolower($eyebrow), 'who') => 'fa-people-group',
		str_contains(strtolower($eyebrow), 'expertise'), str_contains(strtolower($eyebrow), 'help') => 'fa-compass-drafting',
		str_contains(strtolower($eyebrow), 'program'), str_contains(strtolower($eyebrow), 'learning') => 'fa-graduation-cap',
		str_contains(strtolower($eyebrow), 'resource'), str_contains(strtolower($eyebrow), 'insight') => 'fa-lightbulb',
		str_contains(strtolower($eyebrow), 'case') => 'fa-chart-line',
		str_contains(strtolower($eyebrow), 'contact'), str_contains(strtolower($eyebrow), 'touch') => 'fa-comments',
		default => 'fa-sparkles',
	};
@endphp
<div {{ $attributes->merge(['class' => 'mb-9 max-w-[690px]']) }}>
@if($eyebrow)<p class="mb-5 flex items-center gap-2.5 text-[11px] font-bold uppercase leading-[1.65] tracking-[.17em] text-teal"><i class="fa-solid {{ $eyebrowIcon }} text-[13px] text-coral" aria-hidden="true"></i>{{ $eyebrow }}</p>
@endif<h2 class="max-w-[640px] font-display text-[clamp(30px,3vw,46px)] font-semibold leading-[1.05] tracking-[-.045em] text-navy">{{ $title }}</h2>
@if($text)<p class="mt-[18px] max-w-[580px] text-[17px] text-muted">{{ $text }}</p>
@endif</div>
