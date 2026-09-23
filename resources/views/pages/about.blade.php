<x-page-hero eyebrow="About us" title="A shared commitment to education." text="The School House Consult brings stakeholders together around educational challenges, opportunities and development needs." />
<section class="py-[92px] max-[640px]:py-12">
<div class="mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-2 gap-[100px] max-[1190px]:w-[calc(100%-64px)] max-[1190px]:gap-10 max-[767px]:grid-cols-1 max-[640px]:w-[calc(100%-40px)]">
<x-section-heading eyebrow="Who we are" title="Partnership at the heart of progress." />
<div>
<p class="text-[23px] leading-[1.5] text-navy">We are an education consulting company based in Akure, Ondo State, Nigeria.</p>
<p class="mt-[18px] text-muted">Our work spans educational research, curriculum development, professional learning, leadership, school improvement and stakeholder engagement.</p>
<p class="mt-[18px] text-muted">We work with schools, educators and communities to develop practical solutions that promote educational excellence.</p>
</div>
</div>
</section>
<div class="mx-auto mb-[75px] w-[calc(100%-96px)] max-w-[920px] max-[640px]:mb-[50px] max-[640px]:w-[calc(100%-40px)]"><x-editorial-image name="education-collaboration" alt="Conceptual illustration of collaborative education planning." caption="Education moves forward through shared thinking." /></div>
<section class="bg-soft py-[92px] max-[640px]:py-12">
<div class="mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-2 gap-7 max-[640px]:w-[calc(100%-40px)] max-[767px]:grid-cols-1">
<article class="border border-line border-t-[3px] border-t-orange bg-white p-10"><p class="mb-5 flex items-center gap-2.5 text-[11px] font-bold uppercase tracking-[.17em] text-orange">Our mission</p>
<h2 class="text-[30px] font-semibold leading-[1.15] tracking-[-.035em] text-navy">{{ config('site.mission') }}</h2>
</article>
<article class="border border-line border-t-[3px] border-t-orange bg-white p-10"><p class="mb-5 flex items-center gap-2.5 text-[11px] font-bold uppercase tracking-[.17em] text-orange">Our vision</p>
@if(config('site.vision'))
    <h2 class="text-[30px] font-semibold leading-[1.15] tracking-[-.035em] text-navy">{{ config('site.vision') }}</h2>
@else
    <h2 class="text-[30px] font-semibold leading-[1.15] tracking-[-.035em] text-navy">Vision statement</h2>
    <p class="mt-[18px] text-muted">Our official vision statement will be shared here once confirmed.</p>
@endif
</article>
</div>
</section>
<section class="py-[92px] max-[640px]:py-12">
<div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
<x-section-heading eyebrow="Our approach" title="Understand. Collaborate. Develop." />
<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-1">
@foreach(['Understand the context'=>'Listen to the needs, priorities and perspectives of those involved.', 'Work together'=>'Bring stakeholders into purposeful conversations and planning.', 'Plan practical steps'=>'Connect educational priorities to considered actions and professional learning.'] as $heading=>$copy)<article class="border-t border-line pr-6 pt-7"><span class="mb-5 block text-[11px] font-bold uppercase tracking-[.17em] text-orange">0{{ $loop->iteration }}</span>
<h3 class="mb-4 text-[22px] font-semibold text-navy">{{ $heading }}</h3>
<p class="text-[14px] text-muted">{{ $copy }}</p>
</article>
@endforeach</div>
</div>
</section>
<section class="bg-soft py-[92px] max-[640px]:py-12">
<div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
<x-section-heading eyebrow="Who we serve" title="Education is a shared endeavour." />
<x-audiences />
</div>
</section>
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]"><div class="mb-9 flex items-center justify-between gap-9 max-[640px]:block">
<x-section-heading eyebrow="Areas of expertise" title="Support across the educational landscape." />
<a class="inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange max-[640px]:mt-4" href="{{ route('services.index') }}">Explore all 13 services ↗</a>
</div>
<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-1">
@foreach($services->take(3) as $service)<x-service-card :service="$service" />
@endforeach</div>
</div>
</section>
<section class="bg-soft py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
@if($member = $team->first())<x-team-card :member="$member" />
@endif</div>
</section>
<x-cta />
