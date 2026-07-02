<?php

namespace App\Livewire\Site\ContactMessages;

use App\Models\ContactMessage;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $company = null;
    public ?string $subject = null;
    public string $message = '';
    public ?string $preferred_contact_method = null;

    public bool $submitted = false;

    public function submit(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:5'],
            'preferred_contact_method' => ['nullable', 'in:phone,email,whatsapp'],
        ], [], [
            'name' => __('site.contact_name'),
            'email' => __('site.contact_email'),
            'phone' => __('site.contact_phone'),
            'company' => __('site.contact_company'),
            'subject' => __('site.contact_subject'),
            'message' => __('site.contact_message'),
            'preferred_contact_method' => __('site.preferred_contact_method'),
        ]);

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'subject' => $this->subject,
            'message' => $this->message,
            'preferred_contact_method' => $this->preferred_contact_method,
            'status' => ContactMessage::STATUS_NEW,
        ]);

        $this->reset([
            'name',
            'email',
            'phone',
            'company',
            'subject',
            'message',
            'preferred_contact_method',
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.site.contact-messages.contact-form');
    }
}