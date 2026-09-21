<x-page-hero eyebrow="Programs & Training" :title="$record->title" text="Explore this professional learning opportunity." />
<section class="section">
<div class="container detail-grid">
<article class="prose">
<a class="text-link back-link" href="{{ route('programs.index') }}">← All programs</a>
@if($record->featured_image)<img class="detail-image" src="{{ asset($record->featured_image) }}" alt="{{ $record->title }}">
@endif<h2>About this program</h2>
<div class="plain-content">{{ $record->description }}</div>
@if($record->target_audience)<h2>Who it is for</h2>
<p>{{ $record->target_audience }}</p>
@endif @if($record->duration)<h2>Duration</h2>
<p>{{ $record->duration }}</p>
@endif</article>
<aside class="enquiry-card">
<h2>Interested in this program?</h2>
<p>Contact us to discuss availability and participation.</p>
<a class="button" href="{{ route('contact') }}#consultation">Enquire about training ↗</a>
</aside>
</div>
</section>
