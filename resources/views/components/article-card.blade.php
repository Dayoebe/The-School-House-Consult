@props(['article'])<article class="group overflow-hidden rounded-[24px] border border-[#e7ded1] bg-white/80 shadow-[0_10px_30px_rgba(11,42,91,.05)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_20px_45px_rgba(11,42,91,.12)]">
@if($article->featured_image)<img class="aspect-[1.6] w-full object-cover" src="{{ asset($article->featured_image) }}" alt="" width="640" height="400" loading="lazy">
@else<div class="grid aspect-[1.6] place-items-center bg-[#e9eef5] text-navy" aria-hidden="true">
<x-icon name="book" />
</div>
@endif<div class="p-7">
<p class="mb-3 text-[11px] font-bold uppercase tracking-[.17em] text-teal">{{ $article->category?->name ?? 'Insights' }}</p>
<h3 class="mb-[15px] font-display text-[22px] font-semibold leading-[1.1] tracking-[-.02em] text-navy">
<a href="{{ route('resources.show', $article) }}">{{ $article->title }}</a>
</h3>
<p class="text-[14px] text-muted">{{ $article->excerpt }}</p>
<time class="my-5 mb-3 block text-[12px] text-muted" datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('j F Y') }}</time>
<a class="mt-[15px] inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('resources.show', $article) }}">Read Article <i class="fa-solid fa-arrow-up-right-from-square text-[11px]" aria-hidden="true"></i>
</a>
</div>
</article>
