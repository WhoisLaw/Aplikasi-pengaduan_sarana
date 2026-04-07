<?php
require_once 'models/Aspirasi.php';
require_once 'models/Feedback.php';
require_once 'models/User.php';
require_once 'helpers/auth.php';

class AdminController
{
    private $aspirasiModel;
    private $feedbackModel;
    private $userModel;

    public function __construct($db)
    {
        checkRole('admin');
        $this->aspirasiModel = new Aspirasi($db);
        $this->feedbackModel = new Feedback($db);
        $this->userModel = new User($db);
    }

    public function dashboard()
    {
        $stats = $this->aspirasiModel->getStats();
        // Fetch recent aspirasi for dashboard preview
        $recent_aspirasi = $this->aspirasiModel->getAll();
        require 'views/admin/dashboard.php';
    }

    public function listAspirasi()
    {
        $filters = [
            'status' => $_GET['status'] ?? '',
            'tanggal' => $_GET['tanggal'] ?? '',
            'bulan' => $_GET['bulan'] ?? '',
            'kategori' => $_GET['kategori'] ?? '',
            'id_user' => $_GET['id_user'] ?? ''
        ];
        $aspirasi = $this->aspirasiModel->getAll($filters);

        // Fetch categories and students for filters
        $kategori_query = "SELECT * FROM kategori";
        $stmt_kat = $this->aspirasiModel->getDetail(0); // This is hacky, but the model has DB connection. 
        // Better: Fetch from Aspirasi model method
        $kategori = $this->fetchKategori();
        $siswa = $this->userModel->getSiswa();

        require 'views/admin/list.php';
    }

    private function fetchKategori()
    {
        // Simple internal fetch or add to model
        $db = (new Database())->connect();
        $stmt = $db->query("SELECT MIN(id_kategori) as id_kategori, nama_kategori FROM kategori GROUP BY nama_kategori ORDER BY nama_kategori ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aspirasi = $_POST['id_aspirasi'];
            $status = $_POST['status'];

            if ($this->aspirasiModel->updateStatus($id_aspirasi, $status)) {
                header("Location: index.php?page=admin_detail&id=" . $id_aspirasi . "&success=status");
            }
            else {
                header("Location: index.php?page=admin_detail&id=" . $id_aspirasi . "&error=status");
            }
            exit();
        }
    }

    public function addFeedback()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aspirasi = $_POST['id_aspirasi'];
            $isi_feedback = $_POST['isi_feedback'];
            $foto = null;

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                $allowed = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array(strtolower($ext), $allowed)) {
                    $file_content = file_get_contents($_FILES['foto']['tmp_name']);
                    $base64_image = base64_encode($file_content);
                    $foto = 'data:image/' . strtolower($ext) . ';base64,' . $base64_image;
                }
            }

            if ($this->feedbackModel->create($id_aspirasi, $isi_feedback, $foto)) {
                header("Location: index.php?page=admin_detail&id=" . $id_aspirasi . "&success=feedback");
            }
            else {
                header("Location: index.php?page=admin_detail&id=" . $id_aspirasi . "&error=feedback");
            }
            exit();
        }
    }

    public function detailAspirasi($id)
    {
        $detail = $this->aspirasiModel->getDetail($id);
        $feedbacks = $this->feedbackModel->getByAspirasi($id);
        require 'views/admin/detail.php';
    }

    // User Management Methods
    public function listUsers()
    {
        $users = $this->userModel->getAll();
        require 'views/admin/users/index.php';
    }

    public function addUser()
    {
        require 'views/admin/users/add.php';
    }

    public function storeUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if ($this->userModel->create($nama, $username, $password, $role)) {
                header("Location: index.php?page=admin_users&success=user_added");
            }
            else {
                header("Location: index.php?page=admin_user_add&error=username_exists");
            }
            exit();
        }
    }

    public function editUser($id)
    {
        $user = $this->userModel->getById($id);
        if (!$user) {
            header("Location: index.php?page=admin_users");
            exit();
        }
        require 'views/admin/users/edit.php';
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_user'];
            $nama = $_POST['nama'];
            $username = $_POST['username'];
            $role = $_POST['role'];
            $password = !empty($_POST['password']) ? $_POST['password'] : null;

            if ($this->userModel->update($id, $nama, $username, $role, $password)) {
                header("Location: index.php?page=admin_users&success=user_updated");
            }
            else {
                header("Location: index.php?page=admin_user_edit&id=$id&error=failed");
            }
            exit();
        }
    }

    public function deleteUser($id)
    {
        // Don't allow self-deletion
        if ($id == $_SESSION['id_user']) {
            header("Location: index.php?page=admin_users&error=self_delete");
            exit();
        }

        if ($this->userModel->delete($id)) {
            header("Location: index.php?page=admin_users&success=user_deleted");
        }
        else {
            header("Location: index.php?page=admin_users&error=failed");
        }
        exit();
    }
}
?>
