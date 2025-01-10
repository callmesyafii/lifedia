<?php
// Include file koneksi database
include "../database.php";

// Cek apakah parameter id_artikel telah diterima
if (isset($_GET['id'])) {
    // Ambil nilai id_artikel dari parameter
    $id_asuransi = $_GET['id'];

    // Query untuk menghapus artikel dari database
    $sql = "DELETE FROM penyediaasuransi WHERE Id = $id_asuransi";

    // Eksekusi query
    if ($db->query($sql) === TRUE) {
        // Redirect kembali ke halaman artikelAdmin.php dengan menambahkan parameter untuk menampilkan alert
        header("Location: asuransi.php?deleted=1");
        exit();
    } else {
        // Artikel gagal dihapus, tampilkan pesan error
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    // Tutup koneksi database
    $db->close();
} else {
    // Jika parameter id_artikel tidak diterima, tampilkan pesan error
    echo "ID asuransi tidak ditemukan.";
}
?>