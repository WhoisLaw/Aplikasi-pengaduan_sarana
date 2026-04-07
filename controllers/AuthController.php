<?php
require_once 'models/User.php';
require_once 'helpers/auth.php';

class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
    }

    public function login()
    {
        redirectIfLoggedIn();

        $role_req = $_GET['role'] ?? ($_POST['role'] ?? 'siswa');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->login($username, $password);

            if ($user && $user['role'] === $role_req) {
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['success'] = "Login Berhasil! Selamat datang, " . $user['nama'];
                session_regenerate_id(true);

                // Persistent Auth for Serverless
                $signature = md5($user['id_user'] . $user['username'] . $user['password']);
                setcookie('auth_token', $user['id_user'] . '|' . $signature, time() + (86400 * 30), '/');

                if ($user['role'] === 'admin') {
                    header("Location: index.php?page=admin_dashboard");
                }
                else {
                    header("Location: index.php?page=siswa_dashboard");
                }
                exit();
            }
            else {
                $error = "Username atau password salah untuk login " . ucfirst($role_req) . "!";
                require 'views/auth/login.php';
            }
        }
        else {
            require 'views/auth/login.php';
        }
    }

    public function logout()
    {
        logout();
    }

    public function register()
    {
        redirectIfLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama'] ?? '';
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->userModel->register($nama, $username, $password)) {
                $_SESSION['success'] = "Registrasi Berhasil! Silahkan login.";
                header("Location: index.php?page=login&role=siswa");
                exit();
            }
            else {
                $error = "Username sudah terdaftar. Silahkan gunakan username lain.";
                require 'views/auth/register.php';
            }
        }
        else {
            require 'views/auth/register.php';
        }
    }
}
?>
