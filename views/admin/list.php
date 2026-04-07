<?php $title = 'Data Aspirasi';
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
                <li class="nav-item"><a class="nav-link active fw-semibold" href="index.php?page=admin_list">Data Aspirasi</a></li>
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
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="fw-800 mb-1">Daftar Aspirasi</h2>
            <p class="text-secondary">Kelola dan tinjau semua aspirasi dari siswa.</p>
        </div>
    </div>

    <div class="glass-card p-4 mb-5 border-0">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                <i class="bi bi-filter-right fs-4"></i>
            </div>
            <h5 class="fw-bold mb-0">Filter Data</h5>
        </div>
        <form action="index.php" method="GET" class="row g-3">
            <input type="hidden" name="page" value="admin_list">
            
            <div class="col-md-4 col-lg-3">
                <label class="form-label fw-bold small text-secondary">STATUS</label>
                <select name="status" class="form-select bg-light border-0 py-2 rounded-3">
                    <option value="">Semua Status</option>
                    <option value="baru" <?php echo($filters['status'] == 'baru') ? 'selected' : ''; ?>>Baru</option>
                    <option value="diproses" <?php echo($filters['status'] == 'diproses') ? 'selected' : ''; ?>>Diproses</option>
                    <option value="selesai" <?php echo($filters['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                </select>
            </div>
            
            <div class="col-md-4 col-lg-3">
                <label class="form-label fw-bold small text-secondary">KATEGORI</label>
                <select name="kategori" class="form-select bg-light border-0 py-2 rounded-3">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($kategori as $k): ?>
                        <option value="<?php echo $k['id_kategori']; ?>" <?php echo($filters['kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                            <?php echo e($k['nama_kategori']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-4 col-lg-3">
                <label class="form-label fw-bold small text-secondary">SISWA</label>
                <select name="id_user" class="form-select bg-light border-0 py-2 rounded-3">
                    <option value="">Semua Siswa</option>
                    <?php foreach ($siswa as $s): ?>
                        <option value="<?php echo $s['id_user']; ?>" <?php echo($filters['id_user'] == $s['id_user']) ? 'selected' : ''; ?>>
                            <?php echo e($s['nama']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-4 col-lg-3">
                <label class="form-label fw-bold small text-secondary">BULAN</label>
                <select name="bulan" class="form-select bg-light border-0 py-2 rounded-3">
                    <option value="">Semua Bulan</option>
                    <?php
                    $months = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                    foreach ($months as $num => $name): ?>
                        <option value="<?php echo $num; ?>" <?php echo($filters['bulan'] == $num) ? 'selected' : ''; ?>><?php echo $name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 col-lg-3">
                <label class="form-label fw-bold small text-secondary">TANGGAL SPESIFIK</label>
                <input type="date" name="tanggal" class="form-control bg-light border-0 py-2 rounded-3" value="<?php echo $filters['tanggal']; ?>">
            </div>
            
            <div class="col-md-4 col-lg-3 align-self-end d-flex gap-2">
                <button type="submit" class="btn btn-premium flex-fill py-2 rounded-3"><i class="bi bi-funnel-fill me-1"></i> Terapkan</button>
                <a href="index.php?page=admin_list" class="btn btn-light flex-fill py-2 rounded-3 fw-bold text-secondary" title="Reset Filter">
                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <div class="glass-card p-4 border-0">
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Kategori</th>
                        <th>Judul Laporan</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($aspirasi)): ?>
                        <tr><td colspan="6" class="text-center py-5">
                            <div class="text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                Tidak ada data ditemukan.
                            </div>
                        </td></tr>
                    <?php
else: ?>
                        <?php foreach ($aspirasi as $a): ?>
                            <tr>
                                <td><span class="text-muted small"><?php echo e($a['tanggal']); ?></span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <span class="fw-bold"><?php echo e($a['nama_siswa']); ?></span>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark fw-medium px-3 py-2"><?php echo e($a['nama_kategori']); ?></span></td>
                                <td><span class="fw-medium text-dark"><?php echo e($a['judul']); ?></span></td>
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
                                <td class="text-end">
                                    <a href="index.php?page=admin_detail&id=<?php echo $a['id_aspirasi']; ?>" class="btn btn-sm btn-light rounded-pill px-3 fw-semibold">Detail</a>
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

