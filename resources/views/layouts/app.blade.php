<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $seo['title'] ?? ($title ?? 'Education Consulting') }} | {{ config('site.name') }}</title>
    <meta name="description" content="{{ $seo['description'] ?? ($description ?? config('site.mission')) }}">
    <meta name="robots" content="{{ $seo['robots'] ?? ($robots ?? 'index, follow') }}">
    @if (config('site.google_site_verification'))
        <meta name="google-site-verification" content="{{ config('site.google_site_verification') }}">
    @endif
    @if (config('site.bing_site_verification'))
        <meta name="msvalidate.01" content="{{ config('site.bing_site_verification') }}">
    @endif
    <link rel="canonical" href="{{ $seo['canonical'] ?? ($canonical ?? url()->current()) }}">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:locale" content="en_NG">
    <meta property="og:type" content="{{ $seo['type'] ?? 'website' }}">
    <meta property="og:title" content="{{ $seo['title'] ?? config('site.name') }}">
    <meta property="og:description" content="{{ $seo['description'] ?? config('site.mission') }}">
    <meta property="og:url" content="{{ $seo['canonical'] ?? url()->current() }}">
    <meta property="og:image" content="{{ $seo['image'] ?? asset('images/social-card.png') }}">
    <meta property="og:image:secure_url" content="{{ $seo['image'] ?? asset('images/social-card.png') }}">
    <meta property="og:image:type" content="{{ $seo['imageType'] ?? 'image/png' }}">
    <meta property="og:image:width" content="{{ $seo['imageWidth'] ?? 1200 }}">
    <meta property="og:image:height" content="{{ $seo['imageHeight'] ?? 630 }}">
    <meta property="og:image:alt"
        content="{{ $seo['imageAlt'] ?? 'The School House Consult — Shaping the Future of Education' }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] ?? config('site.name') }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? config('site.mission') }}">
    <meta name="twitter:image" content="{{ $seo['image'] ?? asset('images/social-card.png') }}">
    <meta name="twitter:image:alt"
        content="{{ $seo['imageAlt'] ?? 'The School House Consult — Shaping the Future of Education' }}">
    <meta name="theme-color" content="#0B2A5B">
    <meta name="color-scheme" content="light">
    <link rel="alternate" type="application/rss+xml" title="School House Consult education insights"
        href="{{ route('feed') }}">
    <link rel="icon" href="{{ asset('images/brand/icon-32.png') }}" type="image/png" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('images/brand/icon-180.png') }}" sizes="180x180">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="School House Consult">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="application-name" content="School House Consult">
    <meta name="msapplication-TileColor" content="#0B2A5B">
    <meta name="school-house-service-worker" content="{{ asset('sw.js') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @isset($seo['schema'])
        <script type="application/ld+json">{!! json_encode($seo['schema'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
    @endisset
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="bg-cream font-sans text-[16px] leading-[1.65] text-ink antialiased selection:bg-orange selection:text-white">
    <a href="#main-content" class="fixed left-4 top-[-100px] z-[100] bg-navy px-5 py-3 text-white focus:top-3">Skip to
        content</a>
    <x-navbar />
    <main id="main-content">{{ $slot }}</main>
    <x-footer />
    <x-install-app />
    <x-mobile-navigation />
    <div class="fixed bottom-5 left-1/2 z-[45] max-w-[calc(100%-32px)] -translate-x-1/2 rounded-[10px] border border-[#dc9d67] bg-[#fff2e5] px-[18px] py-[13px] text-[13px] text-[#713708] shadow-[0_4px_16px_#0b2a5b12] max-[767px]:bottom-[88px]"
        data-connection-notice role="status" hidden>You’re offline. Reconnect before sending an enquiry.</div>
    @livewireScripts
</body>

</html>
