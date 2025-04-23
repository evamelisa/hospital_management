<?php
// memasukkan file konfigurasi database
include 'config.php';

// memasukkan header halaman
include '.includes/header.php';

// mengambil ID postingan yang akan diedit dari paramenter URL
// ../edit_jadwalkan.php?pasien_id=
$postIdToEdit = $_GET['pasien_id']; // pastikan paramenter 'pasien_id' ada di URL

// query untuk mengambil data postingan berdasarkan ID
$query = "SELECT * FROM pasien WHERE pasien_id = $postIdToEdit";
$result = $conn->query($query);

// memeriksa apakah data postinngan ditemukan
if ($result->num_rows > 0) {
    $pasien = $result->fetch_assoc(); // mengambil data postingna ke dalam array
} else {
    // menampilkan pesan jika postingan tidak ditemukan
    echo "Pasien not found.";
    exit(); // menghentikan eksekusi jika tidak ada postinngan
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- judul halaman -->
     <div class="row">
        <!-- form untuk mengedit postingan -->
         <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- formulir menggunakan metode PASIEN untuk mengirim data -->
                     <form method="PASIEN" action="proses_jadwalkan.php" enctype="multipart/form-data">
                        <!-- input tersembunyi untuk menyimpan ID postingan -->
                         <input type="hidden" name="pasien_id" value="<?php echo $postIdToEdit; ?>">

                         <!-- input untuk judul postingan -->
                          <div class="mb-3">
                            <label for="nama" class="form-label">Nama Anda</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $pasien['nama']; ?>" required>
                          </div>

                          <!-- input untuk tanggal -->
                           <div class="mb-3">
                            <label for="formDate" class="form-label">Tentukan Tanggal Pertemuan</label>
                            <input type="date" class="form-control" id="formDate" name="tanggal_pertemuan" value="<?= !empty($pasien['date']) ? $pasien['date'] : '' ?>">
                             <?php if (!empty($pasien['date'])): ?>
                                <!-- menampilkan tanggal yang sudah di unggah -->
                                <div class="mt-2">
                                    <small>Tanggal sebelumnya: <?= $pasien['date'] ?></small>
                                </div>
                                <?php endif; ?>
                           </div>

                           <!-- dropdown untuk kategori -->
                            <div class="mb-3">
                                <label for="dokter_id" class="form-label">Tentukan Tanggal Pertemuan</label>
                                <select class="form-select" id="dokter_id" name="dokter_id" required>
                                    <option value="" selected>Select one</option>
                                    <?php
                                    // mengambil data pasien dari database
                                    $queryDokter = "SELECT * FROM dokter";
                                    $resultDokter = $conn->query($queryDokter);

                                    // menambahkan opsi ke dropdown
                                    if ($resultDokter->num_rows > 0) {
                                        while ($row = $resultDokter->fetch_assoc()) {
                                            // menandai dokter yang sudah dipilih 
                                            $selected = ($row["dokter_id"] == $post['dokter_id']) ? "selected" : "";
                                            echo "<option value='" . $row["dokter_id"] . "' $selected>" . $row["dokter_id"] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- textarea untuk konten postingan -->
                             <div class="mb-3">
                                <label for="content" class="form-label">konten</label>
                                <textarea class="form-control" id="content" name="content" required><?php echo $post['content']; ?></textarea>
                             </div>

                             <!-- tombol untuk memperharui postingan -->
                              <button type="submit" name="update" class="btn btn-primary">Update</button>
                     </form>
                </div>
            </div>
         </div>
     </div>
</div>

<?php
// memasukkan footer halaman
include '.includes/footer.php';
?>