<?php

namespace App\Livewire;

use App\Models\ConsultationRequest;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Throwable;

class ConsultationForm extends Component
{
    public string $full_name = '';

    public string $organisation = '';

    public string $email = '';

    public string $phone = '';

    public string $organisation_type = '';

    public string $service_id = '';

    public string $message = '';

    public string $preferred_contact_method = 'Email';

    public string $website = '';

    #[Locked]
    public bool $submitted = false;

    public function mount(): void
    {
        $service = request()->query('service');
        if (is_scalar($service) && ctype_digit((string) $service) && Service::published()->whereKey($service)->exists()) {
            $this->service_id = (string) $service;
        }
    }

    public function submit(): void
    {
        if ($this->submitted) {
            return;
        }
        if ($this->website !== '') {
            $this->addError('submission', 'We could not process this request. Please contact us by phone or email.');

            return;
        }
        foreach (['full_name', 'organisation', 'email', 'phone', 'message'] as $field) {
            $this->$field = trim($this->$field);
        }
        $validated = $this->validate([
            'full_name' => ['required', 'string', 'min:2', 'max:120'],
            'organisation' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^\+?[0-9 ()-]{7,30}$/'],
            'organisation_type' => ['required', Rule::in(['School / Institution', 'Educator / School Leader', 'Community / NGO', 'Other'])],
            'service_id' => ['nullable', 'integer', Rule::exists('services', 'id')->where('is_active', true)],
            'message' => ['required', 'string', 'min:20', 'max:5000'],
            'preferred_contact_method' => ['required', Rule::in(['Email', 'Phone', 'WhatsApp'])],
        ]);
        $key = 'public-enquiries:'.hash('sha256', (string) request()->ip());
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('submission', 'Too many requests. Please try again in '.RateLimiter::availableIn($key).' seconds, or contact us directly.');

            return;
        }
        RateLimiter::hit($key, 600);
        $validated['service_id'] = $validated['service_id'] ?: null;
        try {
            ConsultationRequest::create($validated);
        } catch (Throwable $exception) {
            report($exception);
            $this->addError('submission', 'Your request could not be saved. Please try again or contact us by phone or email.');

            return;
        }
        $this->reset(['full_name', 'organisation', 'email', 'phone', 'organisation_type', 'service_id', 'message']);
        $this->submitted = true;
    }

    public function render(): View
    {
        return view('livewire.consultation-form', ['services' => Service::published()->orderBy('sort_order')->get()]);
    }
}
