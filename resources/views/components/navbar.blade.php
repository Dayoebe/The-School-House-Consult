<div class="bg-navy text-[10px] tracking-[.02em] text-[#dce5f2] max-[767px]:hidden">
    <div class="mx-auto flex min-h-8 w-[calc(100%-96px)] max-w-[1240px] items-center gap-[30px] max-[1190px]:w-[calc(100%-64px)] max-[640px]:w-[calc(100%-40px)]">
        <span>Partnering for educational excellence</span>
        <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
        <a href="tel:+2347062220159">0706-222-0159</a>
    </div>
</div>
<header class="sticky top-0 z-30 border-b border-line bg-white/95">
    <div class="mx-auto flex min-h-[94px] w-[calc(100%-96px)] max-w-[1240px] items-center justify-between gap-7 max-[1190px]:min-h-[82px] max-[1190px]:w-[calc(100%-64px)] max-[767px]:min-h-[76px] max-[640px]:w-[calc(100%-40px)]">
        <x-brand />
        <nav id="main-navigation" class="flex items-center gap-5 max-[1190px]:hidden" aria-label="Main navigation">
            <x-desktop-navigation />
            <a href="{{ route('contact') }}#consultation" class="inline-flex min-h-[42px] items-center justify-center gap-2.5 rounded border border-orange bg-orange px-3.5 py-[11px] text-[11px] font-bold text-[#14233a] hover:bg-[#df6811]">Request a Consultation <span class="text-[20px]" aria-hidden="true">↗</span></a>
        </nav>
        <div class="flex items-center gap-2 max-[767px]:gap-1.5 min-[1191px]:hidden">
            <a class="grid h-[46px] w-[46px] place-items-center rounded-xl border border-line bg-white text-navy hover:bg-soft max-[767px]:h-[43px] max-[767px]:w-[43px]" href="{{ config('site.whatsapp') }}" aria-label="Contact us on WhatsApp"><x-icon name="chat" /></a>
            <button class="grid h-[46px] w-[46px] place-items-center rounded-xl border border-line bg-white text-navy hover:bg-soft" type="button" data-open-menu aria-haspopup="dialog" aria-expanded="false" aria-controls="mobile-menu">
                <x-icon name="menu" /><span class="sr-only">Open navigation menu</span>
            </button>
        </div>
    </div>
</header>
<dialog id="mobile-menu" class="m-auto w-[min(480px,calc(100%-32px))] max-h-[calc(100dvh-32px)] rounded-[18px] bg-white p-7 text-ink backdrop:bg-[rgb(5_21_45_/_60%)] max-[767px]:mb-0 max-[767px]:w-full max-[767px]:max-w-none max-[767px]:rounded-t-[24px] max-[767px]:p-[25px_22px]" aria-labelledby="menu-title">
    <div class="mb-5 flex items-center justify-between gap-5">
        <div><p class="mb-2 text-[10px] font-bold uppercase tracking-[.17em] text-orange">The School House Consult</p><h2 id="menu-title" class="text-[32px] font-semibold text-navy">Explore</h2></div>
        <button type="button" class="grid h-[46px] w-[46px] place-items-center rounded-xl border border-line bg-white text-navy" data-close-menu aria-label="Close navigation menu"><x-icon name="close" /></button>
    </div>
    <nav class="grid grid-cols-2 gap-[9px] max-[360px]:grid-cols-1" aria-label="All pages"><x-navigation-links /></nav>
    <a class="mt-6 inline-flex w-full items-center justify-center gap-6 rounded border border-orange bg-orange px-6 py-[15px] font-bold text-[#14233a]" href="{{ route('contact') }}#consultation">Request a Consultation <span aria-hidden="true">↗</span></a>
    <div class="flex flex-wrap justify-center gap-5 py-[15px] text-[13px] text-navy"><a class="px-1" href="tel:+2347062220159">Call us</a><a class="px-1" href="{{ config('site.whatsapp') }}">WhatsApp</a>@auth @if(auth()->user()->isAdmin())<a class="px-1 font-semibold text-teal" href="{{ route('admin.dashboard') }}">Dashboard</a>@endif<form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button class="px-1 font-semibold text-teal" type="submit">Log out</button></form>@else<a class="px-1 font-semibold text-teal" href="{{ route('login') }}">Log in</a><a class="px-1 font-semibold text-coral" href="{{ route('register') }}">Sign up</a>@endauth</div>
    <div class="border-t border-line pt-[15px]">
        <button class="inline-flex items-center gap-3 py-3 text-[13px] font-bold text-navy" type="button" data-install-app hidden><x-icon name="download" /> Add to home screen</button>
        <p data-install-feedback class="text-[14px] text-muted" role="status" hidden></p>
        <details class="text-[12px] text-muted"><summary class="cursor-pointer py-3 text-navy">Keep School House on your home screen</summary><p class="my-2 mb-3">On iPhone, open your browser's Share menu and choose “Add to Home Screen”. On Android, open the browser menu and look for “Install app” or “Add to Home screen”.</p></details>
    </div>
</dialog>
<noscript><div class="mx-auto flex w-[calc(100%-96px)] max-w-[1240px] flex-wrap gap-5 py-4 text-[14px] max-[640px]:w-[calc(100%-40px)]"><a href="{{ route('services.index') }}">Services</a><a href="{{ route('about') }}">About</a><a href="{{ route('team') }}">Team</a><a href="{{ route('resources.index') }}">Resources</a><a href="{{ route('faq') }}">FAQ</a><a href="{{ route('contact') }}">Contact</a></div></noscript>
