<?php $title = 'Admin Dashboard';
require 'views/layouts/header.php'; ?>

<div class="admin-sky">
<nav class="navbar navbar-expand-lg sticky-top glass-nav nav-admin-vibrant px-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=admin_dashboard">
            <i class="bi bi-shield-lock-fill me-2"></i>Admin Panel
        </a>
        <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link active fw-semibold" href="index.php?page=admin_dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=admin_list">Data Aspirasi</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=admin_users">Kelola User</a></li>
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
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success glass-card border-0 mb-4 py-3 animate-up" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Berhasil!</h6>
                    <p class="mb-0 small opacity-75"><?php echo $_SESSION['success']; ?></p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php
endif; ?>

    <div class="row mb-5">
        <div class="col-12">
            <h2 class="fw-800 mb-1 mt-3">Statistik Aspirasi</h2>
            <p class="text-secondary">Ringkasan laporan sarana sekolah saat ini.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="glass-card stat-card p-4 h-100" style="color: #ef4444;">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="icon-box bg-danger bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-megaphone fs-3 text-danger"></i>
                    </div>
                </div>
                <h6 class="text-secondary mb-1">Aspirasi Baru</h6>
                <h2 class="fw-800 mb-0"><?php echo $stats['baru'] ?? 0; ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card stat-card p-4 h-100" style="color: #f59e0b;">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="icon-box bg-warning bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-gear-wide-connected fs-3 text-warning"></i>
                    </div>
                </div>
                <h6 class="text-secondary mb-1">Dalam Proses</h6>
                <h2 class="fw-800 mb-0"><?php echo $stats['diproses'] ?? 0; ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="glass-card stat-card p-4 h-100" style="color: #10b981;">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="icon-box bg-success bg-opacity-10 p-3 rounded-4">
                        <i class="bi bi-check2-all fs-3 text-success"></i>
                    </div>
                </div>
                <h6 class="text-secondary mb-1">Selesai</h6>
                <h2 class="fw-800 mb-0"><?php echo $stats['selesai'] ?? 0; ?></h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="glass-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
                    <div>
                        <h5 class="mb-0 fw-bold">Aspirasi Masuk Terakhir</h5>
                        <p class="text-muted small mb-0">5 laporan terbaru dari siswa.</p>
                    </div>
                    <a href="index.php?page=admin_list" class="btn btn-premium btn-sm">Lihat Semua</a>
                </div>

                <div class="table-responsive">
                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Siswa</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_slice($recent_aspirasi, 0, 5) as $a): ?>
                                <tr>
                                    <td><span class="text-muted"><?php echo e($a['tanggal']); ?></span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <span class="fw-bold"><?php echo e($a['nama_siswa']); ?></span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark fw-medium px-3 py-2"><?php echo e($a['nama_kategori']); ?></span></td>
                                    <td><span class="fw-medium"><?php echo e($a['judul']); ?></span></td>
                                    <td>
                                        <?php
    $statusClass = 'bg-baru';
    if ($a['status'] == 'diproses')
        $statusClass = 'bg-diproses';
    if ($a['status'] == 'selesai')
        $statusClass = 'bg-selesai';
?>
                                        <span class="badge-premium <?php echo $statusClass; ?>"><?php echo ucfirst($a['status']); ?></span>
                                    </td>
                                    <td>
                                        <a href="index.php?page=admin_detail&id=<?php echo $a['id_aspirasi']; ?>" class="btn btn-sm btn-light rounded-pill px-3 fw-semibold">Detail</a>
                                    </td>
                                </tr>
                            <?php
endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php require 'views/layouts/footer.php'; ?>

