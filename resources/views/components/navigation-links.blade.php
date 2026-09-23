@foreach(['home' => 'Home', 'about' => 'About', 'services.index' => 'Services', 'programs.index' => 'Programs', 'team' => 'Team', 'resources.index' => 'Resources', 'case-studies.index' => 'Case Studies', 'faq' => 'FAQ', 'contact' => 'Contact'] as $route => $label)
    <a href="{{ route($route) }}" @if(request()->routeIs(explode('.', $route)[0].'*')) aria-current="page" @endif>
        <span>{{ $label }}</span><span class="menu-link-arrow" aria-hidden="true">↗</span>
    </a>
@endforeach
