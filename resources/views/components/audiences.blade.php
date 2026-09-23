<div class="grid grid-cols-3 gap-6 max-[1190px]:gap-[22px] max-[767px]:grid-cols-1">
@foreach(['Schools & Educational Institutions'=>['building','Support for educational priorities, institutional planning and the development of school teams.'], 'Educators & School Leaders'=>['people','Professional learning, leadership development and reflective support for educational practice.'], 'Communities & Education Stakeholders'=>['heart','Collaborative thinking around engagement, participation and educational development.']] as $title=>[$icon,$copy])<article class="border-t border-[#cbd5e3] py-[30px] pr-[30px] max-[1190px]:pr-0">
<x-icon :name="$icon" class="mb-[22px] h-[29px] w-[29px] text-[#bb560e]" />
<h3 class="mb-[14px] max-w-[290px] text-[22px] font-semibold leading-[1.3] tracking-[-.02em] text-navy">{{ $title }}</h3>
<p class="text-[14px] text-muted">{{ $copy }}</p>
</article>
@endforeach</div>
