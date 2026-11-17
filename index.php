<?php
require 'config.php';

$pesan = isset($_SESSION['pesan']) ? $_SESSION['pesan'] : '';
unset($_SESSION['pesan']);

// ---- Pencarian ----
$cari  = isset($_GET['cari']) ? trim($_GET['cari']) : '';
$where = '';
if ($cari !== '') {
    $c = esc($cari);
    $where = "WHERE nim LIKE '%$c%' OR nama LIKE '%$c%' OR jurusan LIKE '%$c%' OR alamat LIKE '%$c%'";
}

// ---- Pagination ----
$per_hal = 10;
$hal     = isset($_GET['hal']) ? max(1, (int)$_GET['hal']) : 1;
$r       = mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM mahasiswa $where");
$row     = mysqli_fetch_assoc($r);
$total   = (int)$row['jml'];
$jml_hal = max(1, ceil($total / $per_hal));
if ($hal > $jml_hal) $hal = $jml_hal;
$mulai   = ($hal - 1) * $per_hal;

$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa $where ORDER BY nim ASC LIMIT $mulai, $per_hal");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Mahasiswa</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrap">
  <h1>Data Mahasiswa</h1>
  <?php if ($pesan) echo '<div class="ok">' . e($pesan) . '</div>'; ?>

  <div class="bar">
    <a class="btn" href="tambah.php">+ Tambah Mahasiswa</a>
    <form method="get">
      <input type="text" name="cari" placeholder="Cari NIM / nama / jurusan..." value="<?php echo e($cari); ?>">
      <button type="submit">Cari</button>
      <?php if ($cari !== '') echo '<a class="btn btn-abu" href="index.php">Reset</a>'; ?>
    </form>
  </div>

  <p>Total: <b><?php echo $total; ?></b> data<?php if ($cari !== '') echo ' untuk pencarian "' . e($cari) . '"'; ?></p>

  <div style="overflow-x:auto">
  <table>
    <tr>
      <th>No</th><th>NIM</th><th>Nama</th><th>JK</th><th>Jurusan</th>
      <th>Angkatan</th><th>Telepon</th><th>Aksi</th>
    </tr>
    <?php
    $no = $mulai + 1;
    if ($total == 0) {
        echo '<tr><td colspan="8" align="center">Data tidak ditemukan.</td></tr>';
    }
    while ($m = mysqli_fetch_assoc($data)) { ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo e($m['nim']); ?></td>
      <td><?php echo e($m['nama']); ?></td>
      <td><?php echo $m['jenis_kelamin'] == 'Laki-laki' ? 'L' : 'P'; ?></td>
      <td><?php echo e($m['jurusan']); ?></td>
      <td><?php echo (int)$m['angkatan']; ?></td>
      <td><?php echo e($m['telepon']); ?></td>
      <td>
        <a class="btn btn-edit" href="edit.php?id=<?php echo (int)$m['id']; ?>">Edit</a>
        <form class="inline" method="post" action="hapus.php"
              onsubmit="return confirm('Yakin hapus data <?php echo e(addslashes($m['nama'])); ?>?');">
          <input type="hidden" name="id" value="<?php echo (int)$m['id']; ?>">
          <button type="submit" class="btn-hapus">Hapus</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </table>
  </div>

  <div class="hal">
    <?php for ($i = 1; $i <= $jml_hal; $i++) {
        $url = 'index.php?hal=' . $i . ($cari !== '' ? '&cari=' . urlencode($cari) : '');
        echo '<a href="' . $url . '"' . ($i == $hal ? ' class="aktif"' : '') . '>' . $i . '</a>';
    } ?>
  </div>
</div>
</body>
</html>
