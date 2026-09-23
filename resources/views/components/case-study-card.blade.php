@props(['caseStudy'])<article class="overflow-hidden rounded border border-line">
@if($caseStudy->featured_image)<img class="aspect-[1.6] w-full object-cover" src="{{ asset($caseStudy->featured_image) }}" alt="" width="640" height="400" loading="lazy">
@endif<div class="p-7">
<p class="mb-3 text-[11px] font-bold uppercase tracking-[.17em] text-orange">Case study</p>
<h3 class="mb-[15px] text-[22px] font-semibold leading-[1.3] tracking-[-.02em] text-navy">{{ $caseStudy->title }}</h3>
<p class="text-[14px] text-muted">{{ $caseStudy->summary }}</p>
<a class="mt-[15px] inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('case-studies.show', $caseStudy) }}">Read case study <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</div>
</article>
