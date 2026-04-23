<section class="hero-section" id="home">
    <div class="hero-overlay"></div>

    <div class="container-fluid px-4 px-lg-5 position-relative" style="z-index: 2;">
        <div class="row align-items-center">

            <div class="col-lg-8">

                <div class="badge-highlight">
                    #JustTravelAdvisor
                </div>

                <h1 class="hero-title">
                    Make Your <br class="d-lg-none">
                    Holiday Experience <br>
                    Unforgettable
                </h1>

                <p class="text-secondary fs-5 mb-5 pe-lg-5">
                    Enjoy memorable holiday experiences <br class="d-lg-none">
                    that bring you comfort <br class="d-lg-none">
                    and leave beautiful memories.
                </p>

                <div class="d-flex gap-3">
                    <button class="hero-nav-btn"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="hero-nav-btn"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="col-lg-4 d-none d-lg-block">
                <div class="hero-collage">
                    <img src="https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=800&q=80"
                        class="collage-img img-1" alt="Taj Mahal">
                    <img src="https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=800&q=80"
                        class="collage-img img-2" alt="Kerala">
                    <img src="https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=800&q=80"
                        class="collage-img img-3" alt="Jaipur">
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid px-4 px-lg-5 search-box-container">
    <div class="search-card">

        <form action="<?= BASEURL ?>/tours/plan" method="POST" class="mb-4">
            <h6 class="text-dark fw-bold mb-3 d-flex align-items-center gap-2"><i class="fa-solid fa-wand-magic-sparkles text-primary"></i> Match by Preferences</h6>
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <div class="row g-2 align-items-end">
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold mb-1">Departure (From)</label>
                            <input type="date" name="start_date" class="form-control border-0 fw-bold shadow-none p-0 text-muted" required>
                            <div class="border-bottom mt-1"></div>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold mb-1">Return (To)</label>
                            <input type="date" name="end_date" class="form-control border-0 fw-bold shadow-none p-0 text-muted" required>
                            <div class="border-bottom mt-1"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted small fw-bold">Climate</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0 ps-0"><i
                                class="fa-solid fa-cloud-sun text-muted"></i></span>
                        <select name="climate" class="form-select border-0 fw-bold shadow-none p-0">
                            <option value="">Any</option>
                            <option value="Tropical">Tropical</option>
                            <option value="Moderate">Moderate</option>
                            <option value="Cold">Cold</option>
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
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
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
                            <option value="Relaxing">Relaxing</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Heritage">Heritage</option>
                            <option value="Wildlife">Wildlife</option>
                        </select>
                    </div>
                    <div class="border-bottom mt-2"></div>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-search-main w-100">
                        <i class="fa-solid fa-wand-magic-sparkles"></i> Generate Plan
                    </button>
                </div>
            </div>
        </form>
        


    </div>
</div>

<section class="py-5" id="tours-showcase">
    <div class="container-fluid px-4 px-lg-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bolder display-6 mb-2">Featured Tours</h2>
                <p class="text-muted mb-0 small">Handpicked adventures across India</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="<?= BASEURL ?>/tours" class="btn btn-outline-dark rounded-pill fw-bold me-2 d-none d-md-block" style="font-size: 0.85rem; padding: 0.5rem 1rem;">See All</a>
                <button class="btn-nav-circle d-none d-md-flex" onclick="document.getElementById('tourScroll').scrollBy({left: -350, behavior: 'smooth'})"><i class="fa-solid fa-arrow-left"></i></button>
                <button class="btn-nav-circle d-none d-md-flex" onclick="document.getElementById('tourScroll').scrollBy({left: 350, behavior: 'smooth'})"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="scroll-container-horizontal" id="tourScroll">
            <div class="row flex-nowrap g-3">
                <?php foreach($data['tours'] as $tour): ?>
                <div class="col-10 col-md-4">
                    <div class="hotel-card h-100">
                        <div class="hotel-img-wrapper" style="height: 200px;">
                            <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="d-block w-100 h-100">
                                <img src="<?= htmlspecialchars($tour['image_url'] ?? 'https://images.unsplash.com/photo-1526761122248-c31c93f8b299?auto=format&fit=crop&w=600&q=80') ?>" alt="<?= htmlspecialchars($tour['title'] ?? 'Tour') ?>" style="object-fit: cover; width: 100%; height: 100%;">
                            </a>
                        </div>
                        <div class="card-body p-4 position-relative">
                            <h5 class="card-title fw-bold mt-2 mb-2"><?= htmlspecialchars($tour['title'] ?? 'Tour Title') ?></h5>
                            <p class="text-muted small mb-3"><i class="fa-solid fa-location-dot me-2"></i><?= htmlspecialchars($tour['location'] ?? 'India') ?></p>
                            
                            <div class="d-flex gap-3 mb-4 text-muted small">
                                <div><i class="fa-regular fa-clock me-1"></i><?= htmlspecialchars($tour['duration'] ?? 'N/A') ?></div>
                                <div><i class="fa-solid fa-user-group me-1"></i>Max <?= htmlspecialchars($tour['guests'] ?? 'N/A') ?></div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center">
                                <a href="<?= BASEURL ?>/tours/detail/<?= $tour['id'] ?>" class="btn-hotel-book">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="destinations">
    <div class="container-fluid px-4 px-lg-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="fw-bolder display-6 mb-2">Tour Categories</h2>
                <p class="text-muted mb-0 small">Customer favorite destinations</p>
            </div>
            <a href="<?= BASEURL ?>/category" class="btn-dark-rounded d-none d-md-inline-flex">See All <i
                    class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="scroll-container-horizontal" id="categoryScroll">
            <div class="row flex-nowrap g-3">
                <?php foreach($data['categories'] as $category): ?>
                <div class="col-10 col-md-3">
                    <a href="<?= BASEURL ?>/category/show/<?= $category['id'] ?>" class="text-decoration-none">
                        <div class="cat-card h-100">
                            <div>
                                <img src="<?= htmlspecialchars($category['image_url'] ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=400&q=80') ?>"
                                    class="cat-img" alt="<?= htmlspecialchars($category['name']) ?>">
                                <h5 class="cat-title"><?= htmlspecialchars($category['name']) ?></h5>
                                <p class="cat-subtitle mb-0"><?= $category['tour_count'] ?? 0 ?> Tours Available</p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <div class="btn-arrow-sm"><i class="fa-solid fa-arrow-right fa-xs"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="d-md-none mt-4 text-center">
            <a href="<?= BASEURL ?>/category" class="btn-dark-rounded w-100 justify-content-center">View All Categories</a>
        </div>
    </div>
</section>

<section class="py-5 mb-5" id="activities">
    <div class="container-fluid px-4 px-lg-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div>
                <h2 class="fw-bolder display-6 mb-2">Unforgettable Activities</h2>
                <p class="text-muted mb-0 small">Discover thrilling experiences across India</p>
            </div>
            <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                <a href="<?= BASEURL ?>/activities" class="btn btn-outline-dark rounded-pill fw-bold d-none d-md-block" style="font-size: 0.85rem; padding: 0.5rem 1rem;">See All</a>
                <?php
                    $activityLocs = [];
                    foreach($data['activities'] as $act) {
                        if (!empty($act['location']) && !in_array($act['location'], $activityLocs)) {
                            $activityLocs[] = $act['location'];
                        }
                    }
                ?>
                <select id="activityLocationFilter" class="form-select border rounded-pill shadow-sm px-3 fw-bold" style="min-width: 200px;" onchange="filterActivities(this.value)">
                    <option value="all">Search by Place...</option>
                    <?php foreach($activityLocs as $loc): ?>
                        <option value="<?= htmlspecialchars($loc) ?>"><?= htmlspecialchars($loc) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="d-none d-md-flex gap-2">
                    <button class="btn-nav-circle" onclick="document.getElementById('activityScroll').scrollBy({left: -350, behavior: 'smooth'})"><i class="fa-solid fa-arrow-left"></i></button>
                    <button class="btn-nav-circle" onclick="document.getElementById('activityScroll').scrollBy({left: 350, behavior: 'smooth'})"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="scroll-container-horizontal" id="activityScroll">
            <div class="row flex-nowrap g-4" id="activitiesWrapper">
                <?php foreach($data['activities'] as $index => $activity): ?>
                <?php 
                    $colors = ['promo-blue', 'promo-pink'];
                    $colorClass = $colors[$index % count($colors)];
                ?>
                <div class="col-10 col-md-6 col-lg-5 activity-item" data-location="<?= htmlspecialchars($activity['location'] ?? 'all') ?>">
                    <div class="promo-card <?= $colorClass ?> h-100 position-relative overflow-hidden" style="min-height: 250px;">
                        <h3 class="promo-title position-relative" style="z-index: 2; font-size: 1.5rem; line-height: 1.3; max-width: 60%;"><?= htmlspecialchars($activity['title']) ?></h3>
                        <p class="text-white position-relative" style="z-index: 2; max-width: 55%; font-size: 0.9rem; margin-top: 10px; opacity: 0.9;"><?= htmlspecialchars($activity['description']) ?></p>
                        <a href="<?= BASEURL ?>/activities/detail/<?= $activity['id'] ?>" class="btn-yellow-cta position-relative mt-3" style="z-index: 2;">Explore <i class="fa-solid fa-arrow-right"></i></a>

                        <img src="<?= htmlspecialchars($activity['image_url']) ?>"
                            class="promo-img-deco"
                            style="right: -20px; height: 100%; top: 0; mask-image: linear-gradient(to left, black 55%, transparent 100%); -webkit-mask-image: linear-gradient(to left, black 55%, transparent 100%); object-fit: cover;"
                            alt="<?= htmlspecialchars($activity['title']) ?>">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script>
    function filterActivities(location) {
        const items = document.querySelectorAll('.activity-item');
        items.forEach(item => {
            if (location === 'all' || item.getAttribute('data-location') === location) {
                // Using bootstrap grid classes so we keep flex/block display logic simple
                // We use remove/add d-none class
                item.classList.remove('d-none');
            } else {
                item.classList.add('d-none');
            }
        });
    }
    </script>
</section>

<section class="section-hotel-bg" id="hotels">
    <div class="container-fluid px-4 px-lg-5">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-bold display-6 mb-2 d-none d-md-block">Top Rated Hotels</h2>

                <h2 class="fw-bold mb-2 d-md-none mobile-hotel-title">Top Rated Hotels</h2>

                <p class="text-muted mb-0">
                    Quality as rated by customers. <br class="d-md-none"> Find your ideal stay!
                </p>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="<?= BASEURL ?>/hotels" class="btn btn-outline-dark rounded-pill fw-bold me-2 d-none d-md-block" style="font-size: 0.85rem; padding: 0.5rem 1rem;">See All</a>
                <button class="btn-nav-circle d-none d-md-flex" onclick="document.getElementById('hotelScroll').scrollBy({left: -350, behavior: 'smooth'})"><i class="fa-solid fa-arrow-left"></i></button>
                <button class="btn-nav-circle d-none d-md-flex" onclick="document.getElementById('hotelScroll').scrollBy({left: 350, behavior: 'smooth'})"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="scroll-container-horizontal" id="hotelScroll">
            <div class="row flex-nowrap g-3">

                <?php foreach($data['hotels'] as $hotel): ?>
                <div class="col-10 col-md-4">
                    <div class="hotel-card h-100">
                        <div class="hotel-img-wrapper">
                            <a href="<?= BASEURL ?>/hotels/detail/<?= $hotel['id'] ?>" class="d-block w-100 h-100">
                                <img src="<?= $hotel['image_url'] ?>" alt="<?= $hotel['name'] ?>">
                            </a>
                            <div class="card-heart"><i class="fa-regular fa-heart"></i></div>
                        </div>
                        <div class="card-body p-4 position-relative">
                            <div class="pill-rating text-warning border">
                                <i class="fa-solid fa-star"></i> <?= $hotel['rating'] ?> <span
                                    class="text-muted fw-normal">(<?= $hotel['reviews'] ?> reviews)</span>
                            </div>

                            <h5 class="card-title fw-bold mt-2 mb-2"><?= $hotel['name'] ?></h5>
                            <p class="text-muted small mb-4"><i class="fa-solid fa-location-dot me-2"></i>
                                <?= $hotel['location'] ?></p>

                            <div class="mb-4 text-dark small">
                                <?php 
                                $rating = floatval($hotel['rating']);
                                for($i=1; $i<=5; $i++): 
                                    if ($i <= $rating) {
                                        echo '<i class="fa-solid fa-star text-warning"></i>';
                                    } elseif ($i - 0.5 <= $rating) {
                                        echo '<i class="fa-solid fa-star-half-stroke text-warning"></i>';
                                    } else {
                                        echo '<i class="fa-regular fa-star text-warning"></i>';
                                    }
                                endfor; 
                                ?>
                            </div>

                            <div class="d-flex justify-content-end align-items-center mt-3 border-top pt-3">

                                <a href="<?= BASEURL ?>/hotels/detail/<?= $hotel['id'] ?>"
                                    class="btn-hotel-book">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>

<section class="py-5 mb-5">
    <div class="container-fluid px-4 px-lg-5">
        <div class="luxury-section-wrapper">
            <div class="row align-items-center">

                <div class="col-lg-5 mb-4 mb-lg-0 text-center text-lg-start">
                    <div class="badge-pill-white mb-3">Easy Planning</div>
                    <h2 class="luxury-title">Luxury Holidays, <br> Beautiful Destinations</h2>
                    <p class="text-muted mb-0 lh-lg">
                        Enjoy exclusive access to world-class destinations with flexible planning and transparent itineraries. Fulfill your dreams now.
                    </p>
                </div>

                <div class="col-lg-7">
                    <div class="luxury-gallery">
                        <div class="gallery-main">
                            <img src="https://images.unsplash.com/photo-1582610116397-edb318620f90?auto=format&fit=crop&w=800&q=80"
                                class="img-cover rounded-4" alt="Luxury Hotel">
                        </div>

                        <div class="gallery-side">
                            <img src="https://images.unsplash.com/photo-1524443169398-9aa1ceab67d5?auto=format&fit=crop&w=800&q=80"
                                class="img-cover rounded-circle" alt="Forts">
                            <img src="https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=800&q=80"
                                class="img-cover rounded-pill" alt="Munnar">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="py-5 mb-5">
    <div class="container-fluid px-4 px-lg-5">
        <div class="text-center mb-5">
            <h2 class="fw-bolder display-6 mb-2">Why Choose TravelAdvisor?</h2>
            <p class="text-muted">The best booking platform you can trust</p>
        </div>

        <div class="scroll-container-horizontal" id="whyScroll">
            <div class="row flex-nowrap g-4 mb-5">

                <div class="col-10 col-md-6 col-lg-3">
                    <div class="feature-card bg-soft-teal h-100">
                        <div class="icon-box-sq text-teal">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h5 class="feat-title">Security Guarantee</h5>
                        <p class="feat-desc">
                            Full commitment to user data security via advanced encryption and guaranteed transactions.
                        </p>
                        <a href="#" class="feat-link text-teal">Learn More <i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-10 col-md-6 col-lg-3">
                    <div class="feature-card bg-soft-pink h-100">
                        <div class="icon-box-sq text-pink">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <h5 class="feat-title">24/7 Service</h5>
                        <p class="feat-desc">
                            Our support team is always ready to assist you whenever and wherever you need help during your holiday.
                        </p>
                        <a href="#" class="feat-link text-pink">Learn More <i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-10 col-md-6 col-lg-3">
                    <div class="feature-card bg-soft-blue h-100">
                        <div class="icon-box-sq text-blue">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <h5 class="feat-title">Best Price</h5>
                        <p class="feat-desc">
                            We guarantee competitive prices without hidden fees. Luxury holiday, friendly prices.
                        </p>
                        <a href="#" class="feat-link text-blue">Learn More <i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-10 col-md-6 col-lg-3">
                    <div class="feature-card bg-soft-purp h-100">
                        <div class="icon-box-sq text-purp">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </div>
                        <h5 class="feat-title">Easy Booking</h5>
                        <p class="feat-desc">
                            User-friendly interface makes booking tickets and hotels as easy as just one click.
                        </p>
                        <a href="#" class="feat-link text-purp">Learn More <i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<section class="testi-section">
    <div class="container-fluid px-4 px-lg-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="badge-yellow-pill mb-3 mt-4">
                    <i class="fa-regular fa-star text-warning"></i> Reviews & Feedback
                </div>
                <h2 class="display-6 fw-bold mb-3">Share Your Travel Experience</h2>
                <p class="text-muted pe-md-5 lh-lg">We value your feedback! Let the community know how much you enjoyed your trip with TravelAdvisor. Your stories help us improve and guide future travelers!</p>
            </div>
            
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-5">
                    <h5 class="fw-bold mb-4">Write a Review</h5>
                    <form action="<?= BASEURL ?>" method="POST" onsubmit="alert('Thank you for your feedback!'); return false;">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Your Name</label>
                            <input type="text" class="form-control rounded-pill px-4 py-2 shadow-none border bg-light" required placeholder="John Doe">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold d-block">Select Rating</label>
                            <div class="d-flex gap-2 full-star-rating mb-2" style="font-size: 1.5rem;">
                                <i class="fa-regular fa-star text-warning cursor-pointer" onclick="setFormRating(1)"></i>
                                <i class="fa-regular fa-star text-warning cursor-pointer" onclick="setFormRating(2)"></i>
                                <i class="fa-regular fa-star text-warning cursor-pointer" onclick="setFormRating(3)"></i>
                                <i class="fa-regular fa-star text-warning cursor-pointer" onclick="setFormRating(4)"></i>
                                <i class="fa-regular fa-star text-warning cursor-pointer" onclick="setFormRating(5)"></i>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Your Review</label>
                            <textarea class="form-control rounded-4 p-3 shadow-none border bg-light" rows="4" required placeholder="Tell us about your experience..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 rounded-pill fw-bold text-dark py-3">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function setFormRating(stars) {
    const starIcons = document.querySelectorAll('.full-star-rating i');
    starIcons.forEach((icon, index) => {
        if (index < stars) {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid');
        } else {
            icon.classList.remove('fa-solid');
            icon.classList.add('fa-regular');
        }
    });
}
document.querySelectorAll('.card-heart').forEach(btn => {
    btn.style.cursor = 'pointer';
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const icon = this.querySelector('i');
        if (icon.classList.contains('fa-regular')) {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid', 'text-danger');
            
            // Add pop animation effect
            this.style.transform = 'scale(1.3)';
            setTimeout(() => { this.style.transform = 'scale(1)'; }, 150);
        } else {
            icon.classList.remove('fa-solid', 'text-danger');
            icon.classList.add('fa-regular');
        }
    });
});
</script>
<style>
.cursor-pointer { cursor: pointer; }
.card-heart { transition: transform 0.15s ease-in-out; }
</style>
