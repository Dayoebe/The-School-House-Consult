<div class="rounded border border-line bg-white p-[35px] max-[640px]:rounded-xl max-[640px]:p-[23px_20px]"><form wire:submit="submit" novalidate>
@if($submitted)<div class="py-[25px]" role="status" tabindex="-1" x-init="$el.focus()"><span class="grid h-12 w-12 place-items-center rounded-full bg-[#e3f3e9] text-[22px] text-[#176d3e]" aria-hidden="true">✓</span><h3 class="my-5 mb-[18px] text-[22px] font-semibold text-navy">Your consultation request has been received.</h3><p class="text-[14px] text-muted">Thank you for contacting The School House Consult. Your details have been saved for our team to review.</p><a class="mt-4 inline-flex items-center gap-[22px] py-2 text-[13px] font-bold text-navy hover:text-orange" href="{{ route('services.index') }}">Explore our services ↗</a>
</div>
@else
<p class="mb-6 text-[11px] text-muted">Fields marked * are required.</p>
@if($errors->any())<div class="mb-[25px] border-l-[3px] border-[#b42318] bg-[#fff1ee] p-4 text-[13px] text-[#932318]" role="alert" tabindex="-1" x-init="$el.focus()">Please review the highlighted fields below. @error('submission')<p class="text-inherit">{{ $message }}</p>
@enderror</div>
@endif<div class="grid grid-cols-2 gap-x-5 gap-y-[22px] max-[640px]:grid-cols-1">
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
<div class="absolute h-px w-px overflow-hidden [clip-path:inset(50%)]" aria-hidden="true">
<label for="consult-website">Leave this field empty</label>
<input id="consult-website" type="text" wire:model="website" tabindex="-1" autocomplete="off">
</div>
<p class="my-6 text-[11px] text-[#626d7d]">Your details are used to handle your enquiry and are not displayed publicly. Please avoid including sensitive learner information.</p>
<button class="inline-flex min-h-[50px] items-center justify-center gap-6 rounded border border-orange bg-orange px-[23px] py-[15px] text-[13px] font-bold text-[#14233a] disabled:opacity-65" type="submit" wire:loading.attr="disabled" wire:target="submit">
<span wire:loading.remove wire:target="submit"><i class="fa-solid fa-paper-plane mr-2" aria-hidden="true"></i> Send Consultation Request</span>
<span wire:loading wire:target="submit" role="status">Sending your request…</span>
</button>
</form>@endif</div>
