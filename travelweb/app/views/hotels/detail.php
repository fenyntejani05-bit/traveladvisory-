<style>
    .hotel-detail-img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .info-card {
        background-color: #f8f9fa;
        border: 1px solid #eee;
        border-radius: 20px;
        padding: 30px;
    }

    .amenity-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #555;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .amenity-item i {
        color: #f59e0b;
        font-size: 1.2rem;
    }

    .pill-rating {
        background-color: #fef3c7;
        color: #b45309;
        display: inline-block;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
    }

    @media (max-width: 991px) {
        .hotel-detail-img {
            height: 250px;
        }
    }
</style>

<div class="container-fluid px-4 px-lg-5" style="margin-top: 60px; margin-bottom: 50px;">
    <div class="row g-5">
        <!-- Kolom Kiri: Gambar & Deskripsi -->
        <div class="col-lg-8">
            <h1 class="fw-bolder mb-3 d-lg-none"><?= htmlspecialchars($data['hotel']['name']) ?></h1>

            <!-- Gambar Utama -->
            <div class="hotel-image-container mb-4 position-relative">
                <img src="<?= htmlspecialchars($data['hotel']['image_url']) ?>" class="hotel-detail-img" alt="<?= htmlspecialchars($data['hotel']['name']) ?>">
            </div>

            <!-- Deskripsi -->
            <h3 class="fw-bold mb-3">About This Hotel</h3>
            <p class="lh-lg text-muted" style="text-align: justify;">
                <?= !empty($data['hotel']['description']) ? nl2br(htmlspecialchars($data['hotel']['description'])) : 'Details about this wonderful hotel will be updated soon. Stay tuned to discover what makes this place special!' ?>
            </p>
        </div>

        <!-- Kolom Kanan: Info Box -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 120px;">
                <h1 class="fw-bolder mb-3 d-none d-lg-block"><?= htmlspecialchars($data['hotel']['name']) ?></h1>

                <div class="info-card">
                    <p class="text-muted"><i class="fa-solid fa-location-dot me-2 text-danger"></i><?= htmlspecialchars($data['hotel']['location']) ?></p>

                    <div class="mb-3">
                        <span class="pill-rating">
                            <i class="fa-solid fa-star"></i> <?= htmlspecialchars($data['hotel']['rating']) ?> 
                            <span class="fw-normal">(<?= htmlspecialchars($data['hotel']['reviews']) ?> reviews)</span>
                        </span>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-bold mb-3">Highlights & Amenities</h5>
                    
                    <?php 
                    $amenitiesStr = !empty($data['hotel']['amenities']) ? $data['hotel']['amenities'] : 'Wi-Fi, Air Conditioning, TV, Breakfast';
                    $amenitiesList = array_map('trim', explode(',', $amenitiesStr));
                    foreach ($amenitiesList as $amenity): 
                    ?>
                        <div class="amenity-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span><?= htmlspecialchars($amenity) ?></span>
                        </div>
                    <?php endforeach; ?>
                    
                    
                    <form action="<?= BASEURL ?>/profile/toggleWishlist" method="POST">
                        <input type="hidden" name="item_id" value="<?= $data['hotel']['id'] ?>">
                        <input type="hidden" name="item_type" value="hotel">
                        <input type="hidden" name="action" value="add">
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill py-3 fw-bold mt-3 border-2">
                            <i class="fa-regular fa-heart me-2"></i> Add to Wishlist
                        </button>
                    </form>
            </div>
        </div>
    </div>
</div>
