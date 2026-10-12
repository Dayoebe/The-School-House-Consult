<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $title ?? 'Admin dashboard' }} | {{ config('site.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#0b2a5b">
    <link rel="icon" href="{{ asset('images/brand/icon-32.png') }}" type="image/png" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-[#f4f7f5] font-sans text-ink antialiased">
    {{ $slot }}
    @livewireScripts
</body>
</html>
