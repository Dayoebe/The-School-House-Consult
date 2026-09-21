<div class="form-panel">
@if($submitted)<div class="success-message" role="status" tabindex="-1" x-init="$el.focus()">
<span class="success-mark" aria-hidden="true">✓</span>
<h3>Your consultation request has been received.</h3>
<p>Thank you for contacting The School House Consult. Your details have been saved for our team to review.</p>
<a class="text-link" href="{{ route('services.index') }}">Explore our services ↗</a>
</div>
@else<form wire:submit="submit" novalidate>
<p class="form-note">Fields marked * are required.</p>
@if($errors->any())<div class="form-error-summary" role="alert" tabindex="-1" x-init="$el.focus()">Please review the highlighted fields below. @error('submission')<p>{{ $message }}</p>
@enderror</div>
@endif<div class="form-grid">
<x-form-field name="full_name" id="consult-name" label="Full Name" required autocomplete="name" maxlength="120" />
<x-form-field name="organisation" id="consult-organisation" label="Organisation / School" autocomplete="organization" maxlength="160" />
<x-form-field name="email" id="consult-email" label="Email" type="email" required autocomplete="email" maxlength="190" />
<x-form-field name="phone" id="consult-phone" label="Phone" type="tel" required autocomplete="tel" maxlength="30" />
<x-form-field name="organisation_type" id="consult-type" label="Organisation Type" type="select" required>
<option value="">Select an organisation type</option>
@foreach(['School / Institution','Educator / School Leader','Community / NGO','Other'] as $option)<option>{{ $option }}</option>
@endforeach</x-form-field>
<x-form-field name="service_id" id="consult-service" label="Service Required" type="select">
<option value="">I'd like some guidance</option>
@foreach($services as $service)<option value="{{ $service->id }}">{{ $service->title }}</option>
@endforeach</x-form-field>
<x-form-field name="message" id="consult-message" label="How can we help?" type="textarea" required wide />
<x-form-field name="preferred_contact_method" id="consult-method" label="Preferred Contact Method" type="select" required wide>
<option>Email</option>
<option>Phone</option>
<option>WhatsApp</option>
</x-form-field>
</div>
<div class="honeypot" aria-hidden="true">
<label for="consult-website">Leave this field empty</label>
<input id="consult-website" type="text" wire:model="website" tabindex="-1" autocomplete="off">
</div>
<p class="privacy-note">Your details are used to handle your enquiry and are not displayed publicly. Please avoid including sensitive learner information.</p>
<button class="button" type="submit" wire:loading.attr="disabled" wire:target="submit">
<span wire:loading.remove wire:target="submit">Send Consultation Request ↗</span>
<span wire:loading wire:target="submit" role="status">Sending your request…</span>
</button>
</form>
@endif</div>
