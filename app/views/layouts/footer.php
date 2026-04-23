<!-- Start Footer Section -->
<!-- 'footer-dark' is a custom class, 'text-center' centers the text -->
<footer class="footer-dark text-center">
    <div class="container-fluid px-4 px-lg-5">
        <!-- Copyright text -->
        <p class="mb-0 fw-bold">
            &copy; 2025 TravelAdvisor Inc.
        </p>
    </div>
</footer>
<!-- End Footer Section -->


<!-- =================================================================== -->
<!-- Awal Modal Login/Daftar (Authentication Modal) -->
<!-- =================================================================== -->
<!-- Ini adalah div utama untuk modal. 'fade' memberikan efek animasi muncul/hilang. -->
<!-- 'id="authModal"' adalah ID unik yang ditargetkan oleh tombol "Login" di header. -->
<div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
    <!-- 'modal-dialog-centered' membuat modal muncul di tengah layar secara vertikal. -->
    <!-- 'modal-lg' membuat modal berukuran besar (large). -->
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content auth-modal-content">

            <!-- 'row g-0' adalah Bootstrap row tanpa gutter (spasi antar kolom) -->
            <div class="row g-0">

                <!-- [LEFT COLUMN] - Side Image (Visible only on Desktop) -->
                <!-- 'd-none d-lg-block' means hidden on sizes below 'lg', visible on 'lg' and above -->
                <div class="col-lg-5 d-none d-lg-block auth-side-img">
                    <!-- Overlay to place text over image -->
                    <div class="auth-overlay">
                        <h3 class="fw-bold mb-2">Explore the World</h3>
                        <p class="mb-0 small opacity-75">Join our traveler community and discover hidden
                            paradises.</p>
                    </div>
                </div>
                <!-- Akhir Kolom Kiri -->


                <!-- [KOLOM KANAN] - Konten Form (Login & Daftar) -->
                <!-- 'col-lg-7' mengambil 7 dari 12 kolom di ukuran 'lg'. Di ukuran kecil, ini akan menjadi 100% -->
                <!-- 'p-5' memberikan padding besar di semua sisi. 'position-relative' untuk tombol close. -->
                <div class="col-lg-7 p-5 position-relative">

                    <!-- Tombol 'X' untuk menutup modal -->
                    <!-- 'data-bs-dismiss="modal"' adalah atribut Bootstrap JS yang memerintahkan elemen ini untuk menutup modal -->
                    <button type="button" class="btn-close btn-close-absolute" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <!-- Modal Header Text -->
                    <div class="text-center mb-4">
                        <h4 class="fw-bolder">Welcome to TravelAdvisor</h4>
                        <p class="text-muted small">Please login or register to continue.</p>
                    </div>

                    <!-- Tab Navigation (Pills) to switch between Login and Register -->
                    <ul class="nav nav-pills nav-pills-custom" id="pills-tab" role="tablist">
                        <!-- "Login" Tab Button -->
                        <li class="nav-item w-50" role="presentation">
                            <!-- 'active' means this tab is visible initially -->
                            <!-- 'data-bs-toggle="pill"' tells Bootstrap this is a tab button -->
                            <!-- 'data-bs-target="#pills-login"' links this button to the div with ID 'pills-login' -->
                            <button class="nav-link active w-100" id="pills-login-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-login" type="button">Login</button>
                        </li>
                        <!-- "Register" Tab Button -->
                        <li class="nav-item w-50" role="presentation">
                            <!-- 'data-bs-target="#pills-register"' links this button to the div with ID 'pills-register' -->
                            <button class="nav-link w-100" id="pills-register-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-register" type="button">Register</button>
                        </li>
                    </ul>

                    <!-- Konten dari Tab (Tab Content) -->
                    <div class="tab-content">

                        <!-- [KONTEN TAB 1] - Form Login -->
                        <!-- 'show active' membuat konten tab ini terlihat pertama kali (sesuai dengan tombol 'active' di atas) -->
                        <!-- ID 'pills-login' harus sama dengan 'data-bs-target' tombolnya -->
                        <div class="tab-pane fade show active" id="pills-login">
                            <!-- Form login, data dikirim ke controller Auth method login -->
                            <form action="<?= BASEURL ?>/auth/login" method="POST">

                                <!-- Email Input (with floating label) -->
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control form-control-auth"
                                        id="loginEmail" placeholder="name@example.com" required>
                                    <label for="loginEmail">Email Address</label>
                                </div>

                                <!-- Password Input (with floating label) -->
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control form-control-auth"
                                        id="loginPassword" placeholder="Password" required>
                                    <label for="loginPassword">Password</label>
                                </div>

                                <!-- Row for 'Remember Me' and 'Forgot Password' -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe">
                                        <label class="form-check-label small text-muted" for="rememberMe">Remember
                                            Me</label>
                                    </div>
                                    <a href="#" class="small text-decoration-none fw-bold text-dark">Forgot
                                        Password?</a>
                                </div>

                                <!-- Login Submit Button -->
                                <button type="submit" class="btn-auth-primary">Login Now</button>
                            </form>
                        </div>
                        <!-- Akhir Konten Tab Login -->


                        <!-- [KONTEN TAB 2] - Form Daftar -->
                        <!-- 'fade' saja (tanpa 'show active') berarti konten ini tersembunyi awalnya -->
                        <!-- ID 'pills-register' harus sama dengan 'data-bs-target' tombolnya -->
                        <div class="tab-pane fade" id="pills-register">
                            <!-- Form register, data dikirim ke controller Auth method register -->
                            <form action="<?= BASEURL ?>/auth/register" method="POST">

                                <!-- Full Name Input -->
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control form-control-auth"
                                        id="regName" placeholder="Full Name" required>
                                    <label for="regName">Full Name</label>
                                </div>

                                <!-- Email Input -->
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" class="form-control form-control-auth"
                                        id="regEmail" placeholder="name@example.com" required>
                                    <label for="regEmail">Email Address</label>
                                </div>

                                <!-- Password Input -->
                                <div class="form-floating mb-4">
                                    <input type="password" name="password" class="form-control form-control-auth"
                                        id="regPass" placeholder="Password" required>
                                    <label for="regPass">Create Password</label>
                                </div>

                                <!-- Register Submit Button -->
                                <button type="submit" class="btn-auth-primary">Create New Account</button>
                            </form>
                        </div>
                        <!-- Akhir Konten Tab Daftar -->

                    </div> <!-- Akhir 'tab-content' -->
                </div> <!-- Akhir 'col-lg-7' (Kolom Kanan) -->
            </div> <!-- Akhir 'row' -->
        </div> <!-- Akhir 'modal-content' -->
    </div> <!-- Akhir 'modal-dialog' -->
</div>
<!-- =================================================================== -->
<!-- Akhir Modal Login/Daftar -->
<!-- =================================================================== -->


<!-- Tombol "Back to Top" (Kembali ke Atas) -->
<!-- Fungsinya kemungkinan diatur di script.js (misal: muncul saat scroll ke bawah) -->
<a href="#" class="btn-back-to-top"><i class="fa-solid fa-arrow-up"></i></a>

<!-- =================================================================== -->
<!-- Promo Popup Modal -->
<!-- =================================================================== -->
<div class="modal fade" id="promoPopupModal" tabindex="-1" aria-labelledby="promoPopupModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content promo-popup-content">
            <div class="promo-popup-wrapper">
                <!-- Close Button -->
                <button type="button" class="btn-close-promo" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>

                <!-- Background Pattern -->
                <div class="promo-popup-pattern"></div>

                <!-- Content -->
                <div class="promo-popup-body">
                    <div class="row g-0 align-items-center">
                        <!-- Left Side - Image -->
                        <div class="col-lg-6 promo-popup-image-wrapper">
                            <div class="promo-popup-image">
                                <div class="promo-badge-floating">
                                    <i class="fas fa-gift"></i>
                                    <span>Special Offer</span>
                                </div>
                                <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=800&q=80" alt="Promo" class="img-fluid">
                            </div>
                        </div>

                        <!-- Right Side - Content -->
                        <div class="col-lg-6 promo-popup-text-wrapper">
                            <div class="promo-popup-text">
                                <div class="promo-badge">
                                    <i class="fas fa-fire"></i>
                                    <span>Limited Time</span>
                                </div>
                                
                                <h2 class="promo-title">
                                    Get a Discount
                                    <span class="promo-highlight">Up to 50%</span>
                                </h2>
                                
                                <p class="promo-subtitle">
                                    For all your selected tour packages!
                                </p>

                                <div class="promo-features">
                                    <div class="promo-feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Up to 50% discount</span>
                                    </div>
                                    <div class="promo-feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Valid for all destinations</span>
                                    </div>
                                    <div class="promo-feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>No minimum purchase</span>
                                    </div>
                                </div>

                                <div class="promo-code-box">
                                    <div class="promo-code-label">Use Code:</div>
                                    <div class="promo-code">
                                        <span id="promoCode">DONITRIP50</span>
                                        <button class="btn-copy-code" onclick="copyPromoCode()">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="promo-actions">
                                    <a href="<?= BASEURL ?>/tours" class="btn-promo-primary">
                                        <span>Explore Tours</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <button type="button" class="btn-promo-secondary" data-bs-dismiss="modal">
                                        Maybe Later
                                    </button>
                                </div>

                                <div class="promo-footer-text">
                                    <i class="fas fa-clock"></i>
                                    <span>Promo ends in <strong>7 days</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Memuat JavaScript Bootstrap (Bundle) -->
<!-- Ini PENTING untuk fungsionalitas modal, dropdown, tab, dan komponen interaktif lainnya -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Memuat file JavaScript kustom Anda -->
<!-- (Mungkin berisi logika untuk 'btn-back-to-top' atau efek scroll) -->
<script src="<?= BASEURL ?>/js/script.js"></script>

<!-- Promo Popup Script -->
<script>
// Check if user has seen the promo popup
function shouldShowPromoPopup() {
    const promoShown = localStorage.getItem('donitrip_promo_shown');
    const promoShownDate = localStorage.getItem('donitrip_promo_shown_date');
    
    // If never shown, show it
    if (!promoShown) {
        return true;
    }
    
    // If shown today, don't show again
    const today = new Date().toDateString();
    if (promoShownDate === today) {
        return false;
    }
    
    // Show again after 24 hours
    return false;
}

// Show promo popup
function showPromoPopup() {
    if (shouldShowPromoPopup()) {
        const promoModal = new bootstrap.Modal(document.getElementById('promoPopupModal'), {
            backdrop: 'static',
            keyboard: false
        });
        
        // Show after 1 second delay
        setTimeout(() => {
            promoModal.show();
        }, 1000);
    }
}

// Mark promo as shown
function markPromoAsShown() {
    localStorage.setItem('donitrip_promo_shown', 'true');
    localStorage.setItem('donitrip_promo_shown_date', new Date().toDateString());
}

// Copy promo code to clipboard
function copyPromoCode() {
    const promoCode = document.getElementById('promoCode').textContent;
    navigator.clipboard.writeText(promoCode).then(() => {
        const btn = event.target.closest('.btn-copy-code');
        const icon = btn.querySelector('i');
        icon.className = 'fas fa-check';
        btn.classList.add('copied');
        
        setTimeout(() => {
            icon.className = 'fas fa-copy';
            btn.classList.remove('copied');
        }, 2000);
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Only show on home page
    const currentPath = window.location.pathname;
    const baseUrl = '<?= BASEURL ?>';
    const basePath = baseUrl.replace(/^https?:\/\/[^\/]+/, '');
    
    // Check if we're on home page
    const isHomePage = currentPath === basePath || 
                      currentPath === basePath + '/' || 
                      currentPath === basePath + '/home' ||
                      currentPath.endsWith('/home') ||
                      currentPath === '/' ||
                      (currentPath === '' && window.location.search === '');
    
    if (isHomePage) {
        showPromoPopup();
    }
    
    // Mark as shown when modal is closed
    const promoModal = document.getElementById('promoPopupModal');
    if (promoModal) {
        promoModal.addEventListener('hidden.bs.modal', function() {
            markPromoAsShown();
        });
    }

    // Auto-open Login modal if registered successfully
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('action') === 'registered') {
        const authModalEl = document.getElementById('authModal');
        const loginTab = document.getElementById('pills-login-tab');
        if (authModalEl && loginTab) {
            const authModal = new bootstrap.Modal(authModalEl);
            const tab = new bootstrap.Tab(loginTab);
            tab.show();
            setTimeout(() => {
                // Remove param from URL cleanly
                window.history.replaceState({}, document.title, window.location.pathname);
                alert("Account created successfully! Please log in.");
                authModal.show();
            }, 300);
        }
    }
});
</script>

<style>
/* Promo Popup Styles */
#promoPopupModal .modal-dialog {
    max-width: 900px;
    margin: 1rem;
}

.promo-popup-content {
    border: none;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.promo-popup-wrapper {
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 500px;
}

.promo-popup-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    pointer-events: none;
}

.btn-close-promo {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    z-index: 10;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
}

.btn-close-promo:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.promo-popup-body {
    position: relative;
    z-index: 2;
}

.promo-popup-image-wrapper {
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.promo-popup-image {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

.promo-popup-image img {
    width: 100%;
    height: auto;
    display: block;
}

.promo-badge-floating {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
    z-index: 3;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

.promo-popup-text-wrapper {
    padding: 3rem 2.5rem;
    background: white;
}

.promo-popup-text {
    color: #1e293b;
}

.promo-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #991b1b;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.promo-badge i {
    color: #ef4444;
}

.promo-title {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1rem;
    color: #1e293b;
}

.promo-highlight {
    display: block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.promo-subtitle {
    font-size: 1.1rem;
    color: #64748b;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.promo-features {
    margin-bottom: 2rem;
}

.promo-feature-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
    color: #475569;
}

.promo-feature-item i {
    color: #10b981;
    font-size: 1.1rem;
}

.promo-code-box {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    text-align: center;
}

.promo-code-label {
    font-size: 0.875rem;
    color: #64748b;
    margin-bottom: 0.75rem;
    font-weight: 500;
}

.promo-code {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #6366f1;
    letter-spacing: 2px;
}

.btn-copy-code {
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    color: #6366f1;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-copy-code:hover {
    background: #6366f1;
    color: white;
    border-color: #6366f1;
}

.btn-copy-code.copied {
    background: #10b981;
    border-color: #10b981;
    color: white;
}

.promo-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.btn-promo-primary {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
}

.btn-promo-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
    color: white;
}

.btn-promo-secondary {
    padding: 0.75rem 1.5rem;
    background: transparent;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    color: #64748b;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-promo-secondary:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #1e293b;
}

.promo-footer-text {
    text-align: center;
    font-size: 0.875rem;
    color: #94a3b8;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.promo-footer-text i {
    color: #f59e0b;
}

/* Responsive */
@media (max-width: 991px) {
    .promo-popup-image-wrapper {
        padding: 1.5rem;
    }
    
    .promo-popup-text-wrapper {
        padding: 2rem 1.5rem;
    }
    
    .promo-title {
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    #promoPopupModal .modal-dialog {
        margin: 0.5rem;
    }
    
    .promo-popup-wrapper {
        min-height: auto;
    }
    
    .promo-popup-image-wrapper {
        padding: 1rem;
    }
    
    .promo-popup-text-wrapper {
        padding: 1.5rem 1rem;
    }
    
    .promo-title {
        font-size: 1.75rem;
    }
    
    .promo-code {
        font-size: 1.25rem;
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>

</body>
</html>