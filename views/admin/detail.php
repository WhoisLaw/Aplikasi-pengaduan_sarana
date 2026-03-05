<?php $title = 'Detail Pengaduan';
require 'views/layouts/header.php'; ?>

<div class="admin-sky">
<nav class="navbar navbar-expand-lg sticky-top glass-nav nav-admin-vibrant px-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=admin_dashboard">
            <i class="bi bi-shield-lock-fill me-2"></i>Admin Panel
        </a>
        <div class="ms-auto">
            <a class="btn btn-glass btn-sm rounded-pill px-3 fw-semibold" href="index.php?page=admin_list">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="glass-card p-4 mb-4 border-0">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="badge bg-light text-secondary rounded-pill px-3 py-2">ID: #<?php echo $detail['id_aspirasi']; ?></span>
                    <span class="text-muted small fw-medium"><i class="bi bi-calendar3 me-2"></i><?php echo e($detail['tanggal']); ?></span>
                </div>
                
                <h2 class="fw-800 mb-2"><?php echo e($detail['judul']); ?></h2>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="badge bg-primary bg-opacity-10 text-primary border-0 px-3 py-2">
                        <i class="bi bi-person-fill me-1"></i><?php echo e($detail['nama_siswa']); ?>
                    </span>
                    <span class="badge bg-secondary bg-opacity-10 text-secondary border-0 px-3 py-2">
                        <i class="bi bi-tag-fill me-1"></i><?php echo e($detail['nama_kategori']); ?>
                    </span>
                </div>
                
                <div class="p-4 bg-light rounded-4 mb-4">
                    <h6 class="fw-bold mb-3 text-secondary small text-uppercase" style="letter-spacing: 1px;">Deskripsi Laporan</h6>
                    <p class="mb-0 text-dark leading-relaxed" style="white-space: pre-wrap; font-size: 1.05rem;"><?php echo e($detail['deskripsi']); ?></p>
                    <?php if ($detail['foto']): ?>
                        <div class="mt-4">
                            <label class="form-label fw-bold small text-secondary mb-3">LAMPIRAN FOTO</label>
                            <div class="position-relative overflow-hidden rounded-4 shadow-sm" style="max-width: 100%;">
                                <img src="assets/uploads/aspirasi/<?php echo $detail['foto']; ?>" class="img-fluid" alt="Foto Aspirasi">
                            </div>
                        </div>
                    <?php
endif; ?>
                </div>

                <hr class="my-5 opacity-10">

                <h4 class="fw-800 mb-4 mx-2"><i class="bi bi-chat-right-dots-fill me-3 text-primary"></i>Riwayat Feedback</h4>
                <?php if (empty($feedbacks)): ?>
                    <div class="text-center py-5 opacity-50">
                        <i class="bi bi-chat-square-quote fs-1 d-block mb-3"></i>
                        <p class="italic">Belum ada feedback yang diberikan.</p>
                    </div>
                <?php
else: ?>
                    <div class="timeline ps-3 pe-2">
                        <?php foreach ($feedbacks as $f): ?>
                            <div class="glass-card p-4 mb-4 border-0 position-relative animate-up" style="background: white;">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 small">Official Response</span>
                                    <small class="text-muted fw-medium"><?php echo e($f['tanggal_feedback']); ?></small>
                                </div>
                                <p class="mb-0 text-dark leading-relaxed"><?php echo e($f['isi_feedback']); ?></p>
                                <?php if ($f['foto']): ?>
                                    <div class="mt-3">
                                        <img src="assets/uploads/feedback/<?php echo $f['foto']; ?>" class="img-fluid rounded-3 shadow-sm" style="max-height: 250px;" alt="Foto Feedback">
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

        <div class="col-lg-4">
            <!-- Update Status -->
            <div class="glass-card p-4 mb-4 border-0 h-auto">
                <h5 class="fw-800 mb-4 d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="bi bi-arrow-repeat text-warning"></i>
                    </div>
                    Update Status
                </h5>
                <form action="index.php?page=admin_update_status" method="POST">
                    <input type="hidden" name="id_aspirasi" value="<?php echo $detail['id_aspirasi']; ?>">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary mb-2">PILIH STATUS BARU</label>
                        <select name="status" class="form-select bg-light border-0 py-3 rounded-3">
                            <option value="baru" <?php echo($detail['status'] == 'baru') ? 'selected' : ''; ?>>Baru</option>
                            <option value="diproses" <?php echo($detail['status'] == 'diproses') ? 'selected' : ''; ?>>Diproses</option>
                            <option value="selesai" <?php echo($detail['status'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-premium w-100 py-3">
                        Simpan Perubahan <i class="bi bi-check2 ms-2"></i>
                    </button>
                </form>
            </div>

            <!-- Add Feedback -->
            <div class="glass-card p-4 border-0">
                <h5 class="fw-800 mb-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="bi bi-send-fill text-primary"></i>
                    </div>
                    Berikan Tanggapan
                </h5>
                <form action="index.php?page=admin_add_feedback" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_aspirasi" value="<?php echo $detail['id_aspirasi']; ?>">
                    <div class="mb-4">
                        <textarea name="isi_feedback" class="form-control bg-light border-0 py-3 rounded-3" rows="5" required placeholder="Tulis tanggapan atau instruksi perbaikan..."></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary mb-2">LAMPIRAN FOTO (OPSIONAL)</label>
                        <input type="file" class="form-control bg-light border-0 py-2 rounded-3" name="foto" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-premium w-100 py-3" style="background: #1e293b;">
                        Kirim Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<?php require 'views/layouts/footer.php'; ?>

