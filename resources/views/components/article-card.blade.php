@props(['article'])<article class="content-card">
@if($article->featured_image)<img class="card-image" src="{{ asset($article->featured_image) }}" alt="" width="640" height="400" loading="lazy">
@else<div class="card-image image-placeholder" aria-hidden="true">
<x-icon name="book" />
</div>
@endif<div class="card-body">
<p class="eyebrow">{{ $article->category?->name ?? 'Insights' }}</p>
<h3>
<a href="{{ route('resources.show', $article) }}">{{ $article->title }}</a>
</h3>
<p>{{ $article->excerpt }}</p>
<time datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('j F Y') }}</time>
<a class="text-link" href="{{ route('resources.show', $article) }}">Read Article <span aria-hidden="true">↗</span>
</a>
</div>
</article>
