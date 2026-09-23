<div class="grid grid-cols-[.8fr_1.2fr_1fr] gap-[38px] max-[1190px]:grid-cols-[1fr_1.4fr] max-[1190px]:gap-[25px] max-[767px]:grid-cols-1">
<div class="border-t border-line pt-6 max-[640px]:rounded-[10px] max-[640px]:border max-[640px]:p-[21px]">
<p class="mb-[15px] text-[11px] font-bold uppercase tracking-[.17em] text-orange">Call Us</p>
@foreach(config('site.phones') as $display=>$phone)<a class="mb-1 block text-[16px] text-navy" href="tel:{{ $phone }}">{{ $display }}</a>
@endforeach</div>
<div class="border-t border-line pt-6 max-[640px]:rounded-[10px] max-[640px]:border max-[640px]:p-[21px]"><p class="mb-[15px] text-[11px] font-bold uppercase tracking-[.17em] text-orange">Email Us</p>
<a class="mb-1 block break-words text-[16px] text-navy" href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
<a class="mt-2 inline-flex items-center gap-3 py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ config('site.whatsapp') }}">WhatsApp Us ↗</a>
</div>
<div class="border-t border-line pt-6 max-[640px]:rounded-[10px] max-[640px]:border max-[640px]:p-[21px]"><p class="mb-[15px] text-[11px] font-bold uppercase tracking-[.17em] text-orange">Visit our office</p>
<address class="text-[14px] not-italic text-muted">{{ config('site.address') }}</address>
</div>
</div>
