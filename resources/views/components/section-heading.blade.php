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
@if($eyebrow)<p class="mb-5 flex items-center gap-3 text-[10px] font-extrabold uppercase tracking-[.2em] text-teal"><span class="h-px w-8 bg-orange"></span>{{ $eyebrow }}</p>
@endif<h2 class="max-w-[680px] font-display text-[clamp(36px,4vw,58px)] font-medium leading-[1.02] tracking-[-.04em] text-navy">{{ $title }}</h2>
@if($text)<p class="mt-[22px] max-w-[650px] text-[16px] leading-8 text-muted">{{ $text }}</p>
@endif</div>
