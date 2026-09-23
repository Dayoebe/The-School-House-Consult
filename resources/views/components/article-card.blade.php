@props(['article'])<article class="overflow-hidden rounded border border-line">
@if($article->featured_image)<img class="aspect-[1.6] w-full object-cover" src="{{ asset($article->featured_image) }}" alt="" width="640" height="400" loading="lazy">
@else<div class="grid aspect-[1.6] place-items-center bg-[#e9eef5] text-navy" aria-hidden="true">
<x-icon name="book" />
</div>
@endif<div class="p-7">
<p class="mb-3 text-[11px] font-bold uppercase tracking-[.17em] text-orange">{{ $article->category?->name ?? 'Insights' }}</p>
<h3 class="mb-[15px] text-[22px] font-semibold leading-[1.3] tracking-[-.02em] text-navy">
<a href="{{ route('resources.show', $article) }}">{{ $article->title }}</a>
</h3>
<p class="text-[14px] text-muted">{{ $article->excerpt }}</p>
<time class="my-5 mb-3 block text-[12px] text-muted" datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('j F Y') }}</time>
<a class="mt-[15px] inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('resources.show', $article) }}">Read Article <span class="text-[22px]" aria-hidden="true">↗</span>
</a>
</div>
</article>
