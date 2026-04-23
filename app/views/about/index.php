<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<!-- Custom CSS if needed -->
<style>
    .about-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&w=1920&q=80') center/cover;
        height: 60vh;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }
    .about-icon {
        font-size: 3rem;
        color: #2caeba;
        margin-bottom: 20px;
    }
    .about-card {
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 40px 30px;
        height: 100%;
        transition: transform 0.3s ease;
    }
    .about-card:hover {
        transform: translateY(-10px);
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <div class="container animate-fade-in-up">
        <h1 class="display-3 fw-bold mb-3">About TravelAdvisor</h1>
        <p class="lead fs-4 fw-light w-75 mx-auto">Your ultimate gateway to discovering the hidden gems and celebrated wonders of India.</p>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-5 my-md-5">
    <div class="container-fluid px-4 px-lg-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=800&q=80" alt="Beautiful India" class="img-fluid rounded-4 shadow" style="object-fit: cover; height: 500px; width: 100%;">
            </div>
            <div class="col-lg-6">
                <div class="badge-pill-white mb-3" style="background-color: #e0f7fa; color: #00796b;">Platform Features</div>
                <h2 class="display-5 fw-bold mb-4">What TravelAdvisor Provides</h2>
                <ul class="text-muted lh-lg mb-4" style="font-size: 1.1rem; list-style: none; padding-left: 0;">
                    <li class="mb-3"><i class="fa-solid fa-check text-success me-2"></i><strong class="text-dark">Personalized Planning:</strong> Our intelligent algorithms tailor a perfect holiday plan according to your climate, budget, and activity preferences.</li>
                    <li class="mb-3"><i class="fa-solid fa-check text-success me-2"></i><strong class="text-dark">Seamless Discoveries:</strong> Whether you want to explore historical forts or tackle white-water rafting, you can discover all options right from our portal.</li>
                    <li class="mb-3"><i class="fa-solid fa-check text-success me-2"></i><strong class="text-dark">Authentic Information:</strong> All listings contain genuine imagery, accurate actual ratings, and curated itineraries.</li>
                    <li><i class="fa-solid fa-check text-success me-2"></i><strong class="text-dark">Secure Interactions:</strong> Save destinations to your wishlist safely and plan effectively without stress.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-5 bg-light pb-5 mb-5">
    <div class="container-fluid px-4 px-lg-5">
        <div class="text-center w-75 mx-auto mb-5 pb-3">
            <h2 class="display-6 fw-bold mb-3">Why We Do What We Do</h2>
            <p class="text-muted">Our core values drive every pixel of this platform and every destination we choose to feature.</p>
        </div>

        <div class="row g-4">
            <!-- Value 1 -->
            <div class="col-md-4">
                <div class="card about-card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-heart about-icon text-danger"></i>
                        <h4 class="fw-bold mb-3">Authenticity</h4>
                        <p class="text-muted small lh-lg mb-0">
                            We don't do generic tourist traps. We dive deep into local cultures to surface authentic experiences, ensuring you taste, see, and live the real India.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Value 2 -->
            <div class="col-md-4">
                <div class="card about-card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-shield-halved about-icon text-success"></i>
                        <h4 class="fw-bold mb-3">Trust & Reliability</h4>
                        <p class="text-muted small lh-lg mb-0">
                            We curate with extreme care. Every hotel and tour featured on our platform goes through a rigorous quality check to ensure traveler safety and comfort.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Value 3 -->
            <div class="col-md-4">
                <div class="card about-card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-compass about-icon text-primary"></i>
                        <h4 class="fw-bold mb-3">Ease of Planning</h4>
                        <p class="text-muted small lh-lg mb-0">
                            Trip planning shouldn't feel like a chore. Our intuitive interface allows you to wishlist, compare, and build custom itineraries with just a few clicks.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to action -->
<section class="py-5 text-center mb-5">
    <div class="container-fluid px-4 px-lg-5">
        <h2 class="fw-bold mb-4">Ready to Start Exploring?</h2>
        <a href="<?= BASEURL ?>/tours" class="btn btn-warning rounded-pill fw-bold px-5 py-3 shadow-sm text-dark">Discover Destinations</a>
    </div>
</section>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
