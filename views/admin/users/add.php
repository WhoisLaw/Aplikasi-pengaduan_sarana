<?php $title = 'Tambah User Baru';
require 'views/layouts/header.php'; ?>

<div class="admin-sky">
<nav class="navbar navbar-expand-lg sticky-top glass-nav nav-admin-vibrant px-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=admin_dashboard">
            <i class="bi bi-shield-lock-fill me-2"></i>Admin Panel
        </a>
        <div class="ms-auto">
            <a class="btn btn-glass btn-sm rounded-pill px-3 fw-semibold" href="index.php?page=admin_users">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="glass-card p-5 border-0">
                <div class="text-center mb-5">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 d-inline-flex mb-3">
                        <i class="bi bi-person-plus-fill fs-2"></i>
                    </div>
                    <h3 class="fw-800">Tambah User Baru</h3>
                    <p class="text-secondary">Daftarkan pengguna baru ke dalam sistem.</p>
                </div>

                <?php if (isset($_GET['error']) && $_GET['error'] == 'username_exists'): ?>
                    <div class="alert alert-danger glass-card border-0 mb-4 py-3 animate-up" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill fs-5 me-3 text-danger"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">Gagal!</h6>
                                <p class="mb-0 small opacity-75">Username sudah digunakan. Silakan pilih username lain.</p>
                            </div>
                        </div>
                    </div>
                <?php
endif; ?>

                <form action="index.php?page=admin_user_store" method="POST">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">NAMA LENGKAP</label>
                        <input type="text" name="nama" class="form-control bg-light border-0 py-3 rounded-3" required placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">USERNAME</label>
                        <input type="text" name="username" class="form-control bg-light border-0 py-3 rounded-3" required placeholder="Contoh: budi123">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">PASSWORD</label>
                        <input type="password" name="password" class="form-control bg-light border-0 py-3 rounded-3" required placeholder="Min. 6 karakter">
                    </div>
                    <div class="mb-5">
                        <label class="form-label fw-bold small text-secondary">ROLE PENGGUNA</label>
                        <select name="role" class="form-select bg-light border-0 py-3 rounded-3" required>
                            <option value="siswa">Siswa</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-premium w-100 py-3 rounded-3">
                        <i class="bi bi-check2-circle me-2"></i>Simpan User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<?php require 'views/layouts/footer.php'; ?>
