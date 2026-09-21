<footer class="site-footer">
<div class="container">
<div class="footer-grid">
<div>
<x-brand />
<p>{{ config('site.tagline') }}</p>
<p>Strategic educational solutions for schools, educators and communities.</p>
</div>
<div>
<h2>Explore</h2>
@foreach(['about'=>'About Us', 'team'=>'Our Team', 'programs.index'=>'Programs & Training', 'resources.index'=>'Resources', 'case-studies.index'=>'Case Studies', 'faq'=>'FAQ'] as $route=>$label)<a href="{{ route($route) }}">{{ $label }}</a>
@endforeach</div>
<div>
<h2>Our expertise</h2>
<a href="{{ route('services.index') }}">Education consulting</a>
<a href="{{ route('services.index') }}">Professional development</a>
<a href="{{ route('services.index') }}">School improvement</a>
<a href="{{ route('services.index') }}">Explore all services ↗</a>
<h2 class="footer-subheading">Social channels</h2>
<p>Official links coming soon.</p>
</div>
<div>
<h2>Let's connect</h2>
@foreach(config('site.phones') as $display=>$phone)<a href="tel:{{ $phone }}">{{ $display }}</a>
@endforeach<a class="email-link" href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
<address>{{ config('site.address') }}</address>
<a href="{{ config('site.whatsapp') }}">WhatsApp Us ↗</a>
</div>
</div>
<div class="footer-bottom">
<p>© {{ date('Y') }} The School House Consult. All rights reserved.</p>
<a href="{{ route('contact') }}#consultation">Request a Consultation ↗</a>
</div>
</div>
</footer>
