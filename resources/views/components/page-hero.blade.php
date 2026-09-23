@props(['eyebrow', 'title', 'text'])<section class="border-b border-line bg-soft py-[70px] max-[640px]:py-[35px]">
<div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[1190px]:w-[calc(100%-64px)] max-[640px]:w-[calc(100%-40px)]">
<p class="mb-5 flex items-center gap-2.5 text-[11px] font-bold uppercase leading-[1.65] tracking-[.17em] text-orange">{{ $eyebrow }}</p>
<h1 class="max-w-[890px] text-[clamp(40px,4.5vw,66px)] font-semibold leading-[1.15] tracking-[-.035em] text-navy max-[640px]:text-[35px]">{{ $title }}</h1>
<p class="mt-[25px] max-w-[715px] text-[18px] text-muted max-[640px]:text-[15px]">{{ $text }}</p>
</div>
</section>
