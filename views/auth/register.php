<?php
$title = 'Registrasi Siswa';
require 'views/layouts/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; background: radial-gradient(circle at top left, rgba(99, 102, 241, 0.05), transparent);">
    <div class="glass-card p-5 w-100" style="max-width: 500px;">
        <div class="text-center mb-5">
            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-3 mb-3">
                <i class="bi bi-person-plus-fill fs-2"></i>
            </div>
            <h2 class="fw-800 mb-1">Registrasi Siswa</h2>
            <p class="text-secondary small">Buat akun untuk menyampaikan aspirasi Anda</p>
        </div>

        <?php if (isset($error) && $error): ?>
            <div class="alert alert-danger border-0 rounded-4 mb-4 small py-3" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i><?php echo (string)$error; ?>
            </div>
        <?php
endif; ?>

        <form action="index.php?page=register" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold small text-secondary">NAMA LENGKAP</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 px-3">
                        <i class="bi bi-person-vcard text-secondary"></i>
                    </span>
                    <input type="text" class="form-control bg-light border-0 py-3 rounded-end-4" id="nama" name="nama" required placeholder="Masukkan nama lengkap">
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label fw-bold small text-secondary">USERNAME</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 px-3">
                        <i class="bi bi-person text-secondary"></i>
                    </span>
                    <input type="text" class="form-control bg-light border-0 py-3 rounded-end-4" id="username" name="username" required placeholder="Pilih username unik">
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label fw-bold small text-secondary">PASSWORD</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 px-3">
                        <i class="bi bi-key text-secondary"></i>
                    </span>
                    <input type="password" class="form-control bg-light border-0 py-3" id="password" name="password" required placeholder="Buat password aman">
                    <button class="btn btn-light border-0 px-3 rounded-end-4" type="button" id="togglePassword">
                        <i class="bi bi-eye text-secondary" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-premium w-100 py-3 mb-3">
                Daftar Sekarang <i class="bi bi-check-circle ms-2"></i>
            </button>
            <a href="index.php?page=login&role=siswa" class="btn btn-light w-100 py-3 rounded-4 fw-bold text-secondary mb-2">
                Sudah Punya Akun? Login
            </a>
            <a href="index.php?page=landing" class="btn btn-link w-100 text-decoration-none text-secondary small">
                Kembali ke Beranda
            </a>
        </form>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
    });
</script>

<?php require 'views/layouts/footer.php'; ?>

