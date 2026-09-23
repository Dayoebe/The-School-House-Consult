<div class="grid grid-cols-2 gap-x-[42px] max-[640px]:gap-x-5">
@foreach(config('site.training_categories') as $category)
@php($categoryIcon = match (true) { str_contains(strtolower($category), 'teacher') => 'fa-chalkboard-user', str_contains(strtolower($category), 'leadership') => 'fa-people-roof', str_contains(strtolower($category), 'coaching') => 'fa-person-chalkboard', str_contains(strtolower($category), 'technology') => 'fa-laptop-code', str_contains(strtolower($category), 'curriculum') => 'fa-book-open', default => 'fa-arrow-trend-up' })
<a class="flex items-center gap-4 border-b border-[#d8dfe8] py-[23px] text-[16px] text-navy hover:text-orange max-[640px]:items-start max-[640px]:gap-2 max-[640px]:text-[13px]" href="{{ route('contact') }}#consultation">
<span class="text-[11px] tracking-[.08em] text-orange">0{{ $loop->iteration }}</span>
<i class="fa-solid {{ $categoryIcon }} w-5 text-center text-teal" aria-hidden="true"></i>
<span>{{ $category }}</span>
<i class="fa-solid fa-arrow-up-right-from-square ml-auto text-[11px] text-coral" aria-hidden="true"></i>
</a>
@endforeach</div>
