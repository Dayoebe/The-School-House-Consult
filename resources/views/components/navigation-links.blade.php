@foreach(['home' => 'Home', 'about' => 'About', 'services.index' => 'Services', 'programs.index' => 'Programs', 'team' => 'Team', 'resources.index' => 'Resources', 'case-studies.index' => 'Case Studies', 'faq' => 'FAQ', 'contact' => 'Contact'] as $route => $label)
    <a class="group flex items-center justify-between gap-2 whitespace-nowrap py-3 text-[11px] font-semibold text-slate-600 transition hover:text-orange aria-[current=page]:text-navy" href="{{ route($route) }}" @if(request()->routeIs(explode('.', $route)[0].'*')) aria-current="page" @endif>
        <span>{{ $label }}</span><span class="hidden text-orange group-hover:inline" aria-hidden="true">↗</span>
    </a>
@endforeach
