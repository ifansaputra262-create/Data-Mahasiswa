<?php
// Form dipakai bersama oleh tambah.php dan edit.php
// Variabel $m (array data) dan $aksi (teks tombol) harus sudah tersedia
?>
<form method="post">
  <label>NIM</label>
  <input type="text" name="nim" value="<?php echo e($m['nim']); ?>" required>

  <label>Nama Lengkap</label>
  <input type="text" name="nama" value="<?php echo e($m['nama']); ?>" required>

  <label>Jenis Kelamin</label>
  <select name="jenis_kelamin">
    <option value="Laki-laki" <?php if ($m['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
    <option value="Perempuan" <?php if ($m['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
  </select>

  <label>Jurusan</label>
  <input type="text" name="jurusan" value="<?php echo e($m['jurusan']); ?>" required>

  <label>Angkatan</label>
  <input type="number" name="angkatan" min="1990" max="2100" value="<?php echo e($m['angkatan']); ?>" required>

  <label>Telepon</label>
  <input type="text" name="telepon" value="<?php echo e($m['telepon']); ?>">

  <label>Alamat</label>
  <textarea name="alamat" rows="3"><?php echo e($m['alamat']); ?></textarea>
  <br><br>
  <button type="submit"><?php echo e($aksi); ?></button>
  <a class="btn btn-abu" href="index.php">Batal</a>
</form>
