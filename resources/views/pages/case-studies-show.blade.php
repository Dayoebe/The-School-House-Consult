<x-page-hero eyebrow="Case study" :title="$record->title" :text="$record->summary" />
<section class="py-[92px] max-[640px]:py-12"><article class="mx-auto max-w-[790px] break-words text-muted [&_h2]:mb-5 [&_h2]:mt-[34px] [&_h2]:text-[29px] [&_h2]:font-semibold [&_h2]:text-navy [&_h2:first-of-type]:mt-0"><a class="mb-3 inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('case-studies.index') }}">← All case studies</a>
@if($record->client_name)<p class="mb-5 text-[11px] font-bold uppercase tracking-[.17em] text-orange">{{ $record->client_name }}</p>
@endif @if($record->featured_image)<img class="my-[25px] mb-10 max-h-[600px] w-full rounded object-cover" src="{{ asset($record->featured_image) }}" alt="{{ $record->title }}">
@endif @foreach(['challenge'=>'The challenge', 'approach'=>'Our approach', 'outcome'=>'The outcome'] as $field=>$heading)<h2>{{ $heading }}</h2><div class="whitespace-pre-line">{{ $record->$field }}</div>
@endforeach</article>
</section>
<x-cta />
