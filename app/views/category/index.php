<?php
require_once __DIR__ . '/../../helpers/Formatter.php';
?>

<div class="category-page-container">
    <!-- Header Section -->
    <div class="category-header">
        <div class="category-header-content">
            <div>
                <h1 class="category-page-title">
                    <i class="fas fa-layer-group"></i>
                    Tour Categories
                </h1>
                <p class="category-page-subtitle">Explore various categories of interesting tourist destinations</p>
            </div>
        </div>
    </div>

    <?php if (empty($data['categories'])): ?>
        <!-- Empty State -->
        <div class="empty-state-container">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h3 class="empty-state-title">No Categories Yet</h3>
                <p class="empty-state-text">
                    Tour categories will be available soon.
                </p>
            </div>
        </div>
    <?php else: ?>
        <!-- Categories Grid -->
        <div class="categories-grid">
            <?php foreach($data['categories'] as $category): ?>
                <a href="<?= BASEURL ?>/category/show/<?= $category['id'] ?>" class="category-card-link">
                    <div class="category-card">
                        <div class="category-image-wrapper">
                            <img src="<?= htmlspecialchars($category['image_url'] ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=400&q=80') ?>" 
                                 alt="<?= htmlspecialchars($category['name']) ?>"
                                 class="category-image">
                            <div class="category-overlay"></div>
                        </div>
                        <div class="category-content">
                            <div class="category-icon-wrapper">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3 class="category-name"><?= htmlspecialchars($category['name']) ?></h3>
                            <?php if (!empty($category['description'])): ?>
                                <p class="category-description">
                                    <?= htmlspecialchars($category['description']) ?>
                                </p>
                            <?php endif; ?>
                            <div class="category-footer">
                                <span class="category-link-text">
                                    View Tours
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.category-page-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
}

/* Header */
.category-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 3rem 2.5rem;
    margin-bottom: 3rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.25);
    color: white;
}

.category-header-content {
    text-align: center;
}

.category-page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    letter-spacing: -0.5px;
}

.category-page-title i {
    font-size: 2rem;
}

.category-page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

/* Empty State */
.empty-state-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 60vh;
    padding: 3rem;
}

.empty-state {
    text-align: center;
    max-width: 500px;
}

.empty-state-icon {
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

.empty-state-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
}

.empty-state-text {
    font-size: 1rem;
    color: #64748b;
    line-height: 1.6;
}

/* Categories Grid */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 2rem;
}

.category-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.category-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.category-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.category-image-wrapper {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.category-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.category-card:hover .category-image {
    transform: scale(1.1);
}

.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.3) 100%);
}

.category-content {
    padding: 2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.category-icon-wrapper {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
}

.category-icon-wrapper i {
    font-size: 1.5rem;
    color: white;
}

.category-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1.3;
}

.category-description {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    flex: 1;
}

.category-footer {
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #f1f5f9;
}

.category-link-text {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #6366f1;
    font-size: 0.95rem;
    transition: gap 0.3s ease;
}

.category-card:hover .category-link-text {
    gap: 0.75rem;
}

.category-link-text i {
    transition: transform 0.3s ease;
}

.category-card:hover .category-link-text i {
    transform: translateX(4px);
}

/* Responsive */
@media (max-width: 768px) {
    .category-page-container {
        padding: 1rem;
    }

    .category-header {
        padding: 2rem 1.5rem;
    }

    .category-page-title {
        font-size: 2rem;
        flex-direction: column;
        gap: 0.5rem;
    }

    .categories-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .category-image-wrapper {
        height: 200px;
    }
}
</style>

