<!-- CSS Tambahan (diletakkan di sini agar tidak mengganggu style.css) -->
<style>
    .tour-detail-img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .booking-card {
        background-color: #f8f9fa;
        border: 1px solid #eee;
        border-radius: 20px;
        padding: 30px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #555;
        font-weight: 500;
    }

    .info-item i {
        color: #2caeba;
        /* Warna Teal */
        font-size: 1.2rem;
    }

    @media (max-width: 991px) {
        .tour-detail-img {
            height: 250px;
        }
    }
</style>

<div class="container-fluid px-4 px-lg-5" style="margin-top: 60px; margin-bottom: 50px;">
    <div class="row g-5">

        <!-- Kolom Kiri: Gambar & Deskripsi -->
        <div class="col-lg-8">
            <!-- Judul (Muncul di HP, tersembunyi di Desktop) -->
            <h1 class="fw-bolder mb-3 d-lg-none"><?= $data['tour']['title'] ?></h1>

            <!-- Gambar Utama -->
            <div class="tour-image-container mb-4 position-relative">
                <img src="<?= $data['tour']['image_url'] ?>" class="tour-detail-img" alt="<?= $data['tour']['title'] ?>">

                <!-- Badge (Jika Ada) -->
                <?php if($data['tour']['badge_text']): ?>
                <div class="card-badge bg-light border fw-bold <?= $data['tour']['badge_class'] ?>"
                    style="position: absolute; top: 20px; left: 20px; z-index: 2;">
                    <?= $data['tour']['badge_text'] ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Info Cepat (Durasi, Grup) -->
            <div class="d-flex flex-wrap gap-4 border-top border-bottom py-3 mb-4">
                <div class="info-item">
                    <i class="fa-regular fa-clock"></i>
                    <span><strong>Duration:</strong> <?= $data['tour']['duration'] ?></span>
                </div>
                <div class="info-item">
                    <i class="fa-regular fa-user"></i>
                    <span><strong>Group:</strong> <?= $data['tour']['guests'] ?></span>
                </div>
                <div class="info-item">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span><strong>Location:</strong> <?= $data['tour']['location'] ?></span>
                </div>
            </div>

            <!-- Deskripsi -->
            <h3 class="fw-bold mb-3">About This Tour Package</h3>
            <p class="lh-lg text-muted" style="text-align: justify;">
                <?= !empty($data['tour']['description']) ? nl2br(htmlspecialchars($data['tour']['description'])) : 'Details about this wonderful tour package will be updated soon. Stay tuned to discover what makes this place special!' ?>
            </p>
        </div>

        <!-- Kolom Kanan: Booking Box -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 120px;">
                <!-- Judul (Hanya di Desktop) -->
                <h1 class="fw-bolder mb-3 d-none d-lg-block"><?= $data['tour']['title'] ?></h1>

                <!-- Booking Card -->
                <div class="booking-card">
                    <h4 class="fw-bold text-dark mb-3">Add to your plans</h4>
                    <p class="small text-muted mb-4">
                        Save this amazing destination to your wishlist and start planning your perfect itinerary.
                    </p>

                    <form action="<?= BASEURL ?>/profile/toggleWishlist" method="POST">
                        <input type="hidden" name="item_id" value="<?= $data['tour']['id'] ?>">
                        <input type="hidden" name="item_type" value="tour">
                        <input type="hidden" name="action" value="add">
                        <button type="submit" class="btn btn-outline-danger w-100 rounded-pill py-3 fw-bold mt-3 border-2">
                            <i class="fa-regular fa-heart me-2"></i> Add to Wishlist
                        </button>
                    </form>                </div>
            </div>
        </div>
    </div>
</div>
