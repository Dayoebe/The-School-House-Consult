@props(['member'])<article class="mx-auto grid max-w-[1030px] grid-cols-[.78fr_1fr] items-center gap-[100px] max-[767px]:grid-cols-1 max-[1190px]:gap-[45px]">
<div class="overflow-hidden rounded bg-[#08122d] max-[640px]:rounded-xl">
@if($member->photograph)<img class="aspect-[.88] w-full object-cover object-[center_23%]" src="{{ asset($member->photograph) }}" alt="{{ $member->name }}, {{ $member->role }}" width="864" height="1080" loading="lazy">
@else<div class="grid min-h-[300px] place-items-center text-white">{{ $member->name }}</div>
@endif</div>
<div>
<p class="mb-5 text-[11px] font-bold uppercase tracking-[.17em] text-orange">The people behind the purpose</p>
<h2 class="mb-3 text-[clamp(30px,3vw,43px)] font-semibold leading-[1.15] tracking-[-.035em] text-navy">{{ $member->name }}</h2>
<p class="mb-[25px] text-[15px] text-orange">{{ $member->role }}</p>
<p class="text-muted">{{ $member->biography }}</p>
@if($member->publish_contact)<div class="mt-[18px] flex flex-wrap gap-4">
@if($member->email)<a class="text-navy underline" href="mailto:{{ $member->email }}">{{ $member->email }}</a>
@endif @if($member->phone)<a class="text-navy underline" href="tel:{{ preg_replace('/[^+0-9]/', '', $member->phone) }}">{{ $member->phone }}</a>
@endif @foreach($member->social_links ?? [] as $label => $url) @if(filter_var($url, FILTER_VALIDATE_URL) && in_array(parse_url($url, PHP_URL_SCHEME), ['http', 'https']))<a class="text-navy underline" href="{{ $url }}" rel="noopener noreferrer">{{ $label }}</a>
@endif @endforeach</div>
@endif<a class="mt-6 inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('contact') }}#consultation">Start a conversation <i class="fa-solid fa-arrow-up-right-from-square text-[11px]" aria-hidden="true"></i>
</a>
</div>
</article>
