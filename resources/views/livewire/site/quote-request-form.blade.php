<form wire:submit.prevent="submit" class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Product</label>
        <select wire:model.defer="product_id" class="form-select">
            <option value="">Select Product</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
        @error('product_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" wire:model.defer="name" class="form-control">
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Company</label>
        <input type="text" wire:model.defer="company" class="form-control">
        @error('company') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Country</label>
        <input type="text" wire:model.defer="country" class="form-control">
        @error('country') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" wire:model.defer="email" class="form-control">
        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" wire:model.defer="phone" class="form-control">
        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Quantity</label>
        <input type="text" wire:model.defer="quantity" class="form-control" placeholder="Example: 1 container / 500 kg">
        @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Message</label>
        <textarea wire:model.defer="message" rows="5" class="form-control"></textarea>
        @error('message') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
            <span wire:loading.remove>Send Request</span>
            <span wire:loading>Sending...</span>
        </button>
    </div>
</form>