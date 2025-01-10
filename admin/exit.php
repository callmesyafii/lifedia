<?php
// Mulai sesi
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Jika diinginkan untuk menghancurkan sesi, hapus juga cookie sesi
// Note: Ini akan menghancurkan sesi, bukan hanya data sesi
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Akhir sesi
session_destroy();

// Redirect ke halaman login atau halaman lain yang diinginkan
header("Location: login.php");
exit;
?>
