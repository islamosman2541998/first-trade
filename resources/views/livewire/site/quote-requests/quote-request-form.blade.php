<div>
    @if($submitted)
        <div class="quote-success-card">
            <div class="quote-success-icon">
                <i class="bi bi-check2-circle"></i>
            </div>

            <h3>{{ __('site.quote_success_title') }}</h3>
            <p>{{ __('site.quote_success_text') }}</p>

            <a href="{{ route('site.products.index') }}" class="btn btn-success">
                {{ __('site.view_all_products') }}
            </a>
        </div>
    @else
        <form wire:submit.prevent="submit" class="quote-form-card">
            <div class="quote-form-header">
                <span>{{ __('site.request_quote') }}</span>
                <h2>{{ __('site.quote_form_title') }}</h2>
                <p>{{ __('site.quote_form_subtitle') }}</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_name') }} *</label>
                    <input type="text" wire:model.defer="name" class="form-control">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_phone') }} *</label>
                    <input type="text" wire:model.defer="phone" class="form-control">
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_email') }}</label>
                    <input type="email" wire:model.defer="email" class="form-control">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_company') }}</label>
                    <input type="text" wire:model.defer="company" class="form-control">
                    @error('company') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_country') }}</label>
                    <input type="text" wire:model.defer="country" class="form-control">
                    @error('country') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_category') }}</label>
                    <select wire:model.defer="category_id" class="form-select">
                        <option value="">{{ __('site.select_category') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->parent ? $category->parent->name . ' / ' : '' }}{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_product') }}</label>
                    <select wire:model.live="product_id" class="form-select">
                        <option value="">{{ __('site.select_product') }}</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_product_name') }}</label>
                    <input type="text" wire:model.defer="product_name" class="form-control">
                    @error('product_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_quantity') }}</label>
                    <input type="text" wire:model.defer="quantity" class="form-control" placeholder="{{ __('site.quote_quantity_placeholder') }}">
                    @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('site.quote_attachment') }}</label>
                    <input type="file" wire:model="attachment" class="form-control">
                    <div class="small text-muted mt-1">{{ __('site.quote_attachment_hint') }}</div>
                    <div wire:loading wire:target="attachment" class="small text-muted mt-1">
                        {{ __('site.uploading_file') }}
                    </div>
                    @error('attachment') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">{{ __('site.quote_message') }}</label>
                    <textarea wire:model.defer="message" class="form-control" rows="5"></textarea>
                    @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success quote-submit-btn" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            {{ __('site.send_quote_request') }}
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