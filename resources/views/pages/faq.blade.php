<x-page-hero eyebrow="Frequently asked questions" title="A little clarity before we connect." text="Find answers about our work and how to start a conversation." />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-[1.6fr_1fr] items-start gap-[85px] max-[1190px]:grid-cols-1 max-[640px]:w-[calc(100%-40px)]">
<div>
@forelse($faqs as $faq)<x-faq-item :faq="$faq" />
@empty<x-empty-state title="Have a question?" text="Contact our team for information about our services." />
@endforelse</div>
<aside class="border-t-[3px] border-t-orange bg-soft p-[34px]"><h2 class="mb-5 text-[29px] font-semibold text-navy">Something else on your mind?</h2>
<p class="mb-[25px] text-[14px] text-muted">Tell us what you would like to know about working with The School House Consult.</p>
<a class="inline-flex min-h-[50px] items-center justify-center gap-6 rounded border border-orange bg-orange px-[23px] py-[15px] text-[13px] font-bold text-[#14233a] hover:bg-[#df6811]" href="{{ route('contact') }}">Contact Us ↗</a>
</aside>
</div>
</section>
