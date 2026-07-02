<div>
    <div class="card admin-card">
        <div class="card-header bg-white d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div>
                <strong>Product Gallery</strong>
                <div class="small text-muted">
                    Upload extra images for this product.
                </div>
            </div>
        </div>

        <div class="card-body">
            <form wire:submit.prevent="uploadImages" enctype="multipart/form-data">
                <div class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label class="form-label">Gallery Images</label>
                        <input type="file" wire:model="images" class="form-control" multiple>

                        @error('images')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        @error('images.*')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror

                        <div wire:loading wire:target="images" class="small text-muted mt-2">
                            Uploading...
                        </div>
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-admin-primary w-100" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="uploadImages">
                                <i class="bi bi-upload"></i> Upload Images
                            </span>

                            <span wire:loading wire:target="uploadImages">
                                Uploading...
                            </span>
                        </button>
                    </div>
                </div>

                @if($images)
                    <div class="row g-3 mt-3">
                        @foreach($images as $preview)
                            <div class="col-6 col-md-3 col-lg-2">
                                <img src="{{ $preview->temporaryUrl() }}"
                                     class="rounded w-100"
                                     style="height: 120px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endif
            </form>

            <hr class="my-4">

            <div class="row g-4">
                @forelse($galleryImages as $galleryImage)
                    <div class="col-md-4 col-lg-3" wire:key="gallery-image-{{ $galleryImage->id }}">
                        <div class="gallery-card">
                            <div class="gallery-image-wrap">
                                <img src="{{ asset($galleryImage->image) }}" alt="Product gallery image">

                                @if($product->main_image === $galleryImage->image)
                                    <span class="gallery-main-badge">
                                        Main
                                    </span>
                                @endif
                            </div>

                            <div class="gallery-card-body">
                                <label class="form-label small mb-1">Sort Order</label>

                                <input type="number"
                                       class="form-control form-control-sm"
                                       value="{{ $galleryImage->sort_order }}"
                                       wire:change="updateSortOrder({{ $galleryImage->id }}, $event.target.value)">

                                <div class="d-flex gap-2 mt-3">
                                    <button type="button"
                                            class="btn btn-sm btn-outline-success flex-fill"
                                            wire:click="setAsMainImage({{ $galleryImage->id }})">
                                        Main
                                    </button>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            wire:click="deleteImage({{ $galleryImage->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted py-4">
                            No gallery images yet.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>