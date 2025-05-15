<?php
// Menyertakan header halaman
include '.includes/header.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
    <div class="row">
        <!-- Form untuk menambahkan postingan baru -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_post.php" enctype="multipart/form-data">
                        <!-- Input untuk judul postingan -->

                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">nama pasien</label>
                            <input type="text" class="form-control" name="nama_pasien" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">gender</label>
                            <select class="form-select" name="gender" required>
                                <option value="" selected disabled>-- Pilih gender --</option>
                                <option value="laki_laki">laki-laki</option>
                                <option value="perempuan">perempuan</option>
                            </select>
                        </div>


                        <!-- Dropdown untuk memilih kategori -->
                        <div class="mb-3">
                            <label for="dokter_id" class="form-label">Dokter</label>
                                <select class="form-select" name="dokter_id" required>
                                   <option value="" selected disabled>Pilih salah satu</option>
                                    <?php
                                    $query = "SELECT * FROM dokter";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                     echo "<option value='" . $row["dokter_id"] . "'>" . $row["dokter"] . " - " . $row["spesialisasi"] . "</option>";
                                    }
                                   }
                                  ?>
                                </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pertemuan" class="form-label">Tentukan Tanggal pertemuan</label>
                            <input type="date" class="form-control" name="tanggal_pertemuan" required>
                        </div>

                        <div class="mb-3">
                            <label for="waktu_pertemuan" class="form-label">Tentukan Waktu pertemuan</label>
                            <input type="time" class="form-control" name="waktu_pertemuan" required>
                        </div>

                        <!-- Textarea untuk konten postingan -->
                        <div class="mb-3">
                            <label for="post_title" class="form-label">Keluhan</label>
                            <input type="text" class="form-control" name="post_title" required>
                        </div>


                        <!-- Tombol submit -->
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Menyertakan footer halaman
include '.includes/footer.php';
?>
