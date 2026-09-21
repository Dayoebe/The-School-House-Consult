<x-page-hero eyebrow="Our expertise" :title="$record->title" :text="$record->description" />
<section class="section">
<div class="container detail-grid">
<article class="prose">
<a class="text-link back-link" href="{{ route('services.index') }}">← All services</a>
<h2>Thoughtful support for your context</h2>
<p>{{ $record->introduction }}</p>
<h2>What the service involves</h2>
<ul>
@foreach($record->activities as $activity)<li>{{ $activity }}</li>
@endforeach</ul>
<h2>Who it is for</h2>
<p>{{ $record->audience }}.</p>
</article>
<aside class="enquiry-card">
<span class="icon-box">
<x-icon :name="$record->icon" />
</span>
<h2>Let's discuss your priorities.</h2>
<p>Tell us about your organisation and the support you are looking for.</p>
<a class="button" href="{{ route('contact', ['service' => $record->id]) }}#consultation">Request a Consultation ↗</a>
<a class="text-link" href="{{ config('site.whatsapp') }}">Talk on WhatsApp ↗</a>
</aside>
</div>
</section>
<section class="section section-soft">
<div class="container">
<x-section-heading eyebrow="Explore further" title="Related areas of support" />
<div class="grid-three">
@foreach($services->where('id', '!=', $record->id)->take(3) as $service)<x-service-card :service="$service" />
@endforeach</div>
</div>
</section>
<x-cta />
