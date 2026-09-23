@props(['program'])<article class="overflow-hidden rounded border border-line">
@if($program->featured_image)<img class="aspect-[1.6] w-full object-cover" src="{{ asset($program->featured_image) }}" alt="" width="640" height="400" loading="lazy">
@endif<div class="p-7">
<p class="mb-3 text-[11px] font-bold uppercase tracking-[.17em] text-orange">Programs & Training</p>
<h3 class="mb-[15px] text-[22px] font-semibold leading-[1.3] tracking-[-.02em] text-navy">{{ $program->title }}</h3>
<p class="text-[14px] text-muted">{{ Str::limit($program->description, 180) }}</p>
@if($program->target_audience)<p class="mt-[18px] text-[14px] text-muted">{{ $program->target_audience }}</p>
@endif @if($program->duration)<p class="mt-[18px] text-[14px] text-muted">Duration: {{ $program->duration }}</p>
@endif<a class="mt-[15px] inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('programs.show', $program) }}">Explore program <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</div>
</article>
