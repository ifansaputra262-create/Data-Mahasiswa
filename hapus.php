<?php
require 'config.php';

// Hapus hanya lewat POST supaya tidak terhapus tak sengaja lewat link
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    if (mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id = $id")) {
        $_SESSION['pesan'] = 'Data mahasiswa berhasil dihapus.';
    } else {
        $_SESSION['pesan'] = 'Gagal menghapus data.';
    }
}
header('Location: index.php');
exit;
?>
