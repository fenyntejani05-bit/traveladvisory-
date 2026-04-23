<div class="container-xl" style="margin-top: 20px;">

    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">Explore All Hotels</h1>
        <p class="text-muted">Find the perfect place to stay during your trip.</p>
    </div>

    <!-- Grid Hotels -->
    <div class="row g-4">
        <?php foreach($data['hotels'] as $hotel): ?>

        <div class="col-md-6 col-lg-3 mb-5">
            <div class="card card-tour h-100">
                <div class="card-img-wrapper" style="position: relative; overflow: hidden; border-radius: 20px 20px 0 0;">
                    <a href="<?= BASEURL ?>/hotels/detail/<?= $hotel['id'] ?>" class="d-block w-100" style="height: 250px;">
                        <img src="<?= htmlspecialchars($hotel['image_url']) ?>" alt="<?= htmlspecialchars($hotel['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </a>
                    <div class="rating-badge text-warning" style="position: absolute; bottom: 10px; left: 10px; background: white; padding: 5px 10px; border-radius: 20px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <i class="fa-solid fa-star"></i> <?= htmlspecialchars($hotel['rating']) ?>
                        <span class="text-muted fw-normal" style="font-size: 0.8rem;">(<?= htmlspecialchars($hotel['reviews']) ?>)</span>
                    </div>
                </div>

                <div class="card-body pt-4">
                    <h5 class="card-title fw-bold mb-3"><?= htmlspecialchars($hotel['name']) ?></h5>
                    <div class="text-muted small mb-4" style="min-height: 20px;">
                        <span><i class="fa-solid fa-location-dot text-danger"></i> <?= htmlspecialchars($hotel['location']) ?></span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= BASEURL ?>/hotels/detail/<?= $hotel['id'] ?>" class="btn w-100 text-decoration-none" style="background-color: #2caeba; color: white; border-radius: 10px; font-weight: bold;">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
