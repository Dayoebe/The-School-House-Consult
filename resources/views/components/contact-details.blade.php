<div class="contact-details">
<div>
<p class="eyebrow">Call Us</p>
@foreach(config('site.phones') as $display=>$phone)<a href="tel:{{ $phone }}">{{ $display }}</a>
@endforeach</div>
<div>
<p class="eyebrow">Email Us</p>
<a class="email-link" href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
<a class="text-link" href="{{ config('site.whatsapp') }}">WhatsApp Us ↗</a>
</div>
<div>
<p class="eyebrow">Visit our office</p>
<address>{{ config('site.address') }}</address>
</div>
</div>
