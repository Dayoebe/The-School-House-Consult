<div class="space-y-7">
    <section class="relative overflow-hidden rounded-[28px] bg-slate-950 p-7 text-white sm:p-9">
        <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full border-[42px] border-white/[.04]"></div>
        <div class="relative flex flex-col justify-between gap-7 lg:flex-row lg:items-end">
            <div><span class="inline-flex rounded-full border border-violet-300/20 bg-violet-400/10 px-3 py-1 text-[9px] font-extrabold uppercase tracking-widest text-violet-200">Professional learning manager</span><h2 class="mt-5 max-w-3xl text-[clamp(32px,5vw,52px)] font-extrabold leading-[1.03] tracking-[-.05em]">Publish programmes when every detail is ready.</h2><p class="mt-4 max-w-2xl text-[13px] leading-7 text-slate-400">Create programme opportunities, define the intended audience and duration, add a cover image and control when each record becomes visible publicly.</p></div>
            <div class="flex flex-wrap gap-3"><button class="rounded-xl bg-orange px-5 py-3 text-[11px] font-extrabold text-slate-950" type="button" onclick="document.getElementById('new-program').showModal()"><i class="fa-solid fa-plus mr-2" aria-hidden="true"></i>Add programme</button><a class="rounded-xl border border-white/15 bg-white/5 px-5 py-3 text-[11px] font-bold text-white" href="{{ route('programs.index') }}" target="_blank" rel="noopener noreferrer">Preview programmes ↗</a></div>
        </div>
        <div class="relative mt-8 grid grid-cols-3 gap-3 border-t border-white/10 pt-6"><div><p class="text-[25px] font-extrabold">{{ $programsForAdmin->count() }}</p><p class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Total records</p></div><div><p class="text-[25px] font-extrabold">{{ $programsForAdmin->where('status', 'published')->count() }}</p><p class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Published</p></div><div><p class="text-[25px] font-extrabold">{{ $programsForAdmin->where('status', 'draft')->count() }}</p><p class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Drafts</p></div></div>
    </section>

    @if($errors->any())<div class="rounded-2xl border border-red-200 bg-red-50 p-5 text-[13px] text-red-800" role="alert"><p class="font-extrabold">The programme could not be saved.</p><ul class="mt-2 list-disc space-y-1 pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,.04)] sm:p-8">
        <div class="flex flex-wrap items-end justify-between gap-4"><div><p class="text-[10px] font-extrabold uppercase tracking-widest text-orange">Programme library</p><h2 class="mt-2 text-[26px] font-extrabold tracking-[-.035em] text-slate-950">Manage opportunities</h2><p class="mt-2 text-[12px] text-slate-500">Drafts stay private. Published records appear automatically on the public Programmes page.</p></div><span class="rounded-full bg-violet-50 px-4 py-2 text-[10px] font-extrabold text-violet-800"><i class="fa-solid fa-link mr-2" aria-hidden="true"></i>Connected to public site</span></div>

        <div class="mt-7 grid gap-4 xl:grid-cols-2">
            @forelse($programsForAdmin as $program)
                <details class="group self-start overflow-hidden rounded-2xl border border-slate-200 bg-white open:shadow-[0_14px_38px_rgba(15,23,42,.07)]">
                    <summary class="cursor-pointer list-none [&::-webkit-details-marker]:hidden">
                        <div class="grid grid-cols-[92px_minmax(0,1fr)_auto] items-center gap-4 p-4 max-[520px]:grid-cols-[64px_minmax(0,1fr)]">
                            @if($program->featured_image)<img class="h-20 w-[92px] rounded-xl object-cover max-[520px]:h-16 max-[520px]:w-16" src="{{ asset($program->featured_image) }}" alt="" width="92" height="80">@else<span class="grid h-20 w-[92px] place-items-center rounded-xl bg-slate-950 text-[#ffbd8d] max-[520px]:h-16 max-[520px]:w-16"><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i></span>@endif
                            <span class="min-w-0"><span class="block truncate text-[14px] font-extrabold text-slate-950">{{ $program->title }}</span><span class="mt-2 flex flex-wrap gap-2 text-[10px] text-slate-500">@if($program->duration)<span><i class="fa-regular fa-clock mr-1" aria-hidden="true"></i>{{ $program->duration }}</span>@endif @if($program->target_audience)<span class="truncate"><i class="fa-solid fa-users mr-1" aria-hidden="true"></i>{{ $program->target_audience }}</span>@endif</span></span>
                            <span class="flex items-center gap-3 max-[520px]:col-span-2 max-[520px]:justify-end"><span class="rounded-full px-3 py-1 text-[9px] font-extrabold uppercase tracking-wide {{ $program->status === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">{{ $program->status }}</span><i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition group-open:rotate-180" aria-hidden="true"></i></span>
                        </div>
                    </summary>
                    <div class="border-t border-slate-100 p-5 sm:p-6">
                        <form method="POST" action="{{ route('admin.programs.update', ['programId' => $program->getKey()]) }}" enctype="multipart/form-data">@csrf @method('PATCH')
                            @include('admin.sections.program-fields', ['program' => $program])
                            <div class="mt-6 flex flex-wrap gap-3 border-t border-slate-100 pt-5"><button class="rounded-xl bg-navy px-5 py-3 text-[11px] font-extrabold text-white hover:bg-teal" type="submit"><i class="fa-solid fa-floppy-disk mr-2" aria-hidden="true"></i>Save changes</button>@if($program->status === 'published')<a class="rounded-xl border border-slate-200 px-5 py-3 text-[11px] font-extrabold text-slate-700" href="{{ route('programs.show', $program) }}" target="_blank" rel="noopener noreferrer">View public page ↗</a>@endif</div>
                        </form>
                        <form class="mt-4" method="POST" action="{{ route('admin.programs.destroy', ['programId' => $program->getKey()]) }}" onsubmit="return confirm('Delete this programme and its managed cover image permanently?')">@csrf @method('DELETE')<button class="text-[10px] font-extrabold text-red-600 hover:text-red-800" type="submit"><i class="fa-solid fa-trash mr-2" aria-hidden="true"></i>Delete programme permanently</button></form>
                    </div>
                </details>
            @empty
                <div class="col-span-2 rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-10 text-center sm:p-14"><span class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-violet-100 text-violet-700"><i class="fa-solid fa-graduation-cap text-xl" aria-hidden="true"></i></span><h3 class="mt-5 text-[20px] font-extrabold text-slate-950">Your programme library is ready</h3><p class="mx-auto mt-3 max-w-lg text-[12px] leading-6 text-slate-500">Create the first confirmed professional-learning opportunity. Keep it as a draft until the title, description, audience and availability details are ready.</p><button class="mt-6 rounded-xl bg-navy px-5 py-3 text-[11px] font-extrabold text-white" type="button" onclick="document.getElementById('new-program').showModal()">Create first programme</button></div>
            @endforelse
        </div>
    </section>
</div>

<dialog id="new-program" class="m-auto max-h-[calc(100vh-32px)] w-[calc(100%-32px)] max-w-4xl overflow-y-auto rounded-3xl border-0 bg-white p-0 shadow-2xl backdrop:bg-slate-950/80">
    <div class="sticky top-0 z-10 flex items-center justify-between border-b border-slate-200 bg-white px-5 py-4 sm:px-7"><div><p class="text-[9px] font-extrabold uppercase tracking-widest text-orange">New professional-learning record</p><h2 class="mt-1 text-[20px] font-extrabold text-slate-950">Add a programme</h2></div><button class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-slate-700" type="button" onclick="document.getElementById('new-program').close()" aria-label="Close add programme form"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button></div>
    <form class="p-5 sm:p-7" method="POST" action="{{ route('admin.programs.store') }}" enctype="multipart/form-data">@csrf
        @include('admin.sections.program-fields', ['program' => null])
        <div class="mt-6 flex flex-wrap justify-end gap-3 border-t border-slate-100 pt-5"><button class="rounded-xl border border-slate-200 px-5 py-3 text-[11px] font-extrabold text-slate-700" type="button" onclick="document.getElementById('new-program').close()">Cancel</button><button class="rounded-xl bg-navy px-5 py-3 text-[11px] font-extrabold text-white" type="submit">Create programme</button></div>
    </form>
</dialog>
