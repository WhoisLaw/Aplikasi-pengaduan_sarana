<?php $title = 'Kelola User';
require 'views/layouts/header.php'; ?>

<div class="admin-sky">
<nav class="navbar navbar-expand-lg sticky-top glass-nav nav-admin-vibrant px-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=admin_dashboard">
            <i class="bi bi-shield-lock-fill me-2"></i>Admin Panel
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php?page=admin_dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=admin_list">Data Aspirasi</a></li>
                <li class="nav-item"><a class="nav-link active fw-semibold" href="index.php?page=admin_users">Kelola User</a></li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-glass btn-sm rounded-pill px-3" href="index.php?page=logout">
                        <i class="bi bi-box-arrow-right me-1"></i>Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row mb-5 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-800 mb-1">Kelola Pengguna</h2>
            <p class="text-secondary">Tambah, ubah, atau hapus pengguna aplikasi.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="index.php?page=admin_user_add" class="btn btn-premium px-4 py-2 rounded-pill shadow-sm">
                <i class="bi bi-person-plus-fill me-2"></i>Tambah User Baru
            </a>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success glass-card border-0 mb-4 py-3 animate-up" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Berhasil!</h6>
                    <p class="mb-0 small opacity-75">
                        <?php
    if ($_GET['success'] == 'user_added')
        echo "User berhasil ditambahkan.";
    if ($_GET['success'] == 'user_updated')
        echo "Data user berhasil diperbarui.";
    if ($_GET['success'] == 'user_deleted')
        echo "User berhasil dihapus.";
?>
                    </p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger glass-card border-0 mb-4 py-3 animate-up" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-danger"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Gagal!</h6>
                    <p class="mb-0 small opacity-75">
                        <?php
    if ($_GET['error'] == 'self_delete')
        echo "Anda tidak dapat menghapus akun Anda sendiri.";
    if ($_GET['error'] == 'failed')
        echo "Terjadi kesalahan saat memproses data.";
?>
                    </p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
endif; ?>

    <div class="glass-card p-4 border-0">
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Tanggal Terdaftar</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr><td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-people fs-1 d-block mb-3 opacity-25"></i>
                                Tidak ada data user.
                            </div>
                        </td></tr>
                    <?php
else: ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td><span class="text-muted small">#<?php echo $u['id_user']; ?></span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <span class="fw-bold"><?php echo e($u['nama']); ?></span>
                                    </div>
                                </td>
                                <td><code class="px-2 py-1 bg-light rounded text-dark"><?php echo e($u['username']); ?></code></td>
                                <td>
                                    <?php if ($u['role'] == 'admin'): ?>
                                        <span class="badge bg-danger bg-opacity-10 text-danger border-0 px-3 py-2">
                                            <i class="bi bi-shield-check me-1"></i>ADMIN
                                        </span>
                                    <?php
        else: ?>
                                        <span class="badge bg-info bg-opacity-10 text-info border-0 px-3 py-2">
                                            <i class="bi bi-mortarboard me-1"></i>SISWA
                                        </span>
                                    <?php
        endif; ?>
                                </td>
                                <td><span class="text-muted small"><?php echo e($u['created_at']); ?></span></td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="index.php?page=admin_user_edit&id=<?php echo $u['id_user']; ?>" class="btn btn-sm btn-light rounded-pill px-3 fw-semibold">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        <?php if ($u['id_user'] != $_SESSION['user_id']): ?>
                                            <a href="index.php?page=admin_user_delete&id=<?php echo $u['id_user']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                <i class="bi bi-trash me-1"></i>Hapus
                                            </a>
                                        <?php
        endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php
    endforeach; ?>
                    <?php
endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<?php require 'views/layouts/footer.php'; ?>
