<?php $title = 'Kirim Laporan';
require 'views/layouts/header.php'; ?>

<div class="student-sky">
<nav class="navbar navbar-expand-lg sticky-top glass-nav nav-vibrant px-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=siswa_dashboard">
            <i class="bi bi-megaphone-fill me-2"></i>Pengaduan Sarana
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link me-3 fw-medium" href="index.php?page=siswa_dashboard">
                        <i class="bi bi-arrow-left me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link me-3 opacity-75">Halo, <strong><?php echo e($_SESSION['nama']); ?></strong></span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-glass btn-sm rounded-pill px-3" href="index.php?page=logout">Keluar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="glass-card p-5 animate-up">
                <div class="d-flex align-items-center mb-5">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-pencil-square fs-3"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 fw-800">Kirim Aspirasi</h2>
                        <p class="text-secondary mb-0">Sampaikan keluhan atau saran sarana sekolah Anda.</p>
                    </div>
                </div>

                <form action="index.php?page=siswa_submit" method="POST" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">KATEGORI MASALAH</label>
                        <select class="form-select bg-white border shadow-sm py-3 rounded-3" name="id_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="1">Kebersihan</option>
                            <option value="2">Fasilitas Kelas</option>
                            <option value="3">Keamanan</option>
                            <option value="4">Olahraga</option>
                            <option value="5">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">LOKASI / TEMPAT</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border shadow-sm px-3 rounded-start-3">
                                <i class="bi bi-geo-alt text-secondary"></i>
                            </span>
                            <input type="text" class="form-control bg-white border shadow-sm py-3 rounded-end-3" name="judul" required placeholder="Contoh: Ruang Lab Komputer, Kantin, dsb.">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">DESKRIPSI LENGKAP</label>
                        <textarea class="form-control bg-white border shadow-sm py-3 rounded-3" name="deskripsi" rows="5" required placeholder="Jelaskan detail pengaduan atau aspirasi Anda secara rinci..."></textarea>
                    </div>
                    <div class="mb-5">
                        <label class="form-label fw-bold small text-secondary">FOTO PENDUKUNG (OPSIONAL)</label>
                        <div class="p-4 bg-white rounded-3 border-2 border-dashed text-center shadow-sm">
                            <input type="file" class="form-control border-0 bg-transparent" name="foto" accept="image/*">
                            <div class="form-text mt-3"><i class="bi bi-info-circle me-1"></i> Format: JPG, PNG, GIF. Maksimum 2MB.</div>
                        </div>
                    </div>
                    <div class="d-grid pt-2">
                        <button type="submit" class="btn btn-premium py-3 fw-800 fs-5 rounded-4 shadow-sm">
                            Kirim Aspirasi Sekarang <i class="bi bi-send-fill ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<?php require 'views/layouts/footer.php'; ?>

