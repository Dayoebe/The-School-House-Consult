<nav class="fixed inset-x-0 bottom-0 z-40 grid grid-cols-5 border-t border-line bg-white px-2 pb-[calc(7px+env(safe-area-inset-bottom))] pt-2 shadow-[0_-3px_18px_#0b2a5b08] min-[768px]:hidden" aria-label="Quick navigation">
    @foreach([
        ['home', 'Home', 'home'],
        ['services.index', 'Services', 'grid'],
        ['programs.index', 'Learn', 'book'],
        ['resources.index', 'Resources', 'document'],
        ['contact', 'Contact', 'chat'],
    ] as [$route, $label, $icon])
        <a class="flex min-h-[55px] flex-col items-center justify-center gap-0.5 py-0.5 text-[10px] font-semibold leading-[1.4] text-[#697486] aria-[current=page]:text-navy" href="{{ route($route) }}" @if(request()->routeIs(explode('.', $route)[0].'*')) aria-current="page" @endif>
            <span class="grid h-8 w-[45px] place-items-center rounded-[11px] aria-[current=page]:bg-[#fff0e4]"><x-icon class="h-[21px] w-[21px]" :name="$icon" /></span><span>{{ $label }}</span>
        </a>
    @endforeach
</nav>
