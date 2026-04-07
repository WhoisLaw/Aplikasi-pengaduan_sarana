<?php $title = 'Detail Aspirasi';
require 'views/layouts/header.php'; ?>

<div class="student-sky">
<nav class="navbar navbar-expand-lg sticky-top glass-nav nav-vibrant px-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=siswa_dashboard">
            <i class="bi bi-megaphone-fill me-2"></i>Pengaduan Sarana
        </a>
        <div class="ms-auto">
            <a class="btn btn-glass btn-sm rounded-pill px-3 fw-semibold" href="index.php?page=siswa_dashboard">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="glass-card p-4 p-md-5 mb-4 border-0">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start mb-4 gap-3">
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-light text-secondary rounded-pill px-3 py-1 small me-2">#<?php echo $detail['id_aspirasi']; ?></span>
                            <span class="text-muted small fw-medium"><i class="bi bi-calendar3 me-2"></i><?php echo e($detail['tanggal']); ?></span>
                        </div>
                        <h1 class="fw-800 mt-0 text-dark"><?php echo e($detail['judul']); ?></h1>
                        <div class="d-flex align-items-center gap-2 mt-2">
                             <span class="badge bg-secondary bg-opacity-10 text-secondary border-0 px-3 py-2 fw-medium">
                                <i class="bi bi-tag-fill me-1"></i><?php echo e($detail['nama_kategori']); ?>
                            </span>
                        </div>
                    </div>
                    <?php
$statusClass = 'bg-baru';
if ($detail['status'] == 'diproses')
    $statusClass = 'bg-diproses';
if ($detail['status'] == 'selesai')
    $statusClass = 'bg-selesai';
?>
                    <span class="badge-premium <?php echo $statusClass; ?> px-4 py-2" style="font-size: 0.9rem;"><?php echo ucfirst($detail['status']); ?></span>
                </div>
                
                <div class="p-4 bg-light rounded-4 mb-5 border-start border-primary border-4">
                    <h6 class="fw-bold mb-3 text-secondary small text-uppercase" style="letter-spacing: 1px;">Isi Aspirasi Anda</h6>
                    <p class="mb-0 text-dark leading-relaxed" style="white-space: pre-wrap; font-size: 1.1rem;"><?php echo e($detail['deskripsi']); ?></p>
                    <?php if ($detail['foto']): ?>
                        <div class="mt-4">
                            <label class="form-label fw-bold small text-secondary mb-3">FOTO LAMPIRAN</label>
                            <div class="position-relative overflow-hidden rounded-4 shadow-sm" style="max-width: 100%;">
                                <?php if (strpos($detail['foto'], 'data:image') === 0): ?>
                                    <img src="<?php echo $detail['foto']; ?>" class="img-fluid" alt="Foto Aspirasi">
                                <?php else: ?>
                                    <img src="assets/uploads/aspirasi/<?php echo $detail['foto']; ?>" class="img-fluid" alt="Foto Aspirasi">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
endif; ?>
                </div>

                <hr class="my-5 opacity-10">

                <h4 class="fw-800 mb-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="bi bi-chat-right-text-fill text-primary"></i>
                    </div>
                    Tanggapan Dari Sekolah
                </h4>
                
                <?php if (empty($feedbacks)): ?>
                    <div class="text-center py-5 glass-card bg-light border-0 animate-up">
                        <i class="bi bi-hourglass-split fs-1 d-block mb-3 text-muted"></i>
                        <p class="text-secondary mb-0">Laporan Anda sedang menunggu peninjauan dari pihak sekolah.</p>
                        <p class="small text-muted">Mohon cek kembali secara berkala.</p>
                    </div>
                <?php
else: ?>
                    <div class="timeline ps-2 pe-2">
                        <?php foreach ($feedbacks as $f): ?>
                            <div class="glass-card p-4 mb-4 border-0 position-relative animate-up" style="background: white;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 small fw-bold">Official Response</span>
                                    <small class="text-muted fw-medium"><?php echo e($f['tanggal_feedback']); ?></small>
                                </div>
                                <p class="mb-0 text-dark leading-relaxed" style="font-size: 1.05rem;"><?php echo e($f['isi_feedback']); ?></p>
                                <?php if ($f['foto']): ?>
                                    <div class="mt-4">
                                        <label class="form-label fw-bold small text-secondary mb-2">BUKTI PERBAIKAN / FOTO</label>
                                        <?php if (strpos($f['foto'], 'data:image') === 0): ?>
                                            <img src="<?php echo $f['foto']; ?>" class="img-fluid rounded-4 shadow-sm d-block" style="max-height: 300px;" alt="Foto Feedback">
                                        <?php else: ?>
                                            <img src="assets/uploads/feedback/<?php echo $f['foto']; ?>" class="img-fluid rounded-4 shadow-sm d-block" style="max-height: 300px;" alt="Foto Feedback">
                                        <?php endif; ?>
                                    </div>
                                <?php
        endif; ?>
                            </div>
                        <?php
    endforeach; ?>
                    </div>
                <?php
endif; ?>
            </div>
        </div>
    </div>
</div>

</div>
<?php require 'views/layouts/footer.php'; ?>
