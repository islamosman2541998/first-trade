<form wire:submit.prevent="submit" class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" wire:model.defer="name" class="form-control">
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
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
        <label class="form-label">Subject</label>
        <input type="text" wire:model.defer="subject" class="form-control">
        @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Message</label>
        <textarea wire:model.defer="message" rows="5" class="form-control"></textarea>
        @error('message') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success" wire:loading.attr="disabled">
            <span wire:loading.remove>Send Message</span>
            <span wire:loading>Sending...</span>
        </button>
    </div>
</form>