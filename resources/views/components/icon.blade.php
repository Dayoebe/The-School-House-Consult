@props(['name' => 'book'])
<svg {{ $attributes->merge(['class' => 'icon']) }} width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
@switch($name)
@case('home')<path d="m3 10 9-7 9 7v11h-6v-7H9v7H3V10Z"/>@break
@case('grid')<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>@break
@case('close')<path d="m6 6 12 12M6 18 18 6"/>@break
@case('download')<path d="M12 3v12m-5-5 5 5 5-5M4 16v5h16v-5"/>@break
@case('people')<circle cx="9" cy="7" r="3"/>
<path d="M3 21v-4a6 6 0 0 1 12 0v4M16 4a3 3 0 0 1 0 6m2 4a5 5 0 0 1 3 5v2"/>
@break
@case('growth')<path d="M4 20h16M7 16v-4m5 4V8m5 8V4M3 8l5-4 5 1 7-4"/>
@break
@case('compass')<circle cx="12" cy="12" r="9"/>
<path d="m16 8-3 5-5 3 3-5 5-3Z"/>
@break
@case('technology')<rect x="3" y="3" width="18" height="13" rx="2"/>
<path d="M8 21h8m-4-5v5M7 8h4m-4 3h10"/>
@break
@case('building')<path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5M8 9h1m6 0h1M8 12h1m6 0h1"/>
@break
@case('heart')<path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8Z"/>
@break
@case('research')<circle cx="10" cy="10" r="6"/>
<path d="m15 15 6 6M7 10h6m-3-3v6"/>
@break
@case('chat')<path d="M21 11a9 9 0 0 1-9 9 10 10 0 0 1-4-1l-5 2 1-5a9 9 0 1 1 17-5Z"/>
<path d="M8 10h8m-8 4h5"/>
@break
@case('document')<path d="M14 2H5v20h14V7l-5-5Zm0 0v6h5M8 12h8m-8 4h8"/>
@break
@case('menu')<path d="M4 6h16M4 12h16M4 18h16"/>
@break
@default<path d="M12 5C9 3 5 3 2 4v15c3-1 7-1 10 1 3-2 7-2 10-1V4c-3-1-7-1-10 1Zm0 0v15"/>
@endswitch
</svg>
