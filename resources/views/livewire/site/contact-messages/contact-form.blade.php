<div>
    @if($submitted)
        <div class="contact-success-card">
            <div class="contact-success-icon">
                <i class="bi bi-check2-circle"></i>
            </div>

            <h3>{{ __('site.contact_success_title') }}</h3>
            <p>{{ __('site.contact_success_text') }}</p>

            <button type="button" wire:click="$set('submitted', false)" class="btn btn-success">
                {{ __('site.send_another_message') }}
            </button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="contact-form-card">
            <div class="contact-form-header">
                <span>{{ __('site.contact') }}</span>
                <h2>{{ __('site.contact_form_title') }}</h2>
                <p>{{ __('site.contact_form_subtitle') }}</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">{{ __('site.contact_name') }} *</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.contact_email') }}</label>
                    <input type="email" wire:model.defer="email" class="form-control">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.contact_phone') }}</label>
                    <input type="text" wire:model.defer="phone" class="form-control">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.contact_company') }}</label>
                    <input type="text" wire:model.defer="company" class="form-control">
                    @error('company') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.contact_subject') }}</label>
                    <input type="text" wire:model.defer="subject" class="form-control">
                    @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.preferred_contact_method') }}</label>
                    <select wire:model.defer="preferred_contact_method" class="form-select">
                        <option value="">{{ __('site.select_contact_method') }}</option>
                        <option value="phone">{{ __('site.contact_method_phone') }}</option>
                        <option value="email">{{ __('site.contact_method_email') }}</option>
                        <option value="whatsapp">{{ __('site.contact_method_whatsapp') }}</option>
                    </select>
                    @error('preferred_contact_method') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">{{ __('site.contact_message') }} *</label>
                    <textarea wire:model.defer="message" class="form-control" rows="5"></textarea>
                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success contact-submit-btn" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            {{ __('site.send_message') }}
                            <i class="bi bi-arrow-right"></i>
                        </span>

                        <span wire:loading>
                            {{ __('site.sending') }}
                        </span>
                    </button>
                </div>
            </div>
        </form>
    @endif
</div>