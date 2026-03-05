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
    header("Location: index.php?page=login");
    exit();
}

function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
