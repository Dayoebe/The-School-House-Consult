<div class="grid grid-cols-3 gap-6 max-[1190px]:gap-[22px] max-[767px]:grid-cols-1">
@foreach(['Schools & Educational Institutions'=>['building','Support for educational priorities, institutional planning and the development of school teams.'], 'Educators & School Leaders'=>['people','Professional learning, leadership development and reflective support for educational practice.'], 'Communities & Education Stakeholders'=>['heart','Collaborative thinking around engagement, participation and educational development.']] as $title=>[$icon,$copy])<article class="rounded-[24px] border border-[#e7ded1] bg-white/60 p-7 shadow-[0_10px_30px_rgba(11,42,91,.04)] transition hover:-translate-y-1 hover:bg-white max-[1190px]:p-6">
<x-icon :name="$icon" class="mb-[22px] h-[29px] w-[29px] text-coral" />
<h3 class="mb-[14px] max-w-[290px] font-display text-[22px] font-semibold leading-[1.1] tracking-[-.02em] text-navy">{{ $title }}</h3>
<p class="text-[14px] text-muted">{{ $copy }}</p>
</article>
@endforeach</div>
