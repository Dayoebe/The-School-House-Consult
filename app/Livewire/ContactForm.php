<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Throwable;

class ContactForm extends Component
{
    public string $full_name = '';

    public string $email = '';

    public string $subject = '';

    public string $message = '';

    public string $website = '';

    #[Locked]
    public bool $submitted = false;

    public function submit(): void
    {
        if ($this->submitted) {
            return;
        }
        if ($this->website !== '') {
            $this->addError('submission', 'We could not process this message. Please contact us directly.');

            return;
        }
        foreach (['full_name', 'email', 'subject', 'message'] as $field) {
            $this->$field = trim($this->$field);
        }
        $validated = $this->validate([
            'full_name' => ['required', 'string', 'min:2', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'subject' => ['required', 'string', 'min:3', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ]);
        $key = 'public-enquiries:'.hash('sha256', (string) request()->ip());
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('submission', 'Too many messages. Please try again in '.RateLimiter::availableIn($key).' seconds, or contact us directly.');

            return;
        }
        RateLimiter::hit($key, 600);
        try {
            ContactMessage::create($validated);
        } catch (Throwable $exception) {
            report($exception);
            $this->addError('submission', 'Your message could not be saved. Please try again or contact us by phone or email.');

            return;
        }
        $this->reset(['full_name', 'email', 'subject', 'message']);
        $this->submitted = true;
    }

    public function render(): View
    {
        return view('livewire.contact-form');
    }
}
