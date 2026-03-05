<?php $title = 'Student Dashboard';
require 'views/layouts/header.php'; ?>

<div class="student-sky">
<nav class="navbar navbar-expand-lg sticky-top glass-nav nav-vibrant px-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-megaphone-fill me-2"></i>Pengaduan Sarana
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <div class="d-flex align-items-center me-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span class="nav-link p-0 fw-semibold">Halo, <?php echo e($_SESSION['nama']); ?></span>
                    </div>
                </li>
                <li class="nav-item">
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
            <div class="glass-card bg-primary p-5 text-white border-0 overflow-hidden position-relative" style="border: 1px solid rgba(255,255,255,0.2) !important;">
                <div class="position-relative z-1">
                    <h2 class="fw-800 mb-2">Halo, <?php echo e($_SESSION['nama']); ?>! 👋</h2>
                    <p class="lead mb-4 opacity-75">Ada keluhan sarana di sekolah? Laporkan sekarang agar segera kami tangani.</p>
                    <a href="index.php?page=siswa_lapor" class="btn btn-light btn-lg rounded-pill fw-bold text-primary px-4 shadow">
                        <i class="bi bi-plus-circle-fill me-2"></i>Buat Laporan Baru
                    </a>
                </div>
                <!-- Abstract patterns -->
                <div class="position-absolute bottom-0 end-0 opacity-10" style="transform: translate(10%, 20%);">
                    <i class="bi bi-megaphone-fill" style="font-size: 200px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="row">
        <div class="col-12">
            <div class="glass-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
                    <div>
                        <h4 class="mb-0 fw-bold">Riwayat Laporan Anda</h4>
                        <p class="text-muted small mb-0">Daftar aspirasi yang telah Anda kirimkan.</p>
                    </div>
                    <span class="badge bg-light text-dark fw-medium px-3 py-2">10 Terakhir</span>
                </div>

                <?php if (empty($aspirasi)): ?>
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                            <i class="bi bi-inbox fs-1 text-muted"></i>
                        </div>
                        <h5 class="fw-bold">Belum Ada Laporan</h5>
                        <p class="text-muted">Laporan yang Anda buat akan muncul di sini.</p>
                    </div>
                <?php
else: ?>
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kategori & Tempat</th>
                                    <th>Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($aspirasi as $a): ?>
                                    <tr>
                                        <td><span class="text-muted"><?php echo e($a['tanggal']); ?></span></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?php echo e($a['judul']); ?></div>
                                            <div class="text-muted small"><?php echo e($a['nama_kategori']); ?></div>
                                        </td>
                                        <td>
                                            <?php
        $statusClass = 'bg-baru';
        if ($a['status'] == 'diproses')
            $statusClass = 'bg-diproses';
        if ($a['status'] == 'selesai')
            $statusClass = 'bg-selesai';
?>
                                            <span class="badge-premium <?php echo $statusClass; ?> rounded-pill px-3"><?php echo ucfirst($a['status']); ?></span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="index.php?page=siswa_detail&id=<?php echo $a['id_aspirasi']; ?>" class="btn btn-sm btn-light rounded-pill px-3 fw-semibold">Detail</a>
                                                <?php if ($a['status'] == 'baru'): ?>
                                                    <form action="index.php?page=siswa_hapus" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                        <input type="hidden" name="id" value="<?php echo $a['id_aspirasi']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold">Hapus</button>
                                                    </form>
                                                <?php
        endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
    endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php
endif; ?>
            </div>
        </div>
    </div>
</div>

</div>
<?php require 'views/layouts/footer.php'; ?>

