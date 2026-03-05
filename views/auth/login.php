<?php
$title = 'Login - Pengaduan Sarana';
$role_req = $role_req ?? 'siswa';
require 'views/layouts/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; background: radial-gradient(circle at top right, rgba(99, 102, 241, 0.05), transparent);">
    <div class="glass-card p-5 w-100" style="max-width: 450px;">
        <div class="text-center mb-5">
            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-3 mb-3">
                <i class="bi bi-shield-lock-fill fs-2"></i>
            </div>
            <h2 class="fw-800 mb-1">Login <?php echo ucfirst((string)$role_req); ?></h2>
            <p class="text-secondary small">Akses khusus akun <strong><?php echo (string)$role_req; ?></strong></p>
        </div>

        <?php if (isset($error) && $error): ?>
            <div class="alert alert-danger border-0 rounded-4 mb-4 small py-3" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i><?php echo (string)$error; ?>
            </div>
        <?php
endif; ?>

        <form action="index.php?page=login" method="POST">
            <input type="hidden" name="role" value="<?php echo $role_req; ?>">
            <div class="mb-4">
                <label for="username" class="form-label fw-bold small text-secondary">USERNAME</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 px-3">
                        <i class="bi bi-person text-secondary"></i>
                    </span>
                    <input type="text" class="form-control bg-light border-0 py-3 rounded-end-4" id="username" name="username" required placeholder="Masukkan username">
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label fw-bold small text-secondary">PASSWORD</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 rounded-start-4 px-3">
                        <i class="bi bi-key text-secondary"></i>
                    </span>
                    <input type="password" class="form-control bg-light border-0 py-3" id="password" name="password" required placeholder="Masukkan password">
                    <button class="btn btn-light border-0 px-3 rounded-end-4" type="button" id="togglePassword">
                        <i class="bi bi-eye text-secondary" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-premium w-100 py-3 mb-3">
                Masuk Sekarang <i class="bi bi-arrow-right ms-2"></i>
            </button>
            <a href="index.php?page=landing" class="btn btn-light w-100 py-3 rounded-4 fw-bold text-secondary">
                Kembali ke Beranda
            </a>
        </form>
        
        <div class="mt-5 text-center">
            <?php if ($role_req === 'siswa'): ?>
                <p class="small text-secondary mb-0">Belum punya akun? <a href="index.php?page=register" class="text-primary fw-800 text-decoration-none">Daftar Sekarang</a></p>
            <?php
endif; ?>
        </div>
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

