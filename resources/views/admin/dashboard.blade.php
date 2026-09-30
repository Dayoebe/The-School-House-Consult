<x-layouts.admin title="Dashboard">
    @php
        $sectionTitles = [
            null => 'Good morning, Super Admin.',
            'services' => 'Services',
            'programs' => 'Programs & training',
            'team' => 'Team members',
            'resources' => 'Resources',
            'case-studies' => 'Case studies',
            'faqs' => 'FAQs',
            'consultations' => 'Consultation requests',
            'messages' => 'Contact messages',
            'settings' => 'Site settings',
            'users' => 'Registered people',
        ];
    @endphp
    <div class="min-h-screen lg:flex" x-data="{ sidebarOpen: window.innerWidth >= 1024 }" @resize.window="if (window.innerWidth >= 1024) sidebarOpen = true">
        <aside class="w-full shrink-0 bg-[#10243d] text-white transition-[width] duration-300 lg:min-h-screen" :class="sidebarOpen ? 'lg:w-72' : 'lg:w-[88px]'">
            <div class="flex items-center justify-between gap-3 px-6 py-6 lg:px-5 lg:py-8" :class="sidebarOpen ? 'lg:px-7' : 'lg:flex-col'">
                <a class="flex min-w-0 items-center gap-3 overflow-hidden whitespace-nowrap font-display text-sm font-bold uppercase tracking-[.12em]" href="{{ route('home') }}">
                    <img class="h-9 w-9 shrink-0 rounded-xl bg-white object-contain p-1" src="{{ asset(config('site.logo')) }}" alt="" width="36" height="36">
                    <span x-show="sidebarOpen" x-transition.opacity>The School House <span class="text-[#ff9b8b]">Consult.</span></span>
                </a>
                <span class="hidden rounded-full border border-white/15 px-3 py-1 text-[10px] font-bold uppercase tracking-[.14em] text-[#9fb4bf] sm:inline-flex" x-show="sidebarOpen" x-transition.opacity>Admin</span>
                <button class="grid h-9 w-9 shrink-0 place-items-center rounded-lg border border-white/15 text-[#c5d5da] transition hover:bg-white/10 hover:text-white" type="button" @click="sidebarOpen = !sidebarOpen" :aria-label="sidebarOpen ? 'Collapse sidebar' : 'Expand sidebar'" :title="sidebarOpen ? 'Collapse sidebar' : 'Expand sidebar'"><i class="fa-solid fa-angles-left text-xs transition-transform duration-300" :class="sidebarOpen ? '' : 'rotate-180'" aria-hidden="true"></i></button>
            </div>
            <nav class="space-y-7 px-4 pb-8" :class="sidebarOpen ? 'block lg:px-4' : 'hidden lg:block lg:px-3'" aria-label="Admin navigation">
                @foreach(config('menu') as $group)
                    <div>
                        <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[.18em] text-[#78919d]" x-show="sidebarOpen" x-transition.opacity>{{ $group['label'] }}</p>
                        <div class="space-y-1">
                            @foreach($group['items'] as $item)
                                @php
                                    $active = request()->routeIs($item['route'])
                                        && (($item['params']['section'] ?? null) === $section
                                            || ($item['route'] === 'admin.dashboard' && $section === null));
                                @endphp
                                <a class="group relative flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition {{ $active ? 'bg-white text-navy shadow-lg shadow-black/10' : 'text-[#c5d5da] hover:bg-white/10 hover:text-white' }}" :class="sidebarOpen ? '' : 'justify-center'" href="{{ route($item['route'], $item['params'] ?? []) }}" title="{{ $item['label'] }}">
                                    <span class="grid h-8 w-8 shrink-0 place-items-center rounded-lg {{ $active ? 'bg-[#e5f2ed] text-teal' : 'bg-white/10 text-[#9fcfc0]' }}"><x-icon :name="$item['icon']" class="h-4 w-4" /></span>
                                    <span class="whitespace-nowrap" x-show="sidebarOpen" x-transition.opacity>{{ $item['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>
            <div class="hidden border-t border-white/10 px-7 py-6 lg:block" :class="sidebarOpen ? '' : 'lg:px-3'">
                <a class="mb-5 flex items-center gap-3 text-xs text-[#c5d5da] hover:text-white" :class="sidebarOpen ? '' : 'justify-center'" href="{{ route('home') }}" :title="sidebarOpen ? '' : 'View live website'"><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i><span x-show="sidebarOpen" x-transition.opacity>View live website</span></a>
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="flex items-center gap-2 text-xs font-semibold text-[#ffb19e] hover:text-white" :class="sidebarOpen ? '' : 'mx-auto'" type="submit" :title="sidebarOpen ? '' : 'Sign out'"><i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i><span x-show="sidebarOpen" x-transition.opacity>Sign out</span></button></form>
            </div>
        </aside>
        <main class="min-w-0 flex-1">
            <header class="flex items-center justify-between border-b border-[#dce7e1] bg-white/80 px-5 py-5 backdrop-blur sm:px-8 lg:px-12 lg:py-7">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[.17em] text-teal">The School House Consult / Control room</p>
                    <h1 class="mt-2 font-display text-2xl font-semibold tracking-[-.04em] text-navy sm:text-3xl">{{ $sectionTitles[$section] }}</h1>
                </div>
                <div class="flex items-center gap-3">
                    <button class="grid h-10 w-10 place-items-center rounded-xl border border-[#dce7e1] bg-white text-teal shadow-sm lg:hidden" type="button" @click="sidebarOpen = !sidebarOpen" :aria-label="sidebarOpen ? 'Hide navigation menu' : 'Show navigation menu'" :title="sidebarOpen ? 'Hide navigation menu' : 'Show navigation menu'"><i class="fa-solid fa-bars" :class="sidebarOpen ? 'fa-xmark' : 'fa-bars'" aria-hidden="true"></i></button>
                    <div class="hidden items-center gap-3 sm:flex">
                    <div class="grid h-10 w-10 place-items-center rounded-full bg-[#e5f2ed] text-sm font-bold text-teal">SA</div>
                    <div><p class="text-sm font-semibold text-navy">Super Admin</p><p class="text-xs text-muted">{{ auth()->user()->email }}</p></div>
                    </div>
                </div>
            </header>
            <div class="px-5 py-7 sm:px-8 lg:px-12 lg:py-10">
                @if(session('status'))<div class="mb-6 rounded-2xl border border-[#b9ded0] bg-[#eaf7f0] px-5 py-4 text-sm font-semibold text-teal" role="status">{{ session('status') }}</div>@endif
                @if($section)
                    @if($section === 'services')
                        @include('admin.sections.services')
                    @elseif($section === 'programs')
                        @include('admin.sections.programs')
                    @elseif($section === 'consultations')
                        <section x-data="{ status: '{{ $consultationStatus }}' }" class="rounded-[28px] border border-[#dce7e1] bg-white p-7 shadow-[0_12px_35px_rgba(11,42,91,.05)] sm:p-10">
                            <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end"><div><span class="inline-flex rounded-full bg-[#fff3ee] px-3 py-1 text-[10px] font-bold uppercase tracking-[.15em] text-coral">Inbox / consultation forms</span><h2 class="mt-5 font-display text-4xl font-semibold tracking-[-.05em] text-navy">Consultation requests</h2><p class="mt-3 text-sm text-muted">{{ $consultations->count() }} matching requests. Expand a row to read the full response.</p></div><form method="GET" action="{{ route('admin.section', ['section' => 'consultations']) }}"><label class="mr-2 text-xs font-semibold text-muted" for="consultation-status">Show</label><select id="consultation-status" class="rounded-lg border border-[#cbd8d2] bg-white px-3 py-2 text-xs font-semibold text-navy" name="status" onchange="this.form.submit()"><option value="" @selected($consultationStatus === '')>All requests</option><option value="new" @selected($consultationStatus === 'new')>New</option><option value="in-progress" @selected($consultationStatus === 'in-progress')>In progress</option><option value="resolved" @selected($consultationStatus === 'resolved')>Resolved</option><option value="archived" @selected($consultationStatus === 'archived')>Archived</option></select></form></div>
                            <div class="mt-8 space-y-3">@forelse($consultations as $consultation)<details class="group rounded-2xl border border-[#e5ede8] bg-[#fbfdfb] p-5"><summary class="flex cursor-pointer list-none items-center justify-between gap-4 [&::-webkit-details-marker]:hidden"><span><strong class="font-display text-lg text-navy">{{ $consultation->full_name }}</strong><span class="ml-3 text-sm text-muted">{{ $consultation->organisation ?: 'No organisation supplied' }}</span></span><span class="flex items-center gap-3"><span class="rounded-full bg-[#fff3ee] px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-coral">{{ $consultation->status }}</span><i class="fa-solid fa-chevron-down text-xs text-teal transition group-open:rotate-180" aria-hidden="true"></i></span></summary><div class="mt-5 border-t border-[#e5ede8] pt-5"><div class="grid gap-3 text-sm text-muted sm:grid-cols-2"><p><strong class="text-navy">Email:</strong> {{ $consultation->email }}</p><p><strong class="text-navy">Phone:</strong> {{ $consultation->phone }}</p><p><strong class="text-navy">Organisation type:</strong> {{ $consultation->organisation_type }}</p><p><strong class="text-navy">Service:</strong> {{ $consultation->service?->title ?? 'General guidance' }}</p><p><strong class="text-navy">Preferred contact:</strong> {{ $consultation->preferred_contact_method }}</p><p><strong class="text-navy">Received:</strong> {{ $consultation->created_at->format('j M Y, g:i A') }}</p></div><p class="mt-4 whitespace-pre-line rounded-xl bg-white p-4 text-sm leading-6 text-muted">{{ $consultation->message }}</p><div class="mt-4 flex flex-wrap items-center justify-between gap-3"><form method="POST" action="{{ route('admin.consultations.status', $consultation) }}">@csrf @method('PATCH')<label class="mr-2 text-xs font-semibold text-muted" for="status-{{ $consultation->id }}">Status</label><select id="status-{{ $consultation->id }}" class="rounded-lg border border-[#cbd8d2] bg-white px-3 py-2 text-xs font-semibold text-navy" name="status" onchange="this.form.submit()"><option value="new" @selected($consultation->status === 'new')>New</option><option value="in-progress" @selected($consultation->status === 'in-progress')>In progress</option><option value="resolved" @selected($consultation->status === 'resolved')>Resolved</option><option value="archived" @selected($consultation->status === 'archived')>Archived</option></select></form><form method="POST" action="{{ route('admin.consultations.destroy', $consultation) }}" onsubmit="return confirm('Delete this consultation request permanently?')">@csrf @method('DELETE')<button class="inline-flex items-center gap-2 rounded-lg border border-red-200 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50" type="submit"><i class="fa-solid fa-trash" aria-hidden="true"></i> Delete</button></form></div></div></details>@empty<p class="rounded-2xl bg-[#f0f7f3] p-8 text-sm text-muted">No consultation requests match this filter.</p>@endforelse</div>
                        </section>
                    @elseif($section === 'messages')
                        <section class="rounded-[28px] border border-[#dce7e1] bg-white p-7 shadow-[0_12px_35px_rgba(11,42,91,.05)] sm:p-10">
                            <span class="inline-flex rounded-full bg-[#e5f2ed] px-3 py-1 text-[10px] font-bold uppercase tracking-[.15em] text-teal">Inbox / contact forms</span>
                            <h2 class="mt-5 font-display text-4xl font-semibold tracking-[-.05em] text-navy">Contact messages</h2>
                            <p class="mt-3 text-sm text-muted">General enquiries submitted through the contact form appear here.</p>
                            <div class="mt-8 space-y-4">@forelse($messages as $message)<article class="rounded-2xl border border-[#e5ede8] bg-[#fbfdfb] p-5"><div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-start"><div><h3 class="font-display text-xl font-semibold text-navy">{{ $message->subject }}</h3><p class="mt-1 text-sm text-muted">{{ $message->full_name }} · {{ $message->email }}</p></div><form method="POST" action="{{ route('admin.messages.status', $message) }}">@csrf @method('PATCH')<select class="rounded-lg border border-[#cbd8d2] bg-white px-3 py-2 text-xs font-semibold text-navy" name="status" onchange="this.form.submit()"><option value="new" @selected($message->status === 'new')>New</option><option value="in-progress" @selected($message->status === 'in-progress')>In progress</option><option value="resolved" @selected($message->status === 'resolved')>Resolved</option><option value="archived" @selected($message->status === 'archived')>Archived</option></select></form></div><p class="mt-4 whitespace-pre-line rounded-xl bg-white p-4 text-sm leading-6 text-muted">{{ $message->message }}</p><p class="mt-3 text-xs text-muted">Received {{ $message->created_at->format('j M Y, g:i A') }}</p></article>@empty<p class="rounded-2xl bg-[#f0f7f3] p-8 text-sm text-muted">No contact messages have been submitted yet.</p>@endforelse</div>
                        </section>
                    @elseif($section === 'users')
                        <section class="rounded-[28px] border border-[#dce7e1] bg-white p-7 shadow-[0_12px_35px_rgba(11,42,91,.05)] sm:p-10">
                            <span class="inline-flex rounded-full bg-[#e5f2ed] px-3 py-1 text-[10px] font-bold uppercase tracking-[.15em] text-teal">Community directory</span>
                            <h2 class="mt-5 font-display text-4xl font-semibold tracking-[-.05em] text-navy">Registered people</h2>
                            <p class="mt-3 text-sm text-muted">{{ $users->count() }} people have an account on the website.</p>
                            <div class="mt-8 overflow-x-auto"><table class="w-full min-w-[620px] text-left text-sm"><thead class="border-b border-[#e5ede8] text-[10px] uppercase tracking-[.15em] text-muted"><tr><th class="pb-3 font-bold">Person</th><th class="pb-3 font-bold">Email</th><th class="pb-3 font-bold">Joined</th><th class="pb-3 text-right font-bold">Role</th></tr></thead><tbody class="divide-y divide-[#edf2ef]">@foreach($users as $user)<tr><td class="py-4 font-semibold text-navy">{{ $user->name }} @if($user->is(auth()->user()))<span class="ml-2 rounded-full bg-[#e5f2ed] px-2 py-1 text-[10px] font-bold text-teal">You</span>@endif</td><td class="py-4 text-muted">{{ $user->email }}</td><td class="py-4 text-muted">{{ $user->created_at->format('j M Y') }}</td><td class="py-4 text-right"><form method="POST" action="{{ route('admin.users.role', $user) }}" class="inline-flex items-center gap-2">@csrf @method('PATCH')<select class="rounded-lg border border-[#cbd8d2] bg-white px-3 py-2 text-xs font-semibold text-navy" name="role" onchange="this.form.submit()" @disabled($user->is(auth()->user()))><option value="member" @selected($user->role === 'member')>Member</option><option value="admin" @selected($user->role === 'admin')>Admin</option></select></form></td></tr>@endforeach</tbody></table></div>
                        </section>
                    @else
                    <div class="rounded-[28px] border border-[#dce7e1] bg-white p-7 shadow-[0_12px_35px_rgba(11,42,91,.05)] sm:p-10">
                        <span class="inline-flex rounded-full bg-[#e5f2ed] px-3 py-1 text-[10px] font-bold uppercase tracking-[.15em] text-teal">Workspace section</span>
                        <h2 class="mt-5 font-display text-4xl font-semibold tracking-[-.05em] text-navy">{{ $sectionTitles[$section] }}</h2>
                        <p class="mt-4 max-w-2xl text-sm leading-7 text-muted">This area is connected to the admin navigation and ready for its management workflow. The dashboard shell, authorization and menu configuration are in place.</p>
                        <a class="mt-7 inline-flex items-center rounded-full bg-coral px-5 py-3 text-sm font-bold text-white hover:bg-[#df5e51]" href="{{ route('home') }}">Preview the public website <span class="ml-3">↗</span></a>
                    </div>
                    @endif
                @else
                    <section class="relative overflow-hidden rounded-[28px] bg-slate-950 p-7 text-white shadow-[0_22px_55px_rgba(15,23,42,.18)] sm:p-9">
                        <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full border-[42px] border-white/[.04]"></div>
                        <div class="relative flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                            <div><div class="flex flex-wrap items-center gap-3"><span class="rounded-full border border-orange/25 bg-orange/10 px-3 py-1 text-[9px] font-extrabold uppercase tracking-[.16em] text-[#ffbd8d]">Admin command centre</span><span class="text-[11px] text-slate-500">{{ now()->format('l, j F Y') }}</span></div><h2 class="mt-5 max-w-2xl text-[clamp(32px,5vw,54px)] font-extrabold leading-[1.02] tracking-[-.055em]">See what needs attention. Move the work forward.</h2><p class="mt-4 max-w-2xl text-[13px] leading-7 text-slate-400">Monitor enquiries, publishing readiness and the content that shapes the public website from one focused workspace.</p></div>
                            <div class="flex flex-wrap gap-3"><a class="rounded-xl bg-orange px-5 py-3 text-[11px] font-extrabold text-slate-950" href="{{ route('admin.section', ['section' => 'consultations']) }}">Open enquiry inbox</a><a class="rounded-xl border border-white/15 bg-white/5 px-5 py-3 text-[11px] font-bold text-white" href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">View live website ↗</a></div>
                        </div>
                        <div class="relative mt-8 grid grid-cols-2 gap-3 border-t border-white/10 pt-6 lg:grid-cols-4">
                            @foreach([['New items', $dashboardSummary['new']], ['Active conversations', $dashboardSummary['active']], ['Published items', $dashboardSummary['published']], ['Registered people', $dashboardSummary['registered']]] as [$label,$value])<div><p class="text-[26px] font-extrabold tracking-[-.04em]">{{ number_format($value) }}</p><p class="mt-1 text-[10px] font-bold uppercase tracking-wider text-slate-500">{{ $label }}</p></div>@endforeach
                        </div>
                    </section>

                    <section class="mt-7 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Dashboard summaries">
                        @foreach([
                            ['New consultations', $stats[2]['value'], 'compass', 'bg-orange-100 text-orange-700', 'consultations'],
                            ['New messages', $stats[3]['value'], 'chat', 'bg-blue-100 text-blue-700', 'messages'],
                            ['Live services', $stats[0]['value'], 'grid', 'bg-emerald-100 text-emerald-700', 'services'],
                            ['Published insights', $stats[1]['value'], 'document', 'bg-violet-100 text-violet-700', 'resources'],
                        ] as [$label,$value,$icon,$tone,$target])
                            <a class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_8px_25px_rgba(15,23,42,.04)] transition hover:-translate-y-1 hover:border-slate-300 hover:shadow-[0_16px_38px_rgba(15,23,42,.08)]" href="{{ route('admin.section', ['section' => $target]) }}"><div class="flex items-start justify-between"><span class="grid h-11 w-11 place-items-center rounded-xl {{ $tone }}"><x-icon :name="$icon" class="h-5 w-5" /></span><i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-300 transition group-hover:text-slate-700" aria-hidden="true"></i></div><p class="mt-6 text-[30px] font-extrabold leading-none tracking-[-.05em] text-slate-950">{{ number_format($value) }}</p><p class="mt-2 text-[12px] font-bold text-slate-600">{{ $label }}</p></a>
                        @endforeach
                    </section>

                    <div class="mt-7 grid gap-7 xl:grid-cols-[1.35fr_.65fr]">
                        <section class="rounded-[26px] border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,.04)] sm:p-8">
                            <div class="flex flex-wrap items-end justify-between gap-4"><div><p class="text-[10px] font-extrabold uppercase tracking-widest text-orange">Latest activity</p><h2 class="mt-2 text-[25px] font-extrabold tracking-[-.035em] text-slate-950">Across your inbox</h2><p class="mt-2 text-[12px] text-slate-500">Consultation requests and general messages, ordered by arrival.</p></div><div class="flex gap-2"><a class="rounded-lg bg-slate-100 px-3 py-2 text-[10px] font-extrabold text-slate-700" href="{{ route('admin.section', ['section' => 'consultations']) }}">Consultations</a><a class="rounded-lg bg-slate-100 px-3 py-2 text-[10px] font-extrabold text-slate-700" href="{{ route('admin.section', ['section' => 'messages']) }}">Messages</a></div></div>
                            <div class="mt-6 divide-y divide-slate-100">@forelse($recentInbox as $activity)<a class="group grid grid-cols-[auto_minmax(0,1fr)_auto] items-center gap-4 py-4" href="{{ $activity['route'] }}"><span class="grid h-10 w-10 place-items-center rounded-xl {{ $activity['type'] === 'Consultation' ? 'bg-orange-50 text-orange-700' : 'bg-blue-50 text-blue-700' }}"><x-icon :name="$activity['icon']" class="h-4 w-4" /></span><span class="min-w-0"><span class="block truncate text-[13px] font-extrabold text-slate-900">{{ $activity['title'] }}</span><span class="mt-1 block truncate text-[11px] text-slate-500">{{ $activity['type'] }} · {{ $activity['context'] }} · {{ $activity['created_at']->diffForHumans() }}</span></span><span class="rounded-full px-3 py-1 text-[9px] font-extrabold uppercase tracking-wide {{ $activity['status'] === 'new' ? 'bg-orange-100 text-orange-800' : ($activity['status'] === 'in-progress' ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-600') }}">{{ $activity['status'] }}</span></a>@empty<div class="py-12 text-center"><span class="mx-auto grid h-12 w-12 place-items-center rounded-2xl bg-emerald-50 text-emerald-700"><i class="fa-solid fa-inbox" aria-hidden="true"></i></span><p class="mt-4 text-[14px] font-extrabold text-slate-900">Your inbox is quiet</p><p class="mt-2 text-[12px] text-slate-500">New website enquiries will appear here.</p></div>@endforelse</div>
                        </section>

                        <div class="space-y-7">
                            <section class="rounded-[26px] bg-navy p-6 text-white sm:p-7"><p class="text-[10px] font-extrabold uppercase tracking-widest text-[#ffb47d]">Inbox health</p><h2 class="mt-2 text-[23px] font-extrabold tracking-[-.03em]">Conversation status</h2><div class="mt-6 space-y-4">@foreach([['new','New','bg-orange'],['in-progress','In progress','bg-blue-400'],['resolved','Resolved','bg-emerald-400'],['archived','Archived','bg-slate-400']] as [$key,$label,$color])<div><div class="flex items-center justify-between text-[11px]"><span class="font-bold text-slate-300">{{ $label }}</span><span class="font-extrabold text-white">{{ $inboxStatusCounts[$key] }}</span></div><div class="mt-2 h-1.5 overflow-hidden rounded-full bg-white/10"><div class="h-full rounded-full {{ $color }}" style="width: {{ $inboxStatusCounts->sum() > 0 ? max(4, round(($inboxStatusCounts[$key] / $inboxStatusCounts->sum()) * 100)) : 0 }}%"></div></div></div>@endforeach</div></section>
                            <section class="rounded-[26px] border border-emerald-200 bg-emerald-50 p-6"><p class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-700">Quick action</p><h2 class="mt-3 text-[20px] font-extrabold leading-tight text-slate-950">Review what visitors see.</h2><p class="mt-3 text-[12px] leading-6 text-slate-600">Open the public website in a new tab after updating content or responding to enquiries.</p><a class="mt-5 inline-flex text-[11px] font-extrabold text-emerald-800" href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">Preview public website →</a></section>
                        </div>
                    </div>

                    <section class="mt-7 rounded-[26px] border border-slate-200 bg-white p-6 shadow-[0_10px_30px_rgba(15,23,42,.04)] sm:p-8">
                        <div class="flex flex-wrap items-end justify-between gap-4"><div><p class="text-[10px] font-extrabold uppercase tracking-widest text-orange">Publishing readiness</p><h2 class="mt-2 text-[25px] font-extrabold tracking-[-.035em] text-slate-950">Website content inventory</h2><p class="mt-2 text-[12px] text-slate-500">Live and unpublished records across each content area.</p></div><span class="rounded-full bg-slate-100 px-4 py-2 text-[10px] font-extrabold text-slate-600">{{ $dashboardSummary['published'] }} items live</span></div>
                        <div class="mt-7 grid gap-4 md:grid-cols-2 xl:grid-cols-3">@foreach($contentInventory as $item)
                            @php
                                $tone = match($item['tone']) {
                                    'blue' => 'bg-blue-100 text-blue-700', 'violet' => 'bg-violet-100 text-violet-700',
                                    'teal' => 'bg-cyan-100 text-cyan-700', 'orange' => 'bg-orange-100 text-orange-700',
                                    'rose' => 'bg-rose-100 text-rose-700', default => 'bg-emerald-100 text-emerald-700',
                                };
                            @endphp
                            <a class="group rounded-2xl border border-slate-200 bg-slate-50 p-5 transition hover:border-slate-300 hover:bg-white hover:shadow-md" href="{{ route('admin.section', ['section' => $item['key']]) }}"><div class="flex items-start justify-between gap-4"><span class="grid h-10 w-10 place-items-center rounded-xl {{ $tone }}"><x-icon :name="$item['icon']" class="h-4 w-4" /></span><span class="text-[10px] font-extrabold text-slate-400">{{ $item['live'] }}/{{ $item['total'] }} live</span></div><h3 class="mt-4 text-[15px] font-extrabold text-slate-950">{{ $item['label'] }}</h3><div class="mt-4 h-1.5 overflow-hidden rounded-full bg-slate-200"><div class="h-full rounded-full bg-teal transition-all" style="width: {{ $item['progress'] }}%"></div></div><div class="mt-3 flex items-center justify-between text-[10px] text-slate-500"><span>{{ $item['draft'] }} unpublished</span><span class="font-extrabold text-slate-700 group-hover:text-teal">Open section →</span></div></a>
                        @endforeach</div>
                    </section>
                @endif
            </div>
        </main>
    </div>
</x-layouts.admin>
