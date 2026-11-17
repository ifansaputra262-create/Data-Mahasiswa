<?php
session_start();

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db_mahasiswa';

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}
mysqli_set_charset($koneksi, 'utf8');

// Escape untuk dimasukkan ke query SQL
function esc($s) {
    global $koneksi;
    return mysqli_real_escape_string($koneksi, trim($s));
}
// Escape untuk ditampilkan di HTML
function e($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
?>
