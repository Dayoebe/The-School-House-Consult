<footer class="bg-[#081e40] pt-[65px] text-[#cfdaeb]">
<div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
<div class="grid grid-cols-[1.3fr_.7fr_1fr_1.2fr] gap-[55px] max-[1190px]:grid-cols-2 max-[1190px]:gap-x-[70px] max-[640px]:gap-x-5 max-[640px]:gap-y-[30px]">
<div>
<x-brand footer />
<p class="text-[12px] text-[#aebdd3]">{{ config('site.tagline') }}</p>
<p class="mt-[18px] text-[12px] text-[#aebdd3]">Strategic educational solutions for schools, educators and communities.</p>
</div>
<div>
<h2 class="mb-6 text-[13px] font-semibold text-white">Explore</h2>
@foreach(['about'=>'About Us', 'team'=>'Our Team', 'programs.index'=>'Programs & Training', 'resources.index'=>'Resources', 'case-studies.index'=>'Case Studies', 'faq'=>'FAQ'] as $route=>$label)<a class="mb-2 block py-1 text-[12px] hover:text-[#ffad70]" href="{{ route($route) }}">{{ $label }}</a>
@endforeach</div>
<div>
<h2 class="mb-6 text-[13px] font-semibold text-white">Our expertise</h2>
<a class="mb-2 block py-1 text-[12px] hover:text-[#ffad70]" href="{{ route('services.index') }}">Education consulting</a>
<a class="mb-2 block py-1 text-[12px] hover:text-[#ffad70]" href="{{ route('services.index') }}">Professional development</a>
<a class="mb-2 block py-1 text-[12px] hover:text-[#ffad70]" href="{{ route('services.index') }}">School improvement</a>
<a class="mb-2 block py-1 text-[12px] hover:text-[#ffad70]" href="{{ route('services.index') }}">Explore all services ↗</a>
<h2 class="mb-[9px] mt-[22px] text-[13px] font-semibold text-white">Social channels</h2>
@forelse(config('site.social_links') as $label => $url)
    @if(filter_var($url, FILTER_VALIDATE_URL) && in_array(parse_url($url, PHP_URL_SCHEME), ['http', 'https']))
        <a class="mb-2 block py-1 text-[12px] hover:text-[#ffad70]" href="{{ $url }}" rel="noopener noreferrer">{{ $label }}</a>
    @endif
@empty
    <p class="text-[12px] text-[#aebdd3]">Official links coming soon.</p>
@endforelse
</div>
<div>
<h2 class="mb-6 text-[13px] font-semibold text-white">Let's connect</h2>
@foreach(config('site.phones') as $display=>$phone)<a class="mb-2 block py-1 text-[12px] hover:text-[#ffad70]" href="tel:{{ $phone }}">{{ $display }}</a>
@endforeach<a class="mb-2 block py-1 text-[12px] break-words hover:text-[#ffad70]" href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
<address class="my-[18px] mb-3 text-[12px] not-italic text-[#aebdd3]">{{ config('site.address') }}</address>
<a class="mb-2 block py-1 text-[12px] hover:text-[#ffad70]" href="{{ config('site.whatsapp') }}">WhatsApp Us ↗</a>
</div>
</div>
<p class="mt-10 max-w-[800px] border-t border-[#294061] pt-5 text-[10px] leading-[1.7] text-[#aebdd3]">Our editorial illustrations are AI-generated concepts, not photographs of staff, clients or events. The Principal Consultant photograph is supplied.</p>
<div class="mt-5 flex justify-between gap-6 border-t border-[#294061] py-[23px] max-[640px]:flex-col">
<p class="text-[12px] text-[#aebdd3]">© {{ date('Y') }} The School House Consult. All rights reserved.</p>
<a class="text-[12px] hover:text-[#ffad70]" href="{{ route('contact') }}#consultation">Request a Consultation ↗</a>
</div>
</div>
</footer>
