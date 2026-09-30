@php
    $serviceGroups = collect(config('site.service_groups'))->map(fn (array $group, string $category): array => [
        'introduction' => $group['introduction'],
        'services' => $services->where('category', $category)->sortBy('sort_order')->values(),
    ]);
@endphp
<section class="public-hero relative overflow-hidden bg-slate-50 text-slate-950">
<div class="pointer-events-none absolute -left-24 -top-24 h-72 w-72 rounded-full bg-orange/15 blur-3xl"></div><div class="pointer-events-none absolute bottom-0 right-0 h-96 w-96 rounded-full bg-teal/15 blur-3xl"></div>
<div class="relative mx-auto grid min-h-[570px] w-[calc(100%-48px)] max-w-7xl grid-cols-[1.08fr_.92fr] items-center gap-14 py-16 max-[850px]:grid-cols-1 max-[640px]:w-[calc(100%-32px)] max-[640px]:py-12">
<div><p class="inline-flex items-center gap-2 rounded-full border border-orange/30 bg-orange/10 px-4 py-2 text-[10px] font-extrabold uppercase tracking-[.15em] text-[#ffc89f]"><i class="fa-solid fa-compass-drafting" aria-hidden="true"></i> Our expertise</p><h1 class="mt-7 max-w-[770px] text-[clamp(42px,6vw,72px)] font-extrabold leading-[1.02] tracking-[-.055em]">Connected expertise for stronger educational institutions.</h1><p class="mt-6 max-w-[700px] text-[17px] leading-8 text-slate-300">{{ $services->count() }} {{ Str::plural('area', $services->count()) }} of support organised around the four dimensions that shape institutional performance: strategy, academic practice, people and community.</p><div class="mt-8 flex flex-wrap gap-3"><a class="rounded-xl bg-orange px-5 py-3 text-[12px] font-extrabold text-slate-950" href="#service-pillars">Explore all services</a><a class="rounded-xl border border-white/20 bg-white/5 px-5 py-3 text-[12px] font-bold text-white" href="{{ route('contact') }}#consultation">Discuss your priorities</a></div></div>
<div class="grid grid-cols-2 gap-3 max-[480px]:grid-cols-1">
@foreach($serviceGroups as $title => $group)
@php
    $pillarMeta = match($loop->iteration) {
        1 => ['document', 'border-blue-300/20 bg-blue-500/10 text-blue-100'],
        2 => ['story', 'border-cyan-300/20 bg-cyan-500/10 text-cyan-100'],
        3 => ['leadership', 'border-orange/20 bg-orange/10 text-orange-100'],
        default => ['people', 'border-emerald-300/20 bg-emerald-500/10 text-emerald-100'],
    };
@endphp
<a class="rounded-2xl border p-5 transition hover:-translate-y-1 {{ $pillarMeta[1] }}" href="#pillar-{{ $loop->iteration }}"><span class="grid h-10 w-10 place-items-center rounded-xl bg-white/10"><x-icon :name="$pillarMeta[0]" class="h-5 w-5" /></span><h2 class="mt-4 text-[14px] font-extrabold text-white">{{ $title }}</h2><p class="mt-1 text-[11px] opacity-70">{{ $group['services']->count() }} {{ Str::plural('service', $group['services']->count()) }}</p></a>@endforeach
</div></div></section>

<nav class="sticky top-[76px] z-20 border-b border-slate-200 bg-white/95 py-3 backdrop-blur" aria-label="Service pillars"><div class="mx-auto flex w-[calc(100%-48px)] max-w-7xl gap-2 overflow-x-auto max-[640px]:w-[calc(100%-32px)]">@foreach(array_keys(config('site.service_groups')) as $category)<a class="whitespace-nowrap rounded-full bg-slate-100 px-4 py-2 text-[11px] font-bold text-slate-700 hover:bg-orange hover:text-slate-950" href="#pillar-{{ $loop->iteration }}">{{ $category }}</a>@endforeach</div></nav>

<section id="service-pillars" class="bg-white py-16 max-[640px]:py-12"><div class="mx-auto w-[calc(100%-48px)] max-w-7xl max-[640px]:w-[calc(100%-32px)]">
<div class="grid grid-cols-[.7fr_1.3fr] gap-14 max-[850px]:grid-cols-1"><div><p class="text-[10px] font-extrabold uppercase tracking-widest text-orange">How our services connect</p><h2 class="mt-3 text-[clamp(30px,4vw,48px)] font-extrabold leading-tight tracking-[-.045em] text-slate-950">Improvement rarely belongs to one department.</h2></div><div><p class="text-[19px] font-semibold leading-9 text-slate-900">The strongest educational institutions align their direction, learning systems, people and stakeholder relationships.</p><p class="mt-4 text-[15px] leading-8 text-slate-600">Our service pillars are designed to work independently when a need is focused and collectively when the challenge crosses several parts of an institution. Begin with the area that best reflects your immediate priority; the wider context can be explored during consultation.</p></div></div>
</div></section>

@foreach($serviceGroups as $category => $group)
@php
    $palette = match($loop->iteration) {
        1 => ['bg-slate-50', 'bg-blue-100 text-blue-700', 'border-blue-200 hover:border-blue-400', 'text-blue-700'],
        2 => ['bg-white', 'bg-cyan-100 text-cyan-700', 'border-cyan-200 hover:border-cyan-400', 'text-cyan-700'],
        3 => ['bg-[#fff8f1]', 'bg-orange-100 text-orange-700', 'border-orange-200 hover:border-orange-400', 'text-orange-700'],
        default => ['bg-emerald-50', 'bg-emerald-100 text-emerald-700', 'border-emerald-200 hover:border-emerald-400', 'text-emerald-700'],
    };
    $categoryIcon = match($loop->iteration) { 1 => 'document', 2 => 'story', 3 => 'leadership', default => 'people' };
@endphp
<section id="pillar-{{ $loop->iteration }}" class="{{ $palette[0] }} scroll-mt-32 py-16 max-[640px]:py-12"><div class="mx-auto grid w-[calc(100%-48px)] max-w-7xl grid-cols-[.62fr_1.38fr] gap-14 max-[900px]:grid-cols-1 max-[640px]:w-[calc(100%-32px)]">
<div><span class="grid h-12 w-12 place-items-center rounded-xl {{ $palette[1] }}"><x-icon :name="$categoryIcon" /></span><p class="mt-6 text-[10px] font-extrabold uppercase tracking-widest {{ $palette[3] }}">Pillar {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</p><h2 class="mt-3 text-[clamp(30px,4vw,48px)] font-extrabold leading-tight tracking-[-.045em] text-slate-950">{{ $category }}</h2><p class="mt-4 max-w-md text-[14px] leading-7 text-slate-600">{{ $group['introduction'] }}</p><a class="mt-6 inline-flex items-center gap-2 text-[12px] font-extrabold text-slate-900" href="{{ route('contact') }}#consultation">Discuss this pillar →</a></div>
<div class="grid grid-cols-2 gap-4 max-[650px]:grid-cols-1">
@forelse($group['services'] as $service)
<article class="group flex min-h-full flex-col rounded-2xl border bg-white p-6 transition hover:-translate-y-1 hover:shadow-[0_16px_38px_rgba(15,23,42,.08)] {{ $palette[2] }}"><div class="flex items-center justify-between gap-4"><span class="grid h-11 w-11 place-items-center rounded-xl {{ $palette[1] }}"><x-icon :name="$service->icon ?: $categoryIcon" class="h-5 w-5" /></span><span class="text-[10px] font-extrabold {{ $palette[3] }}">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div><h3 class="mt-5 text-[19px] font-extrabold leading-snug text-slate-950">{{ $service->title }}</h3><p class="mt-3 text-[13px] leading-6 text-slate-600">{{ $service->description }}</p><a class="mt-auto pt-5 text-[12px] font-extrabold {{ $palette[3] }}" href="{{ route('services.show', $service) }}">View service details →</a></article>
@empty
<div class="col-span-2 rounded-2xl border border-dashed border-slate-300 bg-white/60 p-7 text-[13px] text-slate-500 max-[650px]:col-span-1">No services are currently published in this pillar.</div>
@endforelse
</div></div></section>
@endforeach

<section class="bg-white py-16 max-[640px]:py-12"><div class="mx-auto grid w-[calc(100%-48px)] max-w-7xl grid-cols-[1.18fr_.82fr] gap-5 max-[800px]:grid-cols-1 max-[640px]:w-[calc(100%-32px)]"><div class="rounded-3xl bg-navy p-8 text-white sm:p-10"><p class="text-[10px] font-extrabold uppercase tracking-widest text-[#ffb47d]">Not sure where to begin?</p><h2 class="mt-4 text-[clamp(30px,4vw,46px)] font-extrabold leading-tight tracking-[-.045em]">Start with the institutional priority—not the service name.</h2><p class="mt-4 max-w-2xl text-[14px] leading-7 text-slate-300">Tell us what is changing, what is not working as intended or what your institution is preparing to achieve. We can help identify the most appropriate area of support.</p><a class="mt-7 inline-flex rounded-xl bg-orange px-5 py-3 text-[12px] font-extrabold text-slate-950" href="{{ route('contact') }}#consultation">Request strategic guidance</a></div><div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-8"><span class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-100 text-emerald-700"><i class="fa-brands fa-whatsapp text-xl" aria-hidden="true"></i></span><h2 class="mt-5 text-[23px] font-extrabold text-slate-950">Prefer a direct conversation?</h2><p class="mt-3 text-[13px] leading-6 text-slate-600">Reach The School House Consult on WhatsApp to discuss your initial enquiry.</p><a class="mt-6 inline-flex text-[12px] font-extrabold text-emerald-800" href="{{ config('site.whatsapp') }}">Continue on WhatsApp →</a></div></div></section>
