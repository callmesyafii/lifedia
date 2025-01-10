<?php
// Include file koneksi database
include "../database.php";

// Cek apakah parameter id_artikel telah diterima
if (isset($_POST['Id'])) {
    // Ambil nilai id_artikel dari parameter
    $id_asuransi = $_POST['Id'];

    // Ambil data lainnya dari form
    $namaMerek = $_POST['namaMerek'];
    $paketAsuransi = $_POST['paketAsuransi'];
    $besaranPolis = $_POST['besaranPolis'];
    $besaranTanggungan = $_POST['besaranTanggungan'];

    // Query untuk mengupdate artikel di database
    $sql = "UPDATE penyediaasuransi SET namaMerek = '$namaMerek', paketAsuransi = '$paketAsuransi', besaranPolis = '$besaranPolis', besaranTanggungan = '$besaranTanggungan' WHERE Id = $id_asuransi";

    // Eksekusi query
    if ($db->query($sql) === TRUE) {
        // Redirect kembali ke halaman artikelAdmin.php dengan menambahkan parameter untuk menampilkan alert
        header("Location: asuransi.php?updated=1");
        exit();
    } else {
        // Artikel gagal diupdate, tampilkan pesan error
        echo "Error: " . $sql . "<br>" . $db->error;
    }

    // Tutup koneksi database
    $db->close();
} else {
    // Jika parameter id_artikel tidak diterima, tampilkan pesan error
    echo "ID asuransi tidak ditemukan.";
}
?>