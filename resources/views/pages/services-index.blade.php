<x-page-hero eyebrow="Our services" title="Expertise for the work ahead." text="From curriculum and classroom practice to people, policy and planning — explore our areas of educational support." />
<section class="py-[92px] max-[640px]:py-12"><div class="mx-auto w-[calc(100%-96px)] max-w-[1240px] max-[640px]:w-[calc(100%-40px)]"><div class="mb-9 flex items-center justify-between gap-9 max-[640px]:block">
<x-section-heading eyebrow="Our areas of expertise" title="Where can we support you?" />
<p class="max-w-[300px] text-[14px] text-muted max-[640px]:mt-[18px]">Start with a service, or talk to us about your wider educational needs.</p>
</div>
<div class="grid grid-cols-3 gap-6 max-[767px]:grid-cols-1">
@foreach($services as $service)<x-service-card :service="$service" />
@endforeach</div>
</div>
</section>
<x-cta />
