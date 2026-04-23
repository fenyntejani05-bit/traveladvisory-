<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Transparent Navbar Hook (Assuming style.css handles this if needed) -->
<style>
    .navbar { background-color: rgba(255,255,255,0.95) !important; position: sticky; top: 0; z-index: 1000; }
</style>

<main class="bg-light min-vh-100">
    <!-- Immersive Hero Image Header -->
    <div class="position-relative w-100" style="height: 50vh; min-height: 400px; overflow: hidden;">
        <img src="<?= htmlspecialchars($data['activity']['image_url'] ?? 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62') ?>" 
             alt="<?= htmlspecialchars($data['activity']['title']) ?>" 
             class="w-100 h-100 object-fit-cover" 
             style="filter: brightness(0.7);">
        
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);"></div>
        
        <div class="position-absolute bottom-0 start-0 w-100 pb-5">
            <div class="container-fluid px-4 px-lg-5">
                <span class="badge bg-white text-dark mb-3 px-3 py-2 rounded-pill shadow-sm"><i class="fa-solid fa-location-dot me-2 text-danger"></i><?= htmlspecialchars($data['activity']['location']) ?></span>
                <h1 class="display-4 fw-bold text-white mb-2" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"><?= htmlspecialchars($data['activity']['title']) ?></h1>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="container mt-5 py-4 mb-5">
        <div class="row g-5">
            <!-- Main Details -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4">
                    <h3 class="fw-bold mb-4">About the Experience</h3>
                    <p class="lead text-muted lh-lg">
                        <?= nl2br(htmlspecialchars($data['activity']['description'])) ?>
                    </p>
                    
                    <div class="row g-4 mt-4 border-top pt-4">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-clock text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Duration</h6>
                                    <small class="text-muted">Flexible / Half-Day</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-user-group text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Group Size</h6>
                                    <small class="text-muted">Private or Shared</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-camera text-primary fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Highlights</h6>
                                    <small class="text-muted">Photo Opportunities</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
