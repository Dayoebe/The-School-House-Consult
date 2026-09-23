<x-page-hero eyebrow="Our expertise" :title="$record->title" :text="$record->description" />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto grid w-[calc(100%-96px)] max-w-[1240px] grid-cols-[1.6fr_1fr] items-start gap-[85px] max-[1190px]:grid-cols-1 max-[640px]:w-[calc(100%-40px)]"><article class="max-w-[790px] break-words text-muted [&_h2]:mb-5 [&_h2]:mt-[34px] [&_h2]:text-[29px] [&_h2]:font-semibold [&_h2]:text-navy [&_h2:first-of-type]:mt-0 [&_p]:mb-[18px] [&_ul]:my-5 [&_ul]:mb-[30px] [&_ul]:list-disc [&_ul]:pl-6 [&_li]:my-3 [&_li]:pl-2">
<a class="mb-3 inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('services.index') }}">← All services</a>
<h2>Thoughtful support for your context</h2><p>{{ $record->introduction }}</p><h2>What the service involves</h2><ul>
@foreach($record->activities as $activity)<li>{{ $activity }}</li>
@endforeach</ul>
<h2>Who it is for</h2>
<p>{{ $record->audience }}.</p>
</article>
<aside class="border-t-[3px] border-t-orange bg-soft p-[34px]"><span class="mb-6 inline-grid h-[46px] w-[46px] place-items-center rounded bg-[#f5eee7] text-[#ad4f08]">
<x-icon :name="$record->icon" />
</span>
<h2 class="mb-5 text-[29px] font-semibold text-navy">Let's discuss your priorities.</h2><p class="mb-[25px] text-[14px] text-muted">Tell us about your organisation and the support you are looking for.</p>
<a class="inline-flex min-h-[50px] w-full items-center justify-center gap-3 rounded border border-orange bg-orange px-[23px] py-[15px] text-[13px] font-bold text-[#14233a]" href="{{ route('contact', ['service' => $record->id]) }}#consultation">Request a Consultation ↗</a>
<a class="mt-4 inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ config('site.whatsapp') }}">Talk on WhatsApp ↗</a>
</aside>
</div>
</section>
<section class="bg-soft py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]">
<x-section-heading eyebrow="Explore further" title="Related areas of support" />
<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-2 max-[640px]:grid-cols-1">
@foreach($services->where('id', '!=', $record->id)->take(3) as $service)<x-service-card :service="$service" />
@endforeach</div>
</div>
</section>
<x-cta />
