<div class="container-xl" style="margin-top: 20px;">

    <!-- Header Halaman -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">Explore All Destinations</h1>
        <p class="text-muted">Find hidden paradises and unforgettable experiences with TravelAdvisor.</p>
    </div>

    <!-- Grid Wisata -->
    <div class="row g-4">
        <?php foreach($data['tours'] as $tour): ?>

        <div class="col-md-6 col-lg-3 mb-5">
            <div class="card card-tour h-100">
                <div class="card-img-wrapper" style="position: relative; overflow: hidden; height: 250px;">
                    <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="d-block w-100 h-100">
                        <img src="<?= $tour['image_url'] ?>" alt="<?= $tour['title'] ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </a>

                    <!-- Badge -->
                    <?php if($tour['badge_text']): ?>
                    <div class="card-badge bg-light border fw-bold <?= $tour['badge_class'] ?>">
                        <?= $tour['badge_text'] ?>
                    </div>
                    <?php endif; ?>

                    <div class="card-heart"><i class="fa-regular fa-heart"></i></div>
                    <div class="rating-badge text-warning">
                        <i class="fa-solid fa-star"></i> <?= $tour['rating'] ?>
                        <span class="text-muted fw-normal">(<?= $tour['reviews'] ?> reviews)</span>
                    </div>
                </div>

                <div class="card-body pt-4">
                    <h5 class="card-title fw-bold mb-3"><?= $tour['title'] ?></h5>
                    <div class="d-flex text-muted small gap-3 mb-4">
                        <span><i class="fa-regular fa-clock"></i> <?= $tour['duration'] ?></span>
                        <span><i class="fa-regular fa-user"></i> <?= $tour['guests'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold fs-5"><?= Formatter::currency($tour['price']) ?></span>
                            <span class="text-muted small">/ person</span>
                        </div>

                        <!-- Logic Tombol -->
                        <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>"
                            class="btn-book-now text-decoration-none">
                            Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
