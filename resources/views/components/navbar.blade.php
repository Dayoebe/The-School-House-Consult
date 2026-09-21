<div class="contact-strip">
    <div class="container">
        <span>Partnering for educational excellence</span>
        <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
        <a href="tel:+2347062220159">0706-222-0159</a>
    </div>
</div>
<header class="site-header">
    <div class="container nav-row">
        <x-brand />
        <nav id="main-navigation" class="primary-navigation" aria-label="Main navigation">
            <x-navigation-links />
            <a href="{{ route('contact') }}#consultation" class="button button-small nav-cta">Request a Consultation <span aria-hidden="true">↗</span></a>
        </nav>
        <div class="mobile-header-actions">
            <a class="header-contact" href="{{ config('site.whatsapp') }}" aria-label="Contact us on WhatsApp"><x-icon name="chat" /></a>
            <button class="menu-toggle" type="button" data-open-menu aria-haspopup="dialog" aria-expanded="false" aria-controls="mobile-menu">
                <x-icon name="menu" /><span class="sr-only">Open navigation menu</span>
            </button>
        </div>
    </div>
</header>
<dialog id="mobile-menu" class="menu-sheet" aria-labelledby="menu-title">
    <div class="menu-sheet-heading">
        <div><p class="eyebrow">The School House Consult</p><h2 id="menu-title">Explore</h2></div>
        <button type="button" class="icon-button" data-close-menu aria-label="Close navigation menu"><x-icon name="close" /></button>
    </div>
    <nav class="sheet-navigation" aria-label="All pages"><x-navigation-links /></nav>
    <a class="button menu-consultation" href="{{ route('contact') }}#consultation">Request a Consultation <span aria-hidden="true">↗</span></a>
    <div class="menu-direct-contact"><a href="tel:+2347062220159">Call us</a><a href="{{ config('site.whatsapp') }}">WhatsApp</a></div>
    <div class="install-section">
        <button class="text-link" type="button" data-install-app hidden><x-icon name="download" /> Add to home screen</button>
        <p data-install-feedback class="muted" role="status" hidden></p>
        <details class="install-help"><summary>Keep School House on your home screen</summary><p>On iPhone, open your browser's Share menu and choose “Add to Home Screen”. On Android, open the browser menu and look for “Install app” or “Add to Home screen”.</p></details>
    </div>
</dialog>
<noscript><div class="no-script-navigation container"><a href="{{ route('services.index') }}">Services</a><a href="{{ route('about') }}">About</a><a href="{{ route('team') }}">Team</a><a href="{{ route('resources.index') }}">Resources</a><a href="{{ route('faq') }}">FAQ</a><a href="{{ route('contact') }}">Contact</a></div></noscript>
