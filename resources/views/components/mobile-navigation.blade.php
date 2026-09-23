<nav class="mobile-tabs" aria-label="Quick navigation">
    @foreach([
        ['home', 'Home', 'home'],
        ['services.index', 'Services', 'grid'],
        ['programs.index', 'Learn', 'book'],
        ['resources.index', 'Resources', 'document'],
        ['contact', 'Contact', 'chat'],
    ] as [$route, $label, $icon])
        <a href="{{ route($route) }}" @if(request()->routeIs(explode('.', $route)[0].'*')) aria-current="page" @endif>
            <span class="tab-icon"><x-icon :name="$icon" /></span><span>{{ $label }}</span>
        </a>
    @endforeach
</nav>
