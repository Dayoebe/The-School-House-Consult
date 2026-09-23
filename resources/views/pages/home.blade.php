<section x-data="{ loaded: false }" x-init="requestAnimationFrame(() => loaded = true)" class="relative overflow-hidden border-b border-[#e8dfd4] bg-[linear-gradient(135deg,#fffaf2_0%,#f6eee4_58%,#dce9e3_100%)]">
<div class="pointer-events-none absolute inset-0 opacity-40 [background-image:linear-gradient(rgba(15,118,110,.08)_1px,transparent_1px),linear-gradient(90deg,rgba(15,118,110,.08)_1px,transparent_1px)] [background-size:42px_42px]"></div>
<div class="relative mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-[1.08fr_1fr] items-center gap-16 py-[88px] max-[1190px]:w-[calc(100%-64px)] max-[1190px]:gap-8 max-[767px]:grid-cols-1 max-[640px]:w-[calc(100%-40px)] max-[640px]:gap-9 max-[640px]:py-12">
<div class="relative z-[1] py-2.5 max-[640px]:py-0">
<p class="mb-5 flex items-center gap-2.5 text-[10px] font-bold uppercase leading-[1.65] tracking-[.15em] text-orange"><span class="h-0.5 w-7 shrink-0 bg-orange"></span>Education. Collaboration. Excellence.</p>
<h1 :class="loaded ? 'animate__animated animate__fadeInUp' : 'opacity-0'" class="mb-[25px] max-w-[720px] font-display text-[clamp(58px,6.8vw,98px)] font-semibold leading-[.96] tracking-[-.065em] text-navy max-[1190px]:text-[68px] max-[640px]:text-[clamp(48px,13vw,72px)]">Shaping the<br>Future of<br>
<span class="text-teal">Education</span><span class="text-coral max-[640px]:hidden">.</span>
</h1>
<p :class="loaded ? 'animate__animated animate__fadeInUp animate__delay-1s' : 'opacity-0'" class="max-w-[465px] text-[20px] leading-[1.5] text-[#294b56] max-[1190px]:text-[17px] max-[640px]:text-[17px]">Strategic educational solutions for schools, educators and communities.</p>
<p class="mt-[17px] max-w-[445px] text-[14px] leading-[1.75] text-muted">The School House Consult partners with stakeholders to develop practical solutions that promote educational excellence.</p>
<div class="mt-[30px] flex flex-wrap gap-3 max-[640px]:grid max-[640px]:grid-cols-1 max-[640px]:gap-2.5">
<a class="inline-flex min-h-[52px] items-center justify-center gap-6 rounded-full border border-coral bg-coral px-6 py-4 text-[13px] font-bold text-white shadow-[0_12px_25px_rgba(239,111,97,.22)] transition hover:-translate-y-0.5 hover:bg-[#df5e51] max-[640px]:min-h-[51px]" href="{{ route('services.index') }}">Explore Our Services <span class="text-[20px]" aria-hidden="true">↗</span>
</a>
<a class="inline-flex min-h-[52px] items-center justify-center gap-6 rounded-full border border-navy/20 bg-white/70 px-6 py-4 text-[13px] font-bold text-navy shadow-sm backdrop-blur transition hover:-translate-y-0.5 hover:border-navy hover:bg-white max-[640px]:min-h-[47px]" href="{{ route('contact') }}#consultation">Request a Consultation</a>
</div>
<div class="mt-[31px] flex items-center gap-3.5 text-[11px] leading-[1.6] text-[#667085] max-[640px]:hidden">
<span class="grid h-[37px] w-[37px] place-items-center rounded-full border border-[#cbd4e1] text-[20px] text-navy" aria-hidden="true">↗</span><span>Rooted in collaboration.<br>
<strong class="font-semibold text-navy">Focused on education.</strong>
</span>
</div>
</div>
<div :class="loaded ? 'animate__animated animate__fadeInRight animate__delay-1s' : 'opacity-0'" class="relative px-0 pb-7 max-[767px]:mx-auto max-[767px]:w-full max-[767px]:max-w-[430px] max-[640px]:pb-3.5">
<x-editorial-image name="education-collaboration" alt="Conceptual illustration of education professionals planning together around an open book." caption="A shared purpose. A thoughtful approach." priority />
<div class="absolute bottom-0 left-[-20px] flex items-center gap-3.5 rounded-2xl border border-white/70 border-l-4 border-l-coral bg-white/90 px-[22px] py-[18px] text-[11px] leading-[1.6] text-navy shadow-[0_18px_40px_rgba(11,42,91,.14)] backdrop-blur max-[640px]:hidden"><x-icon name="book" class="text-teal" /><span>Better education begins<br>with purposeful partnership.</span></div>

</div>
</div>
</section>
<div class="border-y border-line"><div class="mx-auto flex min-h-[82px] w-[calc(100%-96px)] max-w-[1240px] items-center justify-between gap-5 text-[13px] text-[#b3bcc9] max-[1190px]:w-[calc(100%-64px)] max-[767px]:flex-wrap max-[767px]:justify-center max-[640px]:w-[calc(100%-40px)] max-[640px]:justify-start max-[640px]:gap-2"><span class="text-[10px] uppercase tracking-[.1em] text-muted max-[767px]:w-full max-[767px]:text-center max-[640px]:text-left">Working together with</span>
<strong>Schools & Institutions</strong>
<span aria-hidden="true">/</span>
<strong>Educators & Leaders</strong>
<span aria-hidden="true">/</span>
<strong>Communities & Stakeholders</strong>
</div>
</div>
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-2 gap-[100px] max-[1190px]:w-[calc(100%-64px)] max-[1190px]:gap-10 max-[767px]:grid-cols-1 max-[640px]:w-[calc(100%-40px)]">
<x-section-heading eyebrow="Welcome to The School House Consult" title="Partnering for Educational Excellence" />
<div>
<p class="text-[23px] leading-[1.5] text-navy">Education moves forward when we work together.</p>
<p class="mt-[18px] text-muted">We are an education consulting company working with schools, educators and communities to explore challenges, shape ideas and plan practical next steps.</p>
<blockquote class="my-6 border-l-[3px] border-orange pl-[21px] text-[17px] text-navy">{{ config('site.mission') }}</blockquote>
<a class="inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('about') }}">Discover our approach <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</div>
</div>
</section>
<section class="bg-soft py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
<x-section-heading eyebrow="Who we serve" title="Different perspectives. Shared purpose." />
<x-audiences />
</div>
</section>
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]"><div class="mb-9 flex items-center justify-between gap-9 max-[640px]:block">
<x-section-heading eyebrow="How we can help" title="Our Areas of Expertise" text="Practical support across the people, systems and experiences that shape education." />
<a class="inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange max-[640px]:mt-4" href="{{ route('services.index') }}">View all services <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</div>
<p class="mb-[15px] hidden items-center justify-between text-[11px] text-muted max-[640px]:flex">Swipe to explore our expertise <span aria-hidden="true">→</span></p>
<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-2 max-[640px]:grid-flow-col max-[640px]:grid-cols-none max-[640px]:auto-cols-[86%] max-[640px]:gap-3.5 max-[640px]:overflow-x-auto max-[640px]:snap-x max-[640px]:snap-proximity" tabindex="0" role="region" aria-label="Our education consulting services">
@foreach($services as $service)<x-service-card :service="$service" />
@endforeach</div>
</div>
</section>
<section class="bg-navy py-[92px] max-[640px]:py-12"><div class="mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-2 gap-[100px] max-[1190px]:w-[calc(100%-64px)] max-[1190px]:gap-10 max-[767px]:grid-cols-1 max-[640px]:w-[calc(100%-40px)]">
<div>
<p class="mb-5 text-[11px] font-bold uppercase tracking-[.17em] text-[#ffad70]">Why partner with us</p>
<h2 class="text-[clamp(30px,3vw,43px)] font-semibold leading-[1.15] tracking-[-.035em] text-white">Thoughtful strategy.<br>Practical next steps.</h2>
<p class="my-6 mb-[30px] max-w-[400px] text-[#c5d0e0]">Every educational setting has its own context. Our approach starts with understanding yours.</p>
<a class="inline-flex min-h-[50px] items-center justify-center gap-6 rounded border border-white bg-white px-[23px] py-[15px] text-[13px] font-bold text-navy hover:bg-[#edf1f7]" href="{{ route('about') }}">Our approach <span aria-hidden="true">↗</span>
</a>
</div>
<div>
@foreach(['Strategic collaboration'=>'Start with a shared understanding of priorities and work towards a considered plan.', 'Stakeholder engagement'=>'Bring the perspectives of educators, leaders and communities into the conversation.', 'Professional development'=>'Make space for learning, reflection and the development of professional practice.', 'Practical educational solutions'=>'Connect ideas to the needs and day-to-day realities of educational settings.'] as $heading=>$copy)<div class="flex gap-6 border-t border-[#36517a] py-6 first:border-0 first:pt-0">
<span class="mt-1 text-[12px] text-[#ffad70]">0{{ $loop->iteration }}</span>
<div>
<h3 class="mb-2 text-[20px] font-semibold text-white">{{ $heading }}</h3>
<p class="text-[14px] text-[#c5d0e0]">{{ $copy }}</p>
</div>
</div>
@endforeach</div>
</div>
</section>
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
@if($member = $team->first())<x-team-card :member="$member" />
<div class="mx-auto mt-5 max-w-[1030px] text-right"><a class="inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('team') }}">View Our Team <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</div>
@endif</div>
</section>
<section class="bg-soft py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]"><div class="mb-9 flex items-center justify-between gap-9 max-[640px]:block">
<x-section-heading eyebrow="Programs & Training" title="Learning that supports better practice." text="Explore professional development across teaching, leadership and school improvement." />
<a class="inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange max-[640px]:mt-4" href="{{ route('programs.index') }}">Explore training <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</div>
<div class="my-[30px] grid grid-cols-[1fr_1.05fr] items-center gap-12 max-[767px]:grid-cols-1">
<x-editorial-image name="professional-learning" alt="Conceptual illustration of an educator leading a professional learning discussion." caption="Room to learn. Space to grow." />
<div><x-training-categories /><a class="mt-3.5 inline-flex items-center gap-3 py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('contact') }}#consultation">Discuss your team's learning needs ↗</a></div>
</div>
@if($programs->isNotEmpty())<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-2 max-[640px]:grid-cols-1">
@foreach($programs as $program)<x-program-card :program="$program" />
@endforeach</div>
@else<p class="text-[14px] text-muted">Program details will be published as they become available. <a class="text-navy underline underline-offset-4 hover:text-orange" href="{{ route('contact') }}#consultation">Discuss your training needs.</a>
</p>
@endif</div>
</section>
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]"><div class="mb-9 flex items-center justify-between gap-9 max-[640px]:block">
<x-section-heading eyebrow="Resources & Insights" title="A space for ideas in education." />
<a class="inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange max-[640px]:mt-4" href="{{ route('resources.index') }}">All resources <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</div>
@if($articles->isNotEmpty())<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-2 max-[640px]:grid-cols-1">
@foreach($articles as $article)<x-article-card :article="$article" />
@endforeach</div>
@else<x-empty-state title="Fresh perspectives are on the way" text="Articles and resources will appear here when they are published. In the meantime, explore our areas of expertise." />
@endif</div>
</section>
<section class="bg-soft py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]"><div class="mb-9 flex items-center justify-between gap-9 max-[640px]:block">
<x-section-heading eyebrow="Case studies" title="From collaboration to practice." />
<a class="inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange max-[640px]:mt-4" href="{{ route('case-studies.index') }}">View case studies <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</div>
@if($caseStudies->isNotEmpty())<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-2 max-[640px]:grid-cols-1">
@foreach($caseStudies as $caseStudy)<x-case-study-card :case-study="$caseStudy" />
@endforeach</div>
@else<x-empty-state title="Project stories, shared thoughtfully" text="Case studies will be published as our projects and impact stories become available." />
@endif</div>
</section>
<x-newsletter />
<x-cta />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
<x-section-heading eyebrow="Get in touch" title="Let's start a conversation." />
<x-contact-details />
</div>
</section>
