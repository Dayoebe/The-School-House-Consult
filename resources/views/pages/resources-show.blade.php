<x-page-hero :eyebrow="$record->category?->name ?? 'Resources & Insights'" :title="$record->title" :text="$record->excerpt" />
<section class="py-[92px] max-[640px]:py-12"><article class="mx-auto max-w-[790px] break-words text-muted max-[640px]:w-[calc(100%-40px)]">
<a class="mb-3 inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('resources.index') }}">← All resources</a>
<p class="text-[13px] text-muted">
@if($record->author)By {{ $record->author }} · @endif<time datetime="{{ $record->published_at->toDateString() }}">{{ $record->published_at->format('j F Y') }}</time>
</p>
@if($record->featured_image)<img class="my-[25px] mb-10 max-h-[600px] w-full rounded object-cover" src="{{ asset($record->featured_image) }}" alt="{{ $record->title }}">
@endif<div class="prose prose-slate max-w-none text-muted prose-headings:text-navy prose-a:text-navy">{!! Str::markdown($record->body, ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}</div>
</article>
</section>
<x-cta />
