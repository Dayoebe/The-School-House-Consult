<div class="grid grid-cols-2 gap-x-[42px] max-[640px]:gap-x-5">
@foreach(config('site.training_categories') as $category)<a class="flex items-center gap-5 border-b border-[#d8dfe8] py-[23px] text-[16px] text-navy hover:text-orange max-[640px]:items-start max-[640px]:gap-2 max-[640px]:text-[13px]" href="{{ route('contact') }}#consultation">
<span class="text-[11px] tracking-[.08em] text-orange">0{{ $loop->iteration }}</span>
<span>{{ $category }}</span>
<span class="ml-auto" aria-hidden="true">↗</span>
</a>
@endforeach</div>
