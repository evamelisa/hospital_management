<?php
// Menyertakan header halaman
include '.includes/header.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Judul halaman -->
    <div class="row">
        <!-- Form untuk menambahkan pertemuan baru -->
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_pertemuan.php" enctype="multipart/form-data">
                        <!-- Input untuk judul pertemuan -->

                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" name="nama_pasien" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" required>
                                <option value="" selected disabled>-- Pilih Gender --</option>
                                <option value="laki_laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>


                        <!-- Dropdown untuk memilih dokter -->
                        <div class="mb-3">
                            <label for="dokter_id" class="form-label">Dokter</label>
                                <select class="form-select" name="dokter_id" required>
                                   <option value="" selected disabled>Pilih Salah Satu</option>
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
                            <label for="tanggal_pertemuan" class="form-label">Tentukan Tanggal Pertemuan</label>
                            <input type="date" class="form-control" name="tanggal_pertemuan" required>
                        </div>

                        <div class="mb-3">
                            <label for="waktu_pertemuan" class="form-label">Tentukan Waktu Pertemuan</label>
                            <input type="time" class="form-control" name="waktu_pertemuan" required>
                        </div>

                        <!-- Textarea untuk pertemuan -->
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