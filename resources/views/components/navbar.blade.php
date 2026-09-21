<div class="contact-strip">
<div class="container">
<span>Partnering for educational excellence</span>
<a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
<a href="tel:+2347062220159">0706-222-0159</a>
</div>
</div>
<header class="site-header" x-data="{ open: false }" @keydown.escape.window="if (open) { open = false; $refs.menuButton.focus() }">
    <div class="container nav-row">
<x-brand />
        <button class="menu-toggle" x-ref="menuButton" type="button" @click="open = !open" :aria-expanded="open" aria-controls="main-navigation">
<span x-text="open ? 'Close' : 'Menu'">Menu</span>
<x-icon name="menu" />
</button>
        <nav id="main-navigation" aria-label="Main navigation" :class="{ 'is-open': open }">
            @foreach(['home' => 'Home', 'about' => 'About', 'services.index' => 'Services', 'programs.index' => 'Programs', 'team' => 'Team', 'resources.index' => 'Resources', 'case-studies.index' => 'Case Studies', 'faq' => 'FAQ', 'contact' => 'Contact'] as $route => $label)
                <a href="{{ route($route) }}" @if(request()->routeIs(explode('.', $route)[0].'*')) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
            <a href="{{ route('contact') }}#consultation" class="button button-small nav-cta">Request a Consultation <span aria-hidden="true">↗</span>
</a>
        </nav>
    </div>
</header>
