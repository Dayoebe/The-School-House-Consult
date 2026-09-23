@php
    $groups = [
        'About' => [
            'about' => 'About us',
            'team' => 'Our team',
            'faq' => 'FAQs',
        ],
        'Explore' => [
            'services.index' => 'Services',
            'programs.index' => 'Programs & training',
            'resources.index' => 'Resources',
            'case-studies.index' => 'Case studies',
        ],
    ];
@endphp
@foreach($groups as $label => $links)
    <div class="relative" x-data="{ open: false }" @keydown.escape="open = false" @click.outside="open = false">
        <button class="flex items-center gap-2 whitespace-nowrap py-3 text-[11px] font-semibold text-slate-600 transition hover:text-orange" type="button" x-ref="trigger" @click="open = !open" :aria-expanded="open.toString()" aria-haspopup="true">
            {{ $label }}
            <span class="text-[13px] text-teal transition" :class="open ? 'rotate-180' : ''" aria-hidden="true">⌄</span>
        </button>
        <div class="absolute left-1/2 top-full z-50 mt-2 w-60 -translate-x-1/2 rounded-2xl border border-[#e4ebe7] bg-white p-2 shadow-[0_18px_45px_rgba(11,42,91,.14)]" x-show="open" x-transition.opacity.duration.150ms x-transition.origin.top aria-label="{{ $label }} menu">
            @foreach($links as $route => $linkLabel)
                <a class="flex items-center justify-between rounded-xl px-3 py-2.5 text-xs font-semibold text-navy transition hover:bg-[#eaf4ef] hover:text-teal" href="{{ route($route) }}" @if(request()->routeIs(explode('.', $route)[0].'*')) aria-current="page" @endif>
                    {{ $linkLabel }} <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-coral" aria-hidden="true"></i>
                </a>
            @endforeach
        </div>
    </div>
@endforeach
<a class="py-3 text-[11px] font-semibold text-slate-600 transition hover:text-orange" href="{{ route('contact') }}">Contact</a>
@auth
    <span class="ml-1 border-l border-[#dce7e1] pl-5 text-[11px] font-semibold text-navy">Hi, {{ Str::before(auth()->user()->name, ' ') }}</span>
    @if(auth()->user()->isAdmin())<a class="flex items-center gap-1.5 py-3 text-[11px] font-semibold text-teal transition hover:text-coral" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge-high text-[10px]" aria-hidden="true"></i> Dashboard</a>@endif
    <form method="POST" action="{{ route('logout') }}"><button class="flex items-center gap-1.5 py-3 text-[11px] font-semibold text-slate-600 transition hover:text-coral" type="submit"><i class="fa-solid fa-arrow-right-from-bracket text-[10px]" aria-hidden="true"></i> Log out</button>@csrf</form>
@else
    <a class="ml-1 flex items-center gap-1.5 border-l border-[#dce7e1] pl-5 py-3 text-[11px] font-semibold text-teal transition hover:text-coral" href="{{ route('login', ['redirect' => url()->current()]) }}"><i class="fa-solid fa-arrow-right-to-bracket text-[10px]" aria-hidden="true"></i> Log in</a>
    <a class="flex items-center gap-1.5 rounded-full bg-navy px-4 py-2 text-[11px] font-bold text-white transition hover:bg-teal" href="{{ route('register') }}"><i class="fa-solid fa-user-plus text-[10px]" aria-hidden="true"></i> Sign up</a>
@endauth
