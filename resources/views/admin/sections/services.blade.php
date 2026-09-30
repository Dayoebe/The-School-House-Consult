@php
    $serviceIcons = [
        'book' => 'Book / learning', 'building' => 'Building / facilities', 'chat' => 'Conversation / coaching',
        'compass' => 'Compass / direction', 'document' => 'Document / policy', 'growth' => 'Growth / development',
        'heart' => 'Heart / support', 'leadership' => 'Leadership', 'people' => 'People / community',
        'research' => 'Research', 'story' => 'Curriculum / story', 'technology' => 'Technology',
    ];
@endphp

<div class="space-y-7">
    <section class="relative overflow-hidden rounded-[28px] bg-slate-950 p-7 text-white sm:p-9">
        <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full border-[42px] border-white/[.04]"></div>
        <div class="relative flex flex-col justify-between gap-7 lg:flex-row lg:items-end">
            <div><span class="inline-flex rounded-full border border-orange/25 bg-orange/10 px-3 py-1 text-[9px] font-extrabold uppercase tracking-widest text-[#ffbd8d]">Public expertise manager</span><h2 class="mt-5 max-w-3xl text-[clamp(32px,5vw,52px)] font-extrabold leading-[1.03] tracking-[-.05em]">Manage every service visitors can explore.</h2><p class="mt-4 max-w-2xl text-[13px] leading-7 text-slate-400">Create, edit, organise or hide services here. Published changes feed the public Expertise overview, service detail pages, homepage previews and consultation form.</p></div>
            <div class="flex flex-wrap gap-3"><button class="rounded-xl bg-orange px-5 py-3 text-[11px] font-extrabold text-slate-950" type="button" onclick="document.getElementById('new-service').showModal()"><i class="fa-solid fa-plus mr-2" aria-hidden="true"></i>Add service</button><a class="rounded-xl border border-white/15 bg-white/5 px-5 py-3 text-[11px] font-bold text-white" href="{{ route('services.index') }}" target="_blank" rel="noopener noreferrer">Preview expertise ↗</a></div>
        </div>
        <div class="relative mt-8 grid grid-cols-3 gap-3 border-t border-white/10 pt-6"><div><p class="text-[25px] font-extrabold">{{ $servicesForAdmin->count() }}</p><p class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Total services</p></div><div><p class="text-[25px] font-extrabold">{{ $servicesForAdmin->where('is_active', true)->count() }}</p><p class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Visible publicly</p></div><div><p class="text-[25px] font-extrabold">{{ $servicesForAdmin->where('is_active', false)->count() }}</p><p class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Hidden drafts</p></div></div>
    </section>

    @if($errors->any())<div class="rounded-2xl border border-red-200 bg-red-50 p-5 text-[13px] text-red-800" role="alert"><p class="font-extrabold">The service could not be saved.</p><ul class="mt-2 list-disc space-y-1 pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,.04)] sm:p-8">
        <div class="flex flex-wrap items-end justify-between gap-4"><div><p class="text-[10px] font-extrabold uppercase tracking-widest text-orange">Service library</p><h2 class="mt-2 text-[26px] font-extrabold tracking-[-.035em] text-slate-950">Edit public expertise</h2><p class="mt-2 text-[12px] text-slate-500">Open a service to update its content. Lower order numbers appear first within each pillar.</p></div><span class="rounded-full bg-emerald-50 px-4 py-2 text-[10px] font-extrabold text-emerald-800"><i class="fa-solid fa-link mr-2" aria-hidden="true"></i>Connected to public site</span></div>

        <div class="mt-7 space-y-4">
            @forelse($servicesForAdmin->groupBy('category') as $category => $categoryServices)
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:p-5">
                    <div class="mb-4 flex items-center justify-between gap-4"><div><p class="text-[9px] font-extrabold uppercase tracking-widest text-slate-400">Service pillar</p><h3 class="mt-1 text-[16px] font-extrabold text-slate-950">{{ $category }}</h3></div><span class="rounded-full bg-white px-3 py-1 text-[10px] font-bold text-slate-500">{{ $categoryServices->count() }} {{ Str::plural('service', $categoryServices->count()) }}</span></div>
                    <div class="space-y-3">@foreach($categoryServices as $service)
                        <details class="group rounded-xl border border-slate-200 bg-white open:shadow-[0_12px_32px_rgba(15,23,42,.06)]">
                            <summary class="grid cursor-pointer list-none grid-cols-[auto_minmax(0,1fr)_auto] items-center gap-4 p-4 [&::-webkit-details-marker]:hidden sm:p-5"><span class="grid h-10 w-10 place-items-center rounded-xl {{ $service->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}"><x-icon :name="$service->icon" class="h-4 w-4" /></span><span class="min-w-0"><span class="block truncate text-[13px] font-extrabold text-slate-900">{{ $service->title }}</span><span class="mt-1 block truncate text-[10px] text-slate-500">/{{ $service->slug }} · Order {{ $service->sort_order }}</span></span><span class="flex items-center gap-3"><span class="hidden rounded-full px-3 py-1 text-[9px] font-extrabold uppercase tracking-wide sm:inline {{ $service->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">{{ $service->is_active ? 'Live' : 'Hidden' }}</span><i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition group-open:rotate-180" aria-hidden="true"></i></span></summary>
                            <div class="border-t border-slate-100 p-4 sm:p-6">
                                <form method="POST" action="{{ route('admin.services.update', ['serviceId' => $service->getKey()]) }}">@csrf @method('PATCH')
                                    @include('admin.sections.service-fields', ['service' => $service, 'serviceIcons' => $serviceIcons])
                                    <div class="mt-6 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-5"><div class="flex flex-wrap gap-3"><button class="rounded-xl bg-navy px-5 py-3 text-[11px] font-extrabold text-white hover:bg-teal" type="submit"><i class="fa-solid fa-floppy-disk mr-2" aria-hidden="true"></i>Save changes</button>@if($service->is_active)<a class="rounded-xl border border-slate-200 px-5 py-3 text-[11px] font-extrabold text-slate-700" href="{{ route('services.show', $service) }}" target="_blank" rel="noopener noreferrer">View public page ↗</a>@endif</div></div>
                                </form>
                                <form class="mt-4" method="POST" action="{{ route('admin.services.destroy', ['serviceId' => $service->getKey()]) }}" onsubmit="return confirm('Delete this service permanently? Existing consultation records will be retained without a linked service.')">@csrf @method('DELETE')<button class="text-[10px] font-extrabold text-red-600 hover:text-red-800" type="submit"><i class="fa-solid fa-trash mr-2" aria-hidden="true"></i>Delete service permanently</button></form>
                            </div>
                        </details>
                    @endforeach</div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 p-10 text-center"><p class="text-[14px] font-extrabold text-slate-900">No services yet</p><p class="mt-2 text-[12px] text-slate-500">Create the first service to begin building the public Expertise page.</p></div>
            @endforelse
        </div>
    </section>
</div>

<dialog id="new-service" class="m-auto max-h-[calc(100vh-32px)] w-[calc(100%-32px)] max-w-4xl overflow-y-auto rounded-3xl border-0 bg-white p-0 shadow-2xl backdrop:bg-slate-950/80">
    <div class="sticky top-0 z-10 flex items-center justify-between border-b border-slate-200 bg-white px-5 py-4 sm:px-7"><div><p class="text-[9px] font-extrabold uppercase tracking-widest text-orange">New expertise record</p><h2 class="mt-1 text-[20px] font-extrabold text-slate-950">Add a service</h2></div><button class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-slate-700" type="button" onclick="document.getElementById('new-service').close()" aria-label="Close add service form"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button></div>
    <form class="p-5 sm:p-7" method="POST" action="{{ route('admin.services.store') }}">@csrf
        @include('admin.sections.service-fields', ['service' => null, 'serviceIcons' => $serviceIcons])
        <div class="mt-6 flex flex-wrap justify-end gap-3 border-t border-slate-100 pt-5"><button class="rounded-xl border border-slate-200 px-5 py-3 text-[11px] font-extrabold text-slate-700" type="button" onclick="document.getElementById('new-service').close()">Cancel</button><button class="rounded-xl bg-navy px-5 py-3 text-[11px] font-extrabold text-white" type="submit">Create service</button></div>
    </form>
</dialog>
