<?php
session_start();

function isLoggedIn()
{
    return isset($_SESSION['id_user']);
}

function checkRole($role)
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header("Location: index.php?page=login");
        exit();
    }
}

function redirectIfLoggedIn()
{
    if (isLoggedIn()) {
        if ($_SESSION['role'] === 'admin') {
            header("Location: index.php?page=admin_dashboard");
        }
        else {
            header("Location: index.php?page=siswa_dashboard");
        }
        exit();
    }
}

function logout()
{
    session_destroy();
    setcookie('auth_token', '', time() - 3600, '/');
    header("Location: index.php?page=login");
    exit();
}

function restoreSessionIfMissing($db) {
    if (!isset($_SESSION['id_user']) && isset($_COOKIE['auth_token'])) {
        $parts = explode('|', $_COOKIE['auth_token']);
        if (count($parts) === 2) {
            list($id_user, $signature) = $parts;
            $stmt = $db->prepare("SELECT * FROM users WHERE id_user = ?");
            $stmt->execute([$id_user]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $expected = md5($user['id_user'] . $user['username'] . $user['password']);
                if ($signature === $expected) {
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['role'] = $user['role'];
                } else {
                    setcookie('auth_token', '', time() - 3600, '/');
                }
            } else {
                setcookie('auth_token', '', time() - 3600, '/');
            }
        }
    }
}

function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
