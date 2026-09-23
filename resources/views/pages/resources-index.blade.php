<x-page-hero eyebrow="Resources & Insights" title="Ideas to inform. Perspectives to explore." text="A growing collection of articles and resources on education, leadership and professional practice." />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]"><div class="mb-9 flex items-center justify-between gap-9 max-[640px]:block">
<x-section-heading eyebrow="From The School House Consult" title="Latest resources" />
@if($categories->isNotEmpty())<div class="max-[640px]:mt-[18px]"><label class="mb-2 block text-[12px] font-semibold text-navy" for="category">Filter by category</label>
<select class="min-w-[180px] rounded border border-[#b9c3d1] bg-white px-3 py-3 text-[14px] text-ink" id="category" wire:model.live="category">
<option value="">All categories</option>
@foreach($categories as $item)<option value="{{ $item->slug }}">{{ $item->name }}</option>
@endforeach</select>
</div>
@endif</div>
<div wire:loading class="text-[13px] text-muted" role="status">Updating resources…</div>
<div wire:loading.class="opacity-50">
@if($articles->isEmpty())<x-empty-state title="More to explore, soon" :text="$category ? 'No published articles match this category. Try another category.' : 'Articles and resources will appear here when they are published. Explore our services or get in touch to discuss an educational topic.'" />
@else<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-2 max-[640px]:grid-cols-1">
@foreach($articles as $article)<x-article-card :article="$article" />
@endforeach</div>
<div class="mt-10">{{ $articles->links() }}</div>
@endif</div>
</div>
</section>
<x-newsletter />
<x-cta />
