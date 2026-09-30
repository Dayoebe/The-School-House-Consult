@foreach(['about' => 'About', 'services.index' => 'Expertise', 'programs.index' => 'Programmes', 'resources.index' => 'Insights', 'contact' => 'Contact'] as $route => $label)
<a class="relative py-3 text-[11px] font-bold tracking-[.04em] text-[#34435a] transition hover:text-orange after:absolute after:inset-x-0 after:bottom-1 after:h-px after:origin-left after:scale-x-0 after:bg-orange after:transition-transform hover:after:scale-x-100 aria-[current=page]:text-navy aria-[current=page]:after:scale-x-100" href="{{ route($route) }}" @if(request()->routeIs(explode('.', $route)[0].'*')) aria-current="page" @endif>{{ $label }}</a>
@endforeach
<a class="inline-flex items-center gap-2 rounded-full border border-[#edd8c8] bg-[#fff4e9] px-4 py-2 text-[10px] font-extrabold uppercase tracking-[.1em] text-[#9a4207] transition hover:border-orange hover:bg-orange hover:text-navy" href="{{ route('summer-spark') }}"><x-icon name="spark" class="h-4 w-4" /> Summer Spark</a>
@auth
    @if(auth()->user()->isAdmin())<a class="flex items-center gap-1.5 py-3 text-[11px] font-semibold text-teal transition hover:text-coral" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge-high text-[10px]" aria-hidden="true"></i> Dashboard</a>@endif
@endauth
