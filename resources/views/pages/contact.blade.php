<x-page-hero eyebrow="Contact us" title="Good things begin with a conversation." text="Have an educational challenge, project or development need? We would like to hear from you." />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
<x-contact-details />
</div>
</section>
<section class="bg-soft py-[92px] max-[640px]:py-12" id="consultation"><div class="mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-[.85fr_1.3fr] items-start gap-[90px] max-[1190px]:grid-cols-1 max-[640px]:w-[calc(100%-40px)]">
<div>
<p class="mb-5 text-[11px] font-bold uppercase tracking-[.17em] text-orange">Request a consultation</p><h2 class="mb-6 text-[clamp(30px,3vw,43px)] font-semibold text-navy">Tell us what you have in mind.</h2><p class="text-[15px] text-muted">Share a little about your organisation and the support you are looking for. Your request will be sent to The School House Consult.</p><div class="mt-[38px] border-t border-[#cfd8e4] pt-[30px]"><x-icon name="chat" class="mb-5 text-[#a44a07]" /><h3 class="mb-[15px] text-[21px] font-semibold text-navy">Prefer a direct conversation?</h3><p class="text-[14px] text-muted">Use our phone numbers, email or WhatsApp to get in touch.</p><a class="mt-4 inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ config('site.whatsapp') }}">WhatsApp Us ↗</a>
</div>
</div>
<livewire:consultation-form />
</div>
</section>
<section class="py-[92px] max-[640px]:py-12" id="message"><div class="mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-[.85fr_1.3fr] items-start gap-[90px] max-[1190px]:grid-cols-1 max-[640px]:w-[calc(100%-40px)]">
<div>
<p class="mb-5 text-[11px] font-bold uppercase tracking-[.17em] text-orange">General enquiries</p><h2 class="mb-6 text-[clamp(30px,3vw,43px)] font-semibold text-navy">Just a quick question?</h2><p class="text-[15px] text-muted">Use this form for general messages and enquiries.</p>
</div>
<livewire:contact-form />
</div>
</section>
