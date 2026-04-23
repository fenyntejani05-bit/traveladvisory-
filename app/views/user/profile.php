<div class="container py-5" style="margin-top: 60px;">
    
    <!-- Profile Banner Card -->
    <div class="card border-0 rounded-4 overflow-hidden mb-4 shadow-lg profile-banner-card">
        <div class="card-body p-0">
            <div class="row g-0 align-items-center">
                <!-- Profile Image & Quick Info -->
                <div class="col-md-4 text-center text-md-start p-4 p-md-5 d-flex flex-column align-items-center justify-content-center border-end profile-glass-panel">
                    <div class="position-relative d-inline-block mx-auto mb-3">
                        <img src="<?= BASEURL ?>/img/profiles/<?= $data['user']['image_url'] ?? 'default.jpg' ?>" 
                             alt="Profile" class="rounded-circle shadow-sm" 
                             style="width: 140px; height: 140px; object-fit: cover; border: 6px solid rgba(255,255,255,0.8);">
                             
                        <form action="<?= BASEURL ?>/profile/uploadPhoto" method="POST" enctype="multipart/form-data" class="position-absolute bottom-0 end-0">
                            <label for="profilePhoto" class="btn btn-warning btn-sm rounded-circle shadow" style="width: 38px; height: 38px; padding: 7px; cursor: pointer; border: 2px solid white;">
                                <i class="fa-solid fa-camera"></i>
                            </label>
                            <input type="file" id="profilePhoto" name="photo" class="d-none" onchange="this.form.submit()" accept="image/png, image/jpeg, image/jpg">
                        </form>
                    </div>
                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-bold shadow-sm mb-2"><i class="fa-solid fa-crown me-1"></i><?= ucfirst(htmlspecialchars($data['user']['role'])) ?> Member</span>
                    <h4 class="fw-bolder mb-0 text-dark"><?= htmlspecialchars($data['user']['name']) ?></h4>
                </div>
                
                <!-- Overview Stats/Greeting -->
                <div class="col-md-8 p-4 p-md-5">
                    <div class="row g-4 text-center">
                        <div class="col-sm-4">
                            <div class="p-3 bg-white bg-opacity-75 rounded-4 shadow-sm">
                                <i class="fa-regular fa-clock text-primary fs-3 mb-2"></i>
                                <h6 class="fw-bold mb-1 text-muted">Member Since</h6>
                                <h5 class="fw-bolder mb-0"><?= date('Y', strtotime($data['user']['created_at'])) ?></h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-3 bg-white bg-opacity-75 rounded-4 shadow-sm">
                                <i class="fa-solid fa-map-location-dot text-success fs-3 mb-2"></i>
                                <h6 class="fw-bold mb-1 text-muted">Plans Generated</h6>
                                <h5 class="fw-bolder mb-0"><?= count($data['plan_history'] ?? []) ?></h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="p-3 bg-white bg-opacity-75 rounded-4 shadow-sm">
                                <i class="fa-solid fa-heart text-danger fs-3 mb-2"></i>
                                <h6 class="fw-bold mb-1 text-muted">Wishlist Items</h6>
                                <h5 class="fw-bolder mb-0"><?= count($data['wishlist_tours'] ?? []) + count($data['wishlist_hotels'] ?? []) ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Pills -->
    <ul class="nav nav-pills custom-profile-pills mb-4 justify-content-center gap-2" id="profileTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-pill fw-bold" id="details-tab" data-bs-toggle="pill" data-bs-target="#details" type="button" role="tab"><i class="fa-regular fa-id-card me-2"></i>My Details</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill fw-bold" id="history-tab" data-bs-toggle="pill" data-bs-target="#history" type="button" role="tab"><i class="fa-solid fa-clock-rotate-left me-2"></i>Plan History</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill fw-bold" id="wishlist-tab" data-bs-toggle="pill" data-bs-target="#wishlist" type="button" role="tab"><i class="fa-solid fa-heart border-none me-2"></i>Wishlist</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="profileTabsContent">
        
        <!-- Details Tab -->
        <div class="tab-pane fade show active" id="details" role="tabpanel">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3"><i class="fa-regular fa-user"></i></div>
                        <h4 class="fw-bold mb-0">Personal Information</h4>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded-4 border">
                                <label class="text-muted small fw-bold text-uppercase tracking-wider">Full Name</label>
                                <p class="fw-bold fs-5 mb-0 text-dark"><?= htmlspecialchars($data['user']['name']) ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded-4 border">
                                <label class="text-muted small fw-bold text-uppercase tracking-wider">Email Address</label>
                                <p class="fw-bold fs-5 mb-0 text-dark"><?= htmlspecialchars($data['user']['email']) ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded-4 border">
                                <label class="text-muted small fw-bold text-uppercase tracking-wider">Phone Number</label>
                                <p class="fw-bold fs-5 mb-0 text-dark"><?= htmlspecialchars($data['user']['phone'] ?? 'Not provided') ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded-4 border">
                                <label class="text-muted small fw-bold text-uppercase tracking-wider">Join Date</label>
                                <p class="fw-bold fs-5 mb-0 text-dark"><?= date('F j, Y', strtotime($data['user']['created_at'])) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Tab -->
        <div class="tab-pane fade" id="history" role="tabpanel">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                        <div class="icon-circle bg-success bg-opacity-10 text-success me-3"><i class="fa-solid fa-timeline"></i></div>
                        <h4 class="fw-bold mb-0">Generated Travel Plans</h4>
                    </div>
                    
                    <?php if(empty($data['plan_history'])): ?>
                        <div class="text-center py-5">
                            <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-state-2130362-1800926.png" width="150" alt="Empty" class="mb-3 opacity-50">
                            <h5 class="text-muted">You haven't generated any travel plans yet.</h5>
                            <a href="<?= BASEURL ?>" class="btn btn-warning rounded-pill px-4 mt-3 fw-bold shadow-sm">Generate a Plan Now</a>
                        </div>
                    <?php else: ?>
                        <div class="row g-4">
                            <?php foreach($data['plan_history'] as $history): ?>
                            <div class="col-md-6">
                                <div class="card border border-2 border-primary border-opacity-10 rounded-4 h-100 hover-card-lift">
                                    <div class="card-body p-4 position-relative">
                                        <div class="badge bg-light text-dark shadow-sm position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill"><i class="fa-regular fa-clock me-1 text-muted"></i> <?= date('M d, Y', strtotime($history['created_at'])) ?></div>
                                        <h5 class="fw-bold mb-3 mt-4 text-primary">Your Dream Escape</h5>
                                        
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-2"><i class="fa-regular fa-calendar text-muted me-2"></i> <span class="fw-bolder"><?= substr($history['date_range'], 0, 10) ?></span> to <span class="fw-bolder"><?= substr($history['date_range'], -10) ?></span></li>
                                            <li class="mb-2"><i class="fa-solid fa-cloud-sun text-warning me-2"></i> Climate: <span class="badge bg-secondary"><?= htmlspecialchars($history['climate']) ?></span></li>
                                            <li class="mb-2"><i class="fa-solid fa-wallet text-success me-2"></i> Budget: <span class="badge bg-secondary"><?= htmlspecialchars($history['budget']) ?></span></li>
                                            <li class="mb-2"><i class="fa-solid fa-person-hiking text-info me-2"></i> Activity: <span class="badge bg-secondary"><?= htmlspecialchars($history['activity']) ?></span></li>
                                        </ul>
                                        
                                        <form action="<?= BASEURL ?>/tours/plan" method="POST" class="mt-auto">
                                            <input type="hidden" name="climate" value="<?= htmlspecialchars($history['climate']) ?>">
                                            <input type="hidden" name="budget" value="<?= htmlspecialchars($history['budget']) ?>">
                                            <input type="hidden" name="activity" value="<?= htmlspecialchars($history['activity']) ?>">
                                            <input type="hidden" name="start_date" value="<?= substr($history['date_range'], 0, 10) ?>">
                                            <input type="hidden" name="end_date" value="<?= substr($history['date_range'], -10) ?>">
                                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold shadow-sm">View Result Again</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Wishlist Tab -->
        <div class="tab-pane fade" id="wishlist" role="tabpanel">
            <div class="card border-0 rounded-4 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                        <div class="icon-circle bg-danger bg-opacity-10 text-danger me-3"><i class="fa-solid fa-heart"></i></div>
                        <h4 class="fw-bold mb-0">My Favorites</h4>
                    </div>
                    
                    <?php if(empty($data['wishlist_tours']) && empty($data['wishlist_hotels'])): ?>
                        <div class="text-center py-5">
                            <i class="fa-regular fa-folder-open text-muted fa-4x mb-3 opacity-25"></i>
                            <h5 class="text-muted">Your wishlist is currently empty.</h5>
                            <a href="<?= BASEURL ?>#destinations" class="btn btn-outline-primary rounded-pill px-4 mt-3 fw-bold">Explore Listings</a>
                        </div>
                    <?php else: ?>
                        
                        <?php if(!empty($data['wishlist_tours'])): ?>
                            <h5 class="fw-bolder mb-3 text-dark mt-2">Saved Tours</h5>
                            <div class="row g-4 mb-5">
                                <?php foreach($data['wishlist_tours'] as $tour): ?>
                                    <div class="col-md-6 col-lg-4" id="wishlist-item-tour-<?= $tour['id'] ?>">
                                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-card-lift">
                                            <div class="position-relative" style="height: 180px;">
                                                <img src="<?= $tour['image_url'] ?>" class="w-100 h-100 object-fit-cover" alt="Tour image">
                                                <form action="<?= BASEURL ?>/profile/toggleWishlist" method="POST" class="position-absolute top-0 end-0 m-2" style="z-index: 5;">
                                                    <input type="hidden" name="item_id" value="<?= $tour['id'] ?>">
                                                    <input type="hidden" name="item_type" value="tour">
                                                    <input type="hidden" name="action" value="remove">
                                                    <button type="submit" class="btn btn-sm text-danger bg-white shadow-sm rounded-circle p-2" title="Remove from Wishlist" style="width:36px; height:36px;">
                                                        <i class="fa-solid fa-heart fa-lg"></i>
                                                    </button>
                                                </form>
                                                <div class="position-absolute bottom-0 start-0 m-2 badge bg-primary text-white shadow-sm"><i class="fa-solid fa-location-dot me-1"></i><?= htmlspecialchars($tour['location']) ?></div>
                                            </div>
                                            <div class="card-body p-3 text-center">
                                                <h6 class="card-title fw-bold text-truncate mb-2"><?= htmlspecialchars($tour['title']) ?></h6>
                                                <p class="text-primary fw-bolder fs-5 mb-3"><?= Formatter::currency($tour['price']) ?></p>
                                                <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="btn btn-outline-dark w-100 rounded-pill py-1 fw-bold">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($data['wishlist_hotels'])): ?>
                            <h5 class="fw-bolder mb-3 text-dark border-top pt-4">Saved Hotels</h5>
                            <div class="row g-4">
                                <?php foreach($data['wishlist_hotels'] as $hotel): ?>
                                    <div class="col-md-6 col-lg-4" id="wishlist-item-hotel-<?= $hotel['id'] ?>">
                                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-card-lift">
                                            <div class="position-relative" style="height: 180px;">
                                                <img src="<?= $hotel['image_url'] ?>" class="w-100 h-100 object-fit-cover" alt="Hotel image">
                                                <form action="<?= BASEURL ?>/profile/toggleWishlist" method="POST" class="position-absolute top-0 end-0 m-2" style="z-index: 5;">
                                                    <input type="hidden" name="item_id" value="<?= $hotel['id'] ?>">
                                                    <input type="hidden" name="item_type" value="hotel">
                                                    <input type="hidden" name="action" value="remove">
                                                    <button type="submit" class="btn btn-sm text-danger bg-white shadow-sm rounded-circle p-2" title="Remove from Wishlist" style="width:36px; height:36px;">
                                                        <i class="fa-solid fa-heart fa-lg"></i>
                                                    </button>
                                                </form>
                                                <div class="position-absolute bottom-0 start-0 m-2 badge bg-dark text-warning shadow-sm"><i class="fa-solid fa-star me-1"></i><?= $hotel['rating'] ?></div>
                                            </div>
                                            <div class="card-body p-3 text-center">
                                                <h6 class="card-title fw-bold text-truncate mb-2"><?= htmlspecialchars($hotel['name']) ?></h6>
                                                <p class="text-muted small mb-2"><i class="fa-solid fa-location-dot me-1"></i> <?= htmlspecialchars($hotel['location']) ?></p>
                                                <p class="text-primary fw-bolder fs-5 mb-3"><?= Formatter::currency($hotel['price']) ?> <span class="fs-6 text-muted fw-normal">/ night</span></p>
                                                <a href="<?= BASEURL ?>/hotels/detail/<?= $hotel['id'] ?>" class="btn btn-outline-dark w-100 rounded-pill py-1 fw-bold">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* Modern Profile Styling */
.profile-banner-card {
    background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
    border-bottom: 5px solid #0dcaf0;
}
.profile-glass-panel {
    background: rgba(255, 255, 255, 0.4);
    backdrop-filter: blur(10px);
}
.custom-profile-pills .nav-link {
    color: #6c757d;
    background: #f8f9fa;
    padding: 0.75rem 1.75rem;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}
.custom-profile-pills .nav-link:hover {
    background: #e9ecef;
    color: #2caeba;
}
.custom-profile-pills .nav-link.active {
    background: #2caeba;
    color: #fff;
    box-shadow: 0 4px 15px rgba(44, 174, 186, 0.3);
}
.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}
.hover-card-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-card-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}
.tracking-wider {
    letter-spacing: 0.1em;
}
</style>


