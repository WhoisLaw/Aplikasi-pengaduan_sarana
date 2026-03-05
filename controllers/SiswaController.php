<?php
require_once 'models/Aspirasi.php';
require_once 'models/Feedback.php';
require_once 'helpers/auth.php';

class SiswaController
{
    private $aspirasiModel;
    private $feedbackModel;

    public function __construct($db)
    {
        checkRole('siswa');
        $this->aspirasiModel = new Aspirasi($db);
        $this->feedbackModel = new Feedback($db);
    }

    public function dashboard()
    {
        $aspirasi = $this->aspirasiModel->getBySiswa($_SESSION['id_user']);
        $stats = $this->aspirasiModel->getStats(); // Simplified for student view
        require 'views/siswa/dashboard.php';
    }

    public function lapor()
    {
        require 'views/siswa/lapor.php';
    }

    public function createAspirasi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_kategori = $_POST['id_kategori'];
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $foto = null;

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array(strtolower($ext), $allowed)) {
                    $filename = time() . '_' . uniqid() . '.' . $ext;
                    $target = 'assets/uploads/aspirasi/' . $filename;

                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
                        $foto = $filename;
                    }
                }
            }

            if ($this->aspirasiModel->create($_SESSION['id_user'], $id_kategori, $judul, $deskripsi, $foto)) {
                header("Location: index.php?page=siswa_dashboard&success=1");
            }
            else {
                header("Location: index.php?page=siswa_dashboard&error=1");
            }
            exit();
        }
    }

    public function detailAspirasi($id)
    {
        $detail = $this->aspirasiModel->getDetail($id);
        if ($detail['id_user'] != $_SESSION['id_user']) {
            header("Location: index.php?page=siswa_dashboard");
            exit();
        }
        $feedbacks = $this->feedbackModel->getByAspirasi($id);
        require 'views/siswa/detail.php';
    }

    public function hapusAspirasi()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=siswa_dashboard");
            exit();
        }

        $id = $_POST['id'] ?? 0;
        $detail = $this->aspirasiModel->getDetail($id);

        // Ensure only the owner can delete, and only if status is still 'baru'
        if ($detail && $detail['id_user'] == $_SESSION['id_user'] && $detail['status'] == 'baru') {
            if ($this->aspirasiModel->delete($id)) {
                $_SESSION['success'] = "Laporan berhasil dihapus.";
            }
            else {
                $_SESSION['error'] = "Gagal menghapus laporan.";
            }
        }
        else {
            $_SESSION['error'] = "Anda tidak memiliki akses untuk menghapus laporan ini atau laporan sedang diproses.";
        }

        header("Location: index.php?page=siswa_dashboard");
        exit();
    }
}
?>
