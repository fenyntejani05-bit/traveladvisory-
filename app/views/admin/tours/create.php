<div class="row justify-content-center">
    <div class="col-lg-8">
        <h1 class="fw-bold h3 mb-4"><?= $data['page_title']; ?></h1>
        
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="<?= BASEURL; ?>/admin/storeTour" method="POST">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Tour Name</label>
                        <input type="text" name="title" class="form-control" placeholder="Example: Beautiful Bali Beach" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Location</label>
                            <input type="text" name="location" class="form-control" placeholder="Bali, Indonesia" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Price (₹)</label>
                            <input type="number" name="price" class="form-control" placeholder="500000" min="0" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Duration</label>
                            <input type="text" name="duration" class="form-control" placeholder="3 Days 2 Nights" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small">Capacity</label>
                            <input type="text" name="guests" class="form-control" placeholder="2-4 People" pattern="[0-9].*" title="Capacity must start with a number and cannot be negative" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Image URL</label>
                        <input type="url" name="image_url" class="form-control" placeholder="https://..." required>
                        <div class="form-text">Enter image link from the internet (Unsplash/Google)</div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="<?= BASEURL; ?>/admin/tours" class="btn btn-light rounded-pill px-4">Cancel</a>
                        <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">Save Data</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>