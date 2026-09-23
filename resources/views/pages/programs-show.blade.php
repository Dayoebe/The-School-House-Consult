<x-page-hero eyebrow="Programs & Training" :title="$record->title" text="Explore this professional learning opportunity." />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-[1.6fr_1fr] items-start gap-[85px] max-[1190px]:grid-cols-1 max-[640px]:w-[calc(100%-40px)]"><article class="max-w-[790px] break-words text-muted [&_h2]:mb-5 [&_h2]:mt-[34px] [&_h2]:text-[29px] [&_h2]:font-semibold [&_h2]:text-navy [&_h2:first-of-type]:mt-0 [&_p]:mb-[18px]"><a class="mb-3 inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('programs.index') }}">← All programs</a>
@if($record->featured_image)<img class="my-[25px] mb-10 max-h-[600px] w-full rounded object-cover" src="{{ asset($record->featured_image) }}" alt="{{ $record->title }}">
@endif<h2>About this program</h2><div class="whitespace-pre-line text-muted">{{ $record->description }}</div>
@if($record->target_audience)<h2>Who it is for</h2>
<p>{{ $record->target_audience }}</p>
@endif @if($record->duration)<h2>Duration</h2>
<p>{{ $record->duration }}</p>
@endif</article>
<aside class="border-t-[3px] border-t-orange bg-soft p-[34px]"><h2 class="mb-5 text-[29px] font-semibold text-navy">Interested in this program?</h2><p class="mb-[25px] text-[14px] text-muted">Contact us to discuss availability and participation.</p>
<a class="inline-flex min-h-[50px] w-full items-center justify-center gap-3 rounded border border-orange bg-orange px-[23px] py-[15px] text-[13px] font-bold text-[#14233a]" href="{{ route('contact') }}#consultation">Enquire about training ↗</a>
</aside>
</div>
</section>
