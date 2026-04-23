<?php
require_once __DIR__ . '/../../helpers/Formatter.php';

$category = $data['category'];
$tours = $data['tours'];
?>

<div class="category-show-container">
    <!-- Header Section -->
    <div class="category-show-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container-fluid px-4 px-lg-5">
            <a href="<?= BASEURL ?>/category" class="btn-back-white">
                <i class="fas fa-arrow-left"></i>
                Back to Categories
            </a>
            <div class="category-show-content">
                <div class="category-show-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="category-show-info">
                    <h1 class="category-show-title"><?= htmlspecialchars($category['name']) ?></h1>
                    <?php if (!empty($category['description'])): ?>
                        <p class="category-show-description"><?= htmlspecialchars($category['description']) ?></p>
                    <?php endif; ?>
                    <div class="category-show-stats">
                        <span class="stat-item">
                            <i class="fas fa-suitcase"></i>
                            <?= $data['tour_count'] ?> Tours Available
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4 px-lg-5">
        <?php if (empty($tours)): ?>
            <!-- Empty State -->
            <div class="empty-tours-container">
                <div class="empty-tours">
                    <div class="empty-tours-icon">
                        <i class="fas fa-map"></i>
                    </div>
                    <h3 class="empty-tours-title">No Tours Yet</h3>
                    <p class="empty-tours-text">
                        There are no tours available for this category yet.
                    </p>
                    <a href="<?= BASEURL ?>/tours" class="btn-explore-tours">
                        <i class="fas fa-compass"></i>
                        Explore All Tours
                    </a>
                </div>
            </div>
        <?php else: ?>
            <!-- Tours Grid -->
            <div class="tours-section">
                <div class="tours-header d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <div class="text-md-start mb-3 mb-md-0">
                        <h2 class="tours-section-title justify-content-md-start mb-2">
                            <i class="fas fa-suitcase"></i>
                            Tours in <?= htmlspecialchars($category['name']) ?>
                        </h2>
                        <p class="tours-section-subtitle">
                            Find <?= count($tours) ?> interesting destinations for you
                        </p>
                    </div>
                    <?php
                        $tourLocs = [];
                        foreach($tours as $t) {
                            if (!empty($t['location']) && !in_array($t['location'], $tourLocs)) {
                                $tourLocs[] = $t['location'];
                            }
                        }
                    ?>
                    <div>
                        <select class="form-select border rounded-pill shadow-sm px-3 fw-bold" style="min-width: 200px;" onchange="filterCategoryTours(this.value)">
                            <option value="all">Search by Place...</option>
                            <?php foreach($tourLocs as $loc): ?>
                                <option value="<?= htmlspecialchars($loc) ?>"><?= htmlspecialchars($loc) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="tours-grid">
                    <?php foreach($tours as $tour): ?>
                        <div class="tour-card category-tour-item" data-location="<?= htmlspecialchars($tour['location']) ?>">
                            <div class="tour-image-wrapper">
                                <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="d-block w-100 h-100">
                                    <img src="<?= htmlspecialchars($tour['image_url']) ?>" 
                                         alt="<?= htmlspecialchars($tour['title']) ?>"
                                         class="tour-image">
                                </a>
                                <div class="tour-overlay"></div>
                                <div class="tour-badge">
                                    <i class="fas fa-tag"></i>
                                    <?= htmlspecialchars($category['name']) ?>
                                </div>
                            </div>
                            <div class="tour-content">
                                <h3 class="tour-title"><?= htmlspecialchars($tour['title']) ?></h3>
                                <div class="tour-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= htmlspecialchars($tour['location']) ?>
                                </div>
                                <div class="tour-details">
                                    <span class="tour-detail-item">
                                        <i class="fas fa-clock"></i>
                                        <?= htmlspecialchars($tour['duration']) ?>
                                    </span>
                                    <span class="tour-detail-item">
                                        <i class="fas fa-users"></i>
                                        <?= htmlspecialchars($tour['guests']) ?> Guests
                                    </span>
                                </div>
                                <div class="tour-footer">
                                    <div class="tour-price">
                                        <span class="price-amount"><?= Formatter::currency($tour['price']) ?></span>
                                        <span class="price-unit">/ person</span>
                                    </div>
                                    <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="btn-tour-detail">
                                        <i class="fas fa-eye"></i>
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <script>
            function filterCategoryTours(location) {
                const items = document.querySelectorAll('.category-tour-item');
                items.forEach(item => {
                    if (location === 'all' || item.getAttribute('data-location') === location) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
            </script>
        <?php endif; ?>
    </div>
</div>

<style>
.category-show-container {
    min-height: 100vh;
    background: #f8fafc;
}

.category-show-header {
    padding: 3rem 0;
    color: white;
    margin-bottom: 3rem;
}

.category-show-header .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.btn-back-white {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 500;
    margin-bottom: 2rem;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.btn-back-white:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateX(-3px);
    color: white;
}

.category-show-content {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.category-show-icon {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid rgba(255, 255, 255, 0.3);
    flex-shrink: 0;
}

.category-show-icon i {
    font-size: 2.5rem;
    color: white;
}

.category-show-info {
    flex: 1;
}

.category-show-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    letter-spacing: -0.5px;
}

.category-show-description {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.category-show-stats {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.stat-item {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 8px;
    font-weight: 500;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Empty State */
.empty-tours-container {
    padding: 4rem 1.5rem;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 50vh;
}

.empty-tours {
    text-align: center;
    max-width: 500px;
}

.empty-tours-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto 2rem;
    background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3.5rem;
    color: #6366f1;
}

.empty-tours-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
}

.empty-tours-text {
    font-size: 1rem;
    color: #64748b;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.btn-explore-tours {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
}

.btn-explore-tours:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
    color: white;
}

/* Tours Section */
.tours-section {
    padding: 2rem 0 4rem;
}

.tours-header {
    text-align: center;
    margin-bottom: 3rem;
}

.tours-section-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.tours-section-title i {
    color: #6366f1;
}

.tours-section-subtitle {
    font-size: 1rem;
    color: #64748b;
    margin: 0;
}

/* Tours Grid */
.tours-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

.tour-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
}

.tour-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.tour-image-wrapper {
    position: relative;
    width: 100%;
    height: 280px;
    overflow: hidden;
}

.tour-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.tour-card:hover .tour-image {
    transform: scale(1.1);
}

.tour-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.2) 100%);
}

.tour-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    color: #6366f1;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.tour-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.tour-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1.3;
}

.tour-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #64748b;
    margin-bottom: 1rem;
}

.tour-location i {
    color: #94a3b8;
}

.tour-details {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #f1f5f9;
}

.tour-detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #64748b;
}

.tour-detail-item i {
    color: #94a3b8;
}

.tour-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.tour-price {
    display: flex;
    flex-direction: column;
}

.price-amount {
    font-size: 1.5rem;
    font-weight: 700;
    color: #6366f1;
    line-height: 1.2;
}

.price-unit {
    font-size: 0.875rem;
    color: #64748b;
}

.btn-tour-detail {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(99, 102, 241, 0.2);
}

.btn-tour-detail:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .category-show-header {
        padding: 2rem 0;
    }

    .category-show-title {
        font-size: 2rem;
    }

    .category-show-content {
        flex-direction: column;
        text-align: center;
    }

    .tours-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .tour-image-wrapper {
        height: 220px;
    }
}
</style>

