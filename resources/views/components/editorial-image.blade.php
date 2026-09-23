@props(['name' => 'education-collaboration', 'alt', 'caption' => null, 'priority' => false])
<figure {{ $attributes->merge(['class' => 'editorial-figure']) }}>
    <img
        src="{{ asset('images/illustrations/'.$name.'-1536.webp') }}"
        srcset="{{ asset('images/illustrations/'.$name.'-768.webp') }} 768w, {{ asset('images/illustrations/'.$name.'-1536.webp') }} 1536w"
        sizes="(max-width: 640px) calc(100vw - 40px), (max-width: 1190px) 50vw, 620px"
        alt="{{ $alt }}" width="1536" height="1024"
        loading="{{ $priority ? 'eager' : 'lazy' }}" decoding="async"
        @if($priority) fetchpriority="high" @endif
    >
    @if($caption)<figcaption>{{ $caption }}</figcaption>@endif
</figure>
