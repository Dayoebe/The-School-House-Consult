<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{{ $title ?? 'Education Consulting' }} | The School House Consult</title>
<meta name="description" content="{{ $description ?? config('site.mission') }}">
<link rel="canonical" href="{{ $canonical ?? url()->current() }}">
<meta property="og:site_name" content="The School House Consult">
<meta property="og:type" content="{{ isset($publishedArticle) ? 'article' : 'website' }}">
<meta property="og:title" content="{{ $title ?? 'The School House Consult' }}">
<meta property="og:description" content="{{ $description ?? config('site.mission') }}">
<meta property="og:url" content="{{ $canonical ?? url()->current() }}">
<meta property="og:image" content="{{ $image ?? asset('images/social-card.png') }}">
<meta property="og:image:alt" content="The School House Consult — Shaping the Future of Education">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title ?? 'The School House Consult' }}">
<meta name="twitter:description" content="{{ $description ?? config('site.mission') }}">
<meta name="twitter:image" content="{{ $image ?? asset('images/social-card.png') }}">
<meta name="theme-color" content="#0B2A5B">
@isset($robots)<meta name="robots" content="{{ $robots }}">
@endisset
<link rel="icon" href="{{ asset('images/brand/icon-32.png') }}" type="image/png" sizes="32x32">
<link rel="apple-touch-icon" href="{{ asset('images/brand/icon-180.png') }}" sizes="180x180">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="School House">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="application-name" content="School House Consult">
<meta name="school-house-service-worker" content="{{ asset('sw.js') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
<script type="application/ld+json">{!! json_encode(['@context'=>'https://schema.org', '@type'=>'Organization', 'name'=>config('site.name'), 'logo'=>asset(config('site.logo')), 'url'=>url('/'), 'description'=>config('site.mission'), 'email'=>config('site.email'), 'telephone'=>array_values(config('site.phones')), 'address'=>['@type'=>'PostalAddress','streetAddress'=>'First Floor Ekundayo House, Oda Road','addressLocality'=>'Akure','addressRegion'=>'Ondo State','addressCountry'=>'NG']], JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
@isset($publishedArticle)<script type="application/ld+json">{!! json_encode(array_filter(['@context'=>'https://schema.org','@type'=>'Article','headline'=>$publishedArticle->title,'description'=>$publishedArticle->excerpt,'datePublished'=>$publishedArticle->published_at->toIso8601String(),'dateModified'=>$publishedArticle->updated_at->toIso8601String(),'author'=>$publishedArticle->author ? ['@type'=>'Person','name'=>$publishedArticle->author] : null,'mainEntityOfPage'=>$canonical,'image'=>$image]), JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}</script>
@endisset
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
</head>
<body class="bg-cream font-sans text-[16px] leading-[1.65] text-ink antialiased selection:bg-orange selection:text-white">
<a href="#main-content" class="fixed left-4 top-[-100px] z-[100] bg-navy px-5 py-3 text-white focus:top-3">Skip to content</a>
<x-navbar />
<main id="main-content">{{ $slot }}</main>
<x-footer />
<x-mobile-navigation />
<div class="fixed bottom-5 left-1/2 z-[45] max-w-[calc(100%-32px)] -translate-x-1/2 rounded-[10px] border border-[#dc9d67] bg-[#fff2e5] px-[18px] py-[13px] text-[13px] text-[#713708] shadow-[0_4px_16px_#0b2a5b12] max-[767px]:bottom-[88px]" data-connection-notice role="status" hidden>You’re offline. Reconnect before sending an enquiry.</div>
@livewireScripts</body>
</html>
