<x-page-hero eyebrow="Case studies" title="Education in practice." text="A space for project stories, shared learning and reflections on educational development." />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
@if($caseStudies->isEmpty())<x-empty-state title="Our project stories will live here" text="Case studies will be published as our projects and impact stories become available." />
@else<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-2 max-[640px]:grid-cols-1">
@foreach($caseStudies as $caseStudy)<x-case-study-card :case-study="$caseStudy" />
@endforeach</div>
<div class="mt-10">{{ $caseStudies->links() }}</div>
@endif</div>
</section>
<x-cta />
