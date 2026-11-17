<?php
require 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$r  = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id = $id");
$m  = mysqli_fetch_assoc($r);
if (!$m) {
    $_SESSION['pesan'] = 'Data tidak ditemukan.';
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach (array('nim','nama','jenis_kelamin','jurusan','angkatan','telepon','alamat') as $k) {
        $m[$k] = isset($_POST[$k]) ? trim($_POST[$k]) : '';
    }
    if ($m['jenis_kelamin'] != 'Laki-laki' && $m['jenis_kelamin'] != 'Perempuan') {
        $m['jenis_kelamin'] = 'Laki-laki';
    }

    if ($m['nim'] == '' || $m['nama'] == '' || $m['jurusan'] == '' || $m['angkatan'] == '') {
        $error = 'NIM, nama, jurusan, dan angkatan wajib diisi.';
    } else {
        $sql = "UPDATE mahasiswa SET
                  nim = '" . esc($m['nim']) . "',
                  nama = '" . esc($m['nama']) . "',
                  jenis_kelamin = '" . esc($m['jenis_kelamin']) . "',
                  jurusan = '" . esc($m['jurusan']) . "',
                  angkatan = " . (int)$m['angkatan'] . ",
                  telepon = '" . esc($m['telepon']) . "',
                  alamat = '" . esc($m['alamat']) . "'
                WHERE id = $id";
        if (mysqli_query($koneksi, $sql)) {
            $_SESSION['pesan'] = 'Data mahasiswa berhasil diperbarui.';
            header('Location: index.php');
            exit;
        } elseif (mysqli_errno($koneksi) == 1062) {
            $error = 'NIM sudah dipakai mahasiswa lain.';
        } else {
            $error = 'Gagal memperbarui data.';
        }
    }
}
$aksi = 'Simpan Perubahan';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Edit Mahasiswa</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap" style="max-width:560px">
  <h2>Edit Mahasiswa</h2>
  <?php if ($error) echo '<div class="err">' . e($error) . '</div>'; ?>
  <?php include '_form.php'; ?>
</div>
</body>
</html>
