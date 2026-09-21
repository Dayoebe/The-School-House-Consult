<x-page-hero :eyebrow="$record->category?->name ?? 'Resources & Insights'" :title="$record->title" :text="$record->excerpt" />
<section class="section">
<article class="container article-body prose">
<a class="text-link back-link" href="{{ route('resources.index') }}">← All resources</a>
<p class="article-meta">
@if($record->author)By {{ $record->author }} · @endif<time datetime="{{ $record->published_at->toDateString() }}">{{ $record->published_at->format('j F Y') }}</time>
</p>
@if($record->featured_image)<img class="detail-image" src="{{ asset($record->featured_image) }}" alt="{{ $record->title }}">
@endif<div class="markdown-content">{!! Str::markdown($record->body, ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}</div>
</article>
</section>
<x-cta />
