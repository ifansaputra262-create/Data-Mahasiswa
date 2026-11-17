<?php
require 'config.php';

$error = '';
$m = array('nim'=>'','nama'=>'','jenis_kelamin'=>'Laki-laki','jurusan'=>'',
           'angkatan'=>date('Y'),'telepon'=>'','alamat'=>'');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($m as $k => $v) {
        $m[$k] = isset($_POST[$k]) ? trim($_POST[$k]) : '';
    }
    if ($m['jenis_kelamin'] != 'Laki-laki' && $m['jenis_kelamin'] != 'Perempuan') {
        $m['jenis_kelamin'] = 'Laki-laki';
    }

    if ($m['nim'] == '' || $m['nama'] == '' || $m['jurusan'] == '' || $m['angkatan'] == '') {
        $error = 'NIM, nama, jurusan, dan angkatan wajib diisi.';
    } else {
        $sql = "INSERT INTO mahasiswa (nim, nama, jenis_kelamin, jurusan, angkatan, telepon, alamat) VALUES ('"
             . esc($m['nim']) . "','" . esc($m['nama']) . "','" . esc($m['jenis_kelamin']) . "','"
             . esc($m['jurusan']) . "'," . (int)$m['angkatan'] . ",'"
             . esc($m['telepon']) . "','" . esc($m['alamat']) . "')";
        if (mysqli_query($koneksi, $sql)) {
            $_SESSION['pesan'] = 'Data mahasiswa berhasil ditambahkan.';
            header('Location: index.php');
            exit;
        } elseif (mysqli_errno($koneksi) == 1062) {
            $error = 'NIM sudah terdaftar.';
        } else {
            $error = 'Gagal menyimpan data.';
        }
    }
}
$aksi = 'Simpan';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Mahasiswa</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap" style="max-width:560px">
  <h2>Tambah Mahasiswa</h2>
  <?php if ($error) echo '<div class="err">' . e($error) . '</div>'; ?>
  <?php include '_form.php'; ?>
</div>
</body>
</html>
