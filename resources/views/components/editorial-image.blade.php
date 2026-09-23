@props(['name' => 'education-collaboration', 'alt', 'caption' => null, 'priority' => false])
<figure {{ $attributes->merge(['class' => 'm-0 overflow-hidden rounded-[10px] bg-[#e9edf3]']) }}>
    <img
        src="{{ asset('images/illustrations/'.$name.'-1536.webp') }}"
        srcset="{{ asset('images/illustrations/'.$name.'-768.webp') }} 768w, {{ asset('images/illustrations/'.$name.'-1536.webp') }} 1536w"
        sizes="(max-width: 640px) calc(100vw - 40px), (max-width: 1190px) 50vw, 620px"
        alt="{{ $alt }}" width="1536" height="1024"
        loading="{{ $priority ? 'eager' : 'lazy' }}" decoding="async"
        @if($priority) fetchpriority="high" @endif class="h-auto w-full object-cover"
    >
    @if($caption)<figcaption class="border border-t-0 border-line bg-white px-[18px] py-3.5 text-[12px] font-semibold tracking-[.015em] text-navy">{{ $caption }}</figcaption>@endif
</figure>
