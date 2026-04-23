<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="py-5 bg-light">
    <div class="container-fluid px-4 px-lg-5 mt-5">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold text-dark mb-3">Your Personalized Trip Plan</h1>
                <p class="lead text-muted">We have curated these recommendations based on your preferences: 
                    <strong><?= $data['preferences']['climate'] ?></strong> climate, 
                    <strong><?= $data['preferences']['budget'] ?></strong> budget, 
                    <strong><?= $data['preferences']['activity'] ?></strong> activity, 
                    for dates <strong><?= $data['preferences']['date_range_display'] ?></strong>.
                </p>
                
                <div class="mt-4 p-4 bg-white shadow-sm rounded-4 text-start">
                    <form action="<?= BASEURL ?>/tours/plan" method="POST">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <div class="d-flex text-muted small fw-bold mb-1">
                                    <div style="width: 45%;">Departure (From)</div>
                                    <div style="width: 55%; padding-left: 0.5rem;">Return (To)</div>
                                </div>
                                <div class="input-group align-items-center">
                                    <span class="input-group-text bg-white border-0 ps-0"><i
                                            class="fa-regular fa-calendar text-muted"></i></span>
                                    <input type="date" name="start_date" class="form-control border-0 fw-bold shadow-none p-0 mx-1 text-muted" style="width: auto; min-width: 0;"
                                        value="<?= substr($data['preferences']['date_range'], 0, 10) ?>" required>
                                    <span class="fw-bold text-muted mx-1">-</span>
                                    <input type="date" name="end_date" class="form-control border-0 fw-bold shadow-none p-0 mx-1 text-muted" style="width: auto; min-width: 0;"
                                        value="<?= substr($data['preferences']['date_range'], -10) ?>" required>
                                </div>
                                <div class="border-bottom mt-2"></div>
                            </div>
            
                            <div class="col-md-2">
                                <label class="form-label text-muted small fw-bold">Climate</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-0 ps-0"><i
                                            class="fa-solid fa-cloud-sun text-muted"></i></span>
                                    <select name="climate" class="form-select border-0 fw-bold shadow-none p-0">
                                        <option value="">Any</option>
                                        <option value="Tropical" <?= $data['preferences']['climate'] == 'Tropical' ? 'selected' : '' ?>>Tropical</option>
                                        <option value="Moderate" <?= $data['preferences']['climate'] == 'Moderate' ? 'selected' : '' ?>>Moderate</option>
                                        <option value="Cold" <?= $data['preferences']['climate'] == 'Cold' ? 'selected' : '' ?>>Cold</option>
                                    </select>
                                </div>
                                <div class="border-bottom mt-2"></div>
                            </div>
            
                            <div class="col-md-2">
                                <label class="form-label text-muted small fw-bold">Budget</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-0 ps-0"><i
                                            class="fa-solid fa-wallet text-muted"></i></span>
                                    <select name="budget" class="form-select border-0 fw-bold shadow-none p-0">
                                        <option value="">Any</option>
                                        <option value="Low" <?= $data['preferences']['budget'] == 'Low' ? 'selected' : '' ?>>Low</option>
                                        <option value="Medium" <?= $data['preferences']['budget'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                                        <option value="High" <?= $data['preferences']['budget'] == 'High' ? 'selected' : '' ?>>High</option>
                                    </select>
                                </div>
                                <div class="border-bottom mt-2"></div>
                            </div>
            
                            <div class="col-md-2">
                                <label class="form-label text-muted small fw-bold">Activity</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-0 ps-0"><i
                                            class="fa-solid fa-person-hiking text-muted"></i></span>
                                    <select name="activity" class="form-select border-0 fw-bold shadow-none p-0">
                                        <option value="">Any</option>
                                        <option value="Relaxing" <?= $data['preferences']['activity'] == 'Relaxing' ? 'selected' : '' ?>>Relaxing</option>
                                        <option value="Adventure" <?= $data['preferences']['activity'] == 'Adventure' ? 'selected' : '' ?>>Adventure</option>
                                        <option value="Heritage" <?= $data['preferences']['activity'] == 'Heritage' ? 'selected' : '' ?>>Heritage</option>
                                        <option value="Wildlife" <?= $data['preferences']['activity'] == 'Wildlife' ? 'selected' : '' ?>>Wildlife</option>
                                    </select>
                                </div>
                                <div class="border-bottom mt-2"></div>
                            </div>
            
                            <div class="col-md-2">
                                <button type="submit" class="btn w-100 rounded-pill py-2 fw-bold" style="background-color: #2caeba; color: white;">
                                    <i class="fa-solid fa-filter me-2"></i> Apply Filters
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>

        <?php if (empty($data['tours'])): ?>
            <div class="row">
                <div class="col-12 text-center py-5">
                    <div class="mb-4">
                        <i class="fa-solid fa-face-frown text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="text-muted">No exact matches found</h3>
                    <p class="text-secondary">Try adjusting your preferences (e.g. choose "Any" for some constraints). In the meantime, here are some suggested popular destinations!</p>
                </div>
            </div>

            <?php if (!empty($data['suggested_tours'])): ?>
                <div class="row g-4 mt-2 border-top pt-4">
                    <h4 class="fw-bold mb-3">Popular Suggestions</h4>
                    <?php foreach ($data['suggested_tours'] as $tour): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-tour h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative transition-hover">
                                <?php if ($tour['badge_text']): ?>
                                    <div class="position-absolute top-0 end-0 m-3 z-index-1">
                                        <span class="badge bg-white shadow-sm px-3 py-2 rounded-pill <?= $tour['badge_class'] ?>">
                                            <?= $tour['badge_text'] ?>
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <div class="tour-img-wrapper" style="height: 250px; overflow: hidden;">
                                    <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="d-block w-100 h-100">
                                        <img src="<?= $tour['image_url'] ?>" class="w-100 h-100 object-fit-cover" alt="<?= $tour['title'] ?>">
                                    </a>
                                </div>

                                <div class="card-body p-4">
                                     <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-light text-primary border rounded-pill px-3 py-1">
                                            <i class="fa-solid fa-cloud-sun me-1"></i><?= $tour['climate'] ?: 'Any' ?>
                                        </span>
                                        <div class="d-flex text-warning align-items-center">
                                            <i class="fa-solid fa-star me-1"></i>
                                            <span class="text-dark fw-bold"><?= $tour['rating'] ?></span>
                                            <span class="text-muted ms-1">(<?= $tour['reviews'] ?>)</span>
                                        </div>
                                    </div>

                                    <h5 class="card-title fw-bold mb-1"><?= $tour['title'] ?></h5>
                                    <p class="text-muted small mb-3">
                                        <i class="fa-solid fa-location-dot me-1"></i> <?= $tour['location'] ?>
                                    </p>

                                    <div class="d-flex justify-content-between text-muted small mb-3">
                                        <span><i class="fa-regular fa-clock me-1"></i> <?= $tour['duration'] ?></span>
                                        <span><i class="fa-solid fa-wallet me-1"></i> <?= $tour['budget'] ?> Budget</span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <div>
                                            <span class="text-muted small d-block">Start from</span>
                                            <span class="text-primary fw-bold fs-5"><?= Formatter::currency($tour['price']) ?></span>
                                        </div>
                                        <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="btn btn-outline-primary rounded-pill px-4">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($data['tours'] as $tour): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-tour h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative transition-hover">
                            <?php if ($tour['badge_text']): ?>
                                <div class="position-absolute top-0 end-0 m-3 z-index-1">
                                    <span class="badge bg-white shadow-sm px-3 py-2 rounded-pill <?= $tour['badge_class'] ?>">
                                        <?= $tour['badge_text'] ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <div class="tour-img-wrapper" style="height: 250px; overflow: hidden;">
                                <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="d-block w-100 h-100">
                                    <img src="<?= $tour['image_url'] ?>" class="w-100 h-100 object-fit-cover" alt="<?= $tour['title'] ?>">
                                </a>
                            </div>

                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-light text-primary border rounded-pill px-3 py-1">
                                        <i class="fa-solid fa-cloud-sun me-1"></i><?= $tour['climate'] ?: 'Any' ?>
                                    </span>
                                    <div class="d-flex text-warning align-items-center">
                                        <i class="fa-solid fa-star me-1"></i>
                                        <span class="text-dark fw-bold"><?= $tour['rating'] ?></span>
                                        <span class="text-muted ms-1">(<?= $tour['reviews'] ?>)</span>
                                    </div>
                                </div>

                                <h5 class="card-title fw-bold mb-1"><?= $tour['title'] ?></h5>
                                <p class="text-muted small mb-3">
                                    <i class="fa-solid fa-location-dot me-1"></i> <?= $tour['location'] ?>
                                </p>

                                <div class="d-flex justify-content-between text-muted small mb-3">
                                    <span><i class="fa-regular fa-clock me-1"></i> <?= $tour['duration'] ?></span>
                                    <span><i class="fa-solid fa-wallet me-1"></i> <?= $tour['budget'] ?> Budget</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div>
                                        <span class="text-muted small d-block">Start from</span>
                                        <span class="text-primary fw-bold fs-5"><?= Formatter::currency($tour['price']) ?></span>
                                    </div>
                                    <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="btn btn-outline-primary rounded-pill px-4">
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<style>
.transition-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.transition-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
