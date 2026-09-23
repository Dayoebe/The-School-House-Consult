<x-page-hero eyebrow="Programs & Training" title="Make room for professional growth." text="Professional development across teaching, leadership, curriculum and educational technology." />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
<x-section-heading eyebrow="Learning areas" title="What would you like to develop?" text="These are areas for training conversations. Contact us to discuss your team's needs and available options." />
<div class="my-[30px] grid grid-cols-[1fr_1.05fr] items-center gap-12 max-[767px]:grid-cols-1">
<x-editorial-image name="professional-learning" alt="Conceptual illustration of adults taking part in professional learning." caption="Professional learning, illustrated." />
<div><x-training-categories /></div>
</div>
<div class="my-[65px] h-px bg-line">
</div>
<x-section-heading eyebrow="Programs" title="Explore available programs" />
@if($programs->isEmpty())<x-empty-state title="Program details are coming soon" text="Confirmed programs will be listed here. To discuss teacher development, school leadership or other training needs, request a consultation." />
<a class="mt-6 inline-flex min-h-[50px] items-center justify-center gap-6 rounded border border-orange bg-orange px-[23px] py-[15px] text-[13px] font-bold text-[#14233a]" href="{{ route('contact') }}#consultation">Discuss your training needs ↗</a>
@else<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-2 max-[640px]:grid-cols-1">
@foreach($programs as $program)<x-program-card :program="$program" />
@endforeach</div>
<div class="mt-10">{{ $programs->links() }}</div>
@endif</div>
</section>
<x-cta />
