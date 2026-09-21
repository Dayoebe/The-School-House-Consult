<x-page-hero eyebrow="Frequently asked questions" title="A little clarity before we connect." text="Find answers about our work and how to start a conversation." />
<section class="section">
<div class="container detail-grid">
<div>
@forelse($faqs as $faq)<x-faq-item :faq="$faq" />
@empty<x-empty-state title="Have a question?" text="Contact our team for information about our services." />
@endforelse</div>
<aside class="enquiry-card">
<h2>Something else on your mind?</h2>
<p>Tell us what you would like to know about working with The School House Consult.</p>
<a class="button" href="{{ route('contact') }}">Contact Us ↗</a>
</aside>
</div>
</section>
