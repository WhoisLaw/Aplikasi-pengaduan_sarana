<?php $title = 'Selamat Datang - Pengaduan Sarana';
require 'views/layouts/header.php'; ?>

<style>
    .landing-hero {
        background: radial-gradient(circle at top right, #818cf8, #6366f1);
        min-height: 90vh;
        display: flex;
        align-items: center;
        border-radius: 0 0 80px 80px;
        position: relative;
        overflow: hidden;
    }
    .landing-hero::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .feature-icon-wrapper {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
        color: white;
        font-size: 1.5rem;
        margin-bottom: 25px;
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top glass-nav py-3 px-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="#">
            <img src="assets/img/logo.png" alt="Logo" class="me-2" style="height: 40px; width: auto;">
            <span>Pengaduan Sarana</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="landingNav">
            <div class="ms-auto d-flex gap-3 mt-3 mt-lg-0">
                <a href="index.php?page=login&role=siswa" class="btn btn-premium rounded-pill px-4 d-flex align-items-center" style="background: #1e293b; box-shadow: 0 4px 12px rgba(30, 41, 59, 0.3);">
                    <img src="assets/img/avatar.png" alt="Siswa" class="rounded-circle me-2" style="width: 24px; height: 24px; object-fit: cover; border: 1.5px solid rgba(255,255,255,0.5);">
                    Siswa
                </a>
                <a href="index.php?page=login&role=admin" class="btn btn-premium rounded-pill px-4 d-flex align-items-center" style="background: #1e293b; box-shadow: 0 4px 12px rgba(30, 41, 59, 0.3);">
                    <img src="assets/img/avatar.png" alt="Admin" class="rounded-circle me-2" style="width: 24px; height: 24px; object-fit: cover; border: 1.5px solid rgba(255,255,255,0.5); filter: brightness(0.9);">
                    Admin
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="landing-hero text-white">
    <div class="container position-relative z-1 py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                <h6 class="text-uppercase fw-800 mb-3" style="letter-spacing: 2px; color: #c7d2fe;">Solusi Aspirasi Digital</h6>
                <h1 class="display-3 fw-800 mb-4 lh-sm">Wujudkan Sarana Sekolah <span class="text-warning">Lebih Baik</span></h1>
                <p class="lead mb-5 opacity-75">Platform modern untuk menyampaikan keluhan dan masukan demi kenyamanan belajar bersama.</p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                    <a href="#tentang" class="btn btn-light btn-lg rounded-pill px-5 fw-800 text-primary shadow">
                        Pelajari Layanan
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="glass-card p-4 mx-auto" style="max-width: 500px; transform: rotate(3deg);">
                    <div class="bg-white rounded-4 overflow-hidden shadow-lg p-3" style="transform: rotate(-6deg);">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-danger rounded-pill px-3 py-2">LIVE REPORTS</span>
                            <span class="text-muted small">Updated 2m ago</span>
                        </div>
                        <div class="p-3 border-start border-primary border-4 bg-light rounded-3 mb-3">
                            <h6 class="fw-bold mb-1">Meja Rusak (Kelas X-2)</h6>
                            <p class="small text-muted mb-0">Laporan sedang diproses oleh sarpras.</p>
                        </div>
                        <div class="p-3 border-start border-warning border-4 bg-light rounded-3">
                            <h6 class="fw-bold mb-1">Lampu Mati (Lab Komp)</h6>
                            <p class="small text-muted mb-0">Menunggu pengecekan teknisi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-100" id="tentang">
    <div class="row text-center mb-5 mt-5">
        <div class="col-lg-7 mx-auto">
            <h6 class="text-primary fw-800 text-uppercase mb-2">Mengapa Memilih Kami?</h6>
            <h2 class="fw-800 mb-4 display-6">Layanan Pengaduan Digital Yang Transparan</h2>
            <p class="text-secondary leading-relaxed">Kami menghubungkan siswa dengan pihak sarana prasarana sekolah secara cepat, akurat, dan dapat dipantau secara real-time.</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center pt-4">
        <div class="col-md-4">
            <div class="glass-card p-5 h-100 text-center">
                <div class="feature-icon-wrapper mx-auto">
                    <i class="bi bi-lightning-fill"></i>
                </div>
                <h4 class="fw-800 mb-3">Cepat & Responsif</h4>
                <p class="text-secondary opacity-75">Laporan Anda langsung masuk ke database admin dalam hitungan detik untuk segera ditinjau.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-5 h-100 text-center">
                <div class="feature-icon-wrapper mx-auto" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <h4 class="fw-800 mb-3">Pantau Real-time</h4>
                <p class="text-secondary opacity-75">Siswa dapat melihat status laporan mulai dari 'Baru' hingga 'Selesai' secara transparan.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card p-5 h-100 text-center">
                <div class="feature-icon-wrapper mx-auto" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h4 class="fw-800 mb-3">Terverifikasi</h4>
                <p class="text-secondary opacity-75">Pihak sekolah memberikan tanggapan dan bukti perbaikan untuk setiap aspirasi yang masuk.</p>
            </div>
        </div>
    </div>
</div>



<footer class="py-5 text-center">
    <div class="container">
        <p class="text-secondary mb-0 fw-medium">&copy; 2026 Pengaduan Sarana Sekolah. Crafted with <i class="bi bi-heart-fill text-danger mx-1"></i> for better education.</p>
    </div>
</footer>

<?php require 'views/layouts/footer.php'; ?>

