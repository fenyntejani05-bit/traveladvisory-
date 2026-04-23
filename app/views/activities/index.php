<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="py-5 bg-light min-vh-100">
    <div class="container-fluid px-4 px-lg-5 mt-5">
        <div class="d-flex justify-content-between align-items-end border-bottom pb-4 mb-4">
            <div>
                <h1 class="display-5 fw-bold text-dark mb-2">All Activities</h1>
                <p class="text-muted mb-0 lead">Discover unique and unforgettable experiences</p>
            </div>
            
            <div class="d-none d-md-block">
                <?php
                    $activityLocs = [];
                    foreach($data['activities'] as $act) {
                        if (!empty($act['location']) && !in_array($act['location'], $activityLocs)) {
                            $activityLocs[] = $act['location'];
                        }
                    }
                ?>
                <select id="activityLocationFilterPage" class="form-select border rounded-pill shadow-sm px-4 py-2 fw-bold" style="min-width: 250px;" onchange="filterPageActivities(this.value)">
                    <option value="all">Filter by Place...</option>
                    <?php foreach($activityLocs as $loc): ?>
                        <option value="<?= htmlspecialchars($loc) ?>"><?= htmlspecialchars($loc) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Mobile Filter -->
        <div class="d-md-none mb-4">
            <select id="activityLocationFilterMobile" class="form-select border rounded-pill shadow-sm px-4 py-2 fw-bold w-100" onchange="filterPageActivities(this.value)">
                <option value="all">Filter by Place...</option>
                <?php foreach($activityLocs as $loc): ?>
                    <option value="<?= htmlspecialchars($loc) ?>"><?= htmlspecialchars($loc) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row g-4" id="activitiesGrid">
            <?php foreach($data['activities'] as $index => $activity): ?>
            <?php 
                $colors = ['promo-blue', 'promo-pink'];
                $colorClass = $colors[$index % count($colors)];
            ?>
            <div class="col-12 col-md-6 col-lg-4 page-activity-item" data-location="<?= htmlspecialchars($activity['location'] ?? 'all') ?>">
                <div class="promo-card <?= $colorClass ?> h-100 position-relative overflow-hidden shadow-sm" style="min-height: 280px; border-radius: 1.25rem;">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div>
                            <span class="badge bg-white text-dark mb-3 position-relative" style="z-index: 2;"><i class="fa-solid fa-location-dot me-1"></i><?= htmlspecialchars($activity['location']) ?></span>
                            <h3 class="promo-title position-relative" style="z-index: 2; font-size: 1.6rem; line-height: 1.3; max-width: 70%;"><?= htmlspecialchars($activity['title']) ?></h3>
                            <p class="text-white position-relative mt-2" style="z-index: 2; max-width: 65%; font-size: 0.95rem; opacity: 0.9; text-shadow: 1px 1px 3px rgba(0,0,0,0.3);"><?= htmlspecialchars($activity['description']) ?></p>
                        </div>
                        <div class="mt-auto pt-3">
                            <a href="<?= BASEURL ?>/activities/detail/<?= $activity['id'] ?>" class="btn-yellow-cta position-relative" style="z-index: 2; display: inline-flex;">Details <i class="fa-solid fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>

                    <img src="<?= htmlspecialchars($activity['image_url']) ?>"
                        class="promo-img-deco"
                        style="right: -40px; height: 100%; top: 0; width: 60%; mask-image: linear-gradient(to left, black 50%, transparent 100%); -webkit-mask-image: linear-gradient(to left, black 60%, transparent 100%); object-fit: cover;"
                        alt="<?= htmlspecialchars($activity['title']) ?>">
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if(empty($data['activities'])): ?>
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">No activities found.</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <script>
    function filterPageActivities(location) {
        const items = document.querySelectorAll('.page-activity-item');
        items.forEach(item => {
            if (location === 'all' || item.getAttribute('data-location') === location) {
                item.classList.remove('d-none');
            } else {
                item.classList.add('d-none');
            }
        });
    }
    </script>
</main>

<style>
.promo-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.promo-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
