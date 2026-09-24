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
                <a class="flex min-w-0 items-center gap-3 overflow-hidden whitespace-nowrap font-display text-sm font-bold uppercase tracking-[.12em]" href="{{ route('admin.dashboard') }}">
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
                                @php($active = request()->routeIs($item['route']) && (($item['params']['section'] ?? null) === $section || ($item['route'] === 'admin.dashboard' && $section === null)))
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
                    @if($section === 'users')
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
                    <div class="mb-8 flex flex-col justify-between gap-5 rounded-[28px] bg-[linear-gradient(120deg,#0f766e,#10243d)] p-7 text-white shadow-[0_20px_50px_rgba(15,118,110,.18)] sm:flex-row sm:items-end sm:p-9">
                        <div><p class="text-[11px] font-bold uppercase tracking-[.18em] text-[#9de4d0]">Your workspace at a glance</p><h2 class="mt-3 max-w-xl font-display text-4xl font-semibold leading-none tracking-[-.055em] sm:text-5xl">Make the next useful thing visible.</h2></div>
                        <a class="shrink-0 rounded-full bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-[#eef8f4]" href="{{ route('home') }}">View website ↗</a>
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                        @foreach($stats as $stat)
                            <article class="rounded-[22px] border border-[#dce7e1] bg-white p-6 shadow-[0_10px_30px_rgba(11,42,91,.04)]"><div class="flex items-center justify-between"><span class="grid h-10 w-10 place-items-center rounded-xl {{ $stat['tone'] === 'coral' ? 'bg-[#fff0ed] text-coral' : 'bg-[#e5f2ed] text-teal' }}"><x-icon :name="$stat['icon']" class="h-5 w-5" /></span><span class="text-xl text-[#cbd8d2]">↗</span></div><p class="mt-7 text-3xl font-bold tracking-[-.04em] text-navy">{{ $stat['value'] }}</p><p class="mt-1 text-sm text-muted">{{ $stat['label'] }}</p></article>
                        @endforeach
                    </div>
                    <div class="mt-8 grid gap-8 xl:grid-cols-[1.15fr_.85fr]">
                        <section class="rounded-[28px] border border-[#dce7e1] bg-white p-7 shadow-[0_10px_30px_rgba(11,42,91,.04)] sm:p-8"><div class="flex items-center justify-between"><div><p class="text-[11px] font-bold uppercase tracking-[.17em] text-teal">Recent activity</p><h2 class="mt-2 font-display text-2xl font-semibold text-navy">Latest consultation requests</h2></div><a class="text-sm font-bold text-coral hover:text-navy" href="{{ route('admin.section', ['section' => 'consultations']) }}">See all ↗</a></div><div class="mt-6 divide-y divide-[#e8efeb]">@forelse($recentConsultations as $consultation)<div class="flex items-center justify-between gap-4 py-4"><div><p class="text-sm font-semibold text-navy">{{ $consultation->full_name }}</p><p class="mt-1 text-xs text-muted">{{ $consultation->organisation ?: 'Independent enquiry' }}</p></div><span class="rounded-full bg-[#fff3ee] px-3 py-1 text-[10px] font-bold uppercase tracking-wide text-coral">{{ $consultation->status }}</span></div>@empty<p class="py-8 text-sm text-muted">No consultation requests yet.</p>@endforelse</div></section>
                        <section class="rounded-[28px] border border-[#dce7e1] bg-[#f0f7f3] p-7 sm:p-8"><p class="text-[11px] font-bold uppercase tracking-[.17em] text-teal">Content pulse</p><h2 class="mt-2 font-display text-2xl font-semibold text-navy">Your website inventory</h2><div class="mt-6 space-y-4">@foreach([['Programs','programs'],['Team members','team'],['Case studies','case-studies'],['FAQs','faqs']] as [$label,$key])<a class="flex items-center justify-between rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-navy transition hover:-translate-y-0.5 hover:shadow-md" href="{{ route('admin.section', ['section' => $key]) }}"><span>{{ $label }}</span><span class="text-teal">{{ $contentCounts[$key] }} <span class="ml-2 text-lg">↗</span></span></a>@endforeach</div></section>
                    </div>
                @endif
            </div>
        </main>
    </div>
</x-layouts.admin>
