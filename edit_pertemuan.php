<?php
// Memasukkan file konfigurasi database
include 'config.php';

// Menyertakan header halaman
include '.includes/header.php';

// Mengambil id pertemuan dari parameter GET
$pertemuanIdToEdit = $_GET['id_pertemuan'];

// Query untuk mengambil data pertemuan
$query = "SELECT * FROM pertemuan WHERE pertemuan_id = $pertemuanIdToEdit";
$result = $conn->query($query);

// Memeriksa apakah data ditemukan
if ($result->num_rows > 0) {
    $pertemuan = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit();
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_pertemuan.php" enctype="multipart/form-data">
                        <!-- Hidden input untuk ID -->
                        <input type="hidden" name="pertemuan_id" value="<?php echo $pertemuan['pertemuan_id']; ?>">

                        <div class="mb-3">
                            <label for="nama_pasien" class="form-label">Keluhan</label>
                            <input type="text" class="form-control" name="nama_pasien" value="<?php echo $pertemuan['nama_pasien']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $pertemuan['tgl_lahir']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" required>
                                <option value="" disabled>-- Pilih gender --</option>
                                <option value="laki_laki" <?php if ($pertemuan['gender'] == 'laki_laki') echo 'selected'; ?>>laki-laki</option>
                                <option value="perempuan" <?php if ($pertemuan['gender'] == 'perempuan') echo 'selected'; ?>>perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="dokter_id" class="form-label">Dokter</label>
                            <select class="form-select" name="dokter_id" required>
                                <option value="" disabled>Pilih salah satu</option>
                                <?php
                                $queryDokter = "SELECT * FROM dokter";
                                $resultDokter = $conn->query($queryDokter);
                                if ($resultDokter->num_rows > 0) {
                                    while ($row = $resultDokter->fetch_assoc()) {
                                        $selected = ($row["dokter_id"] == $pertemuan['dokter_id']) ? "selected" : "";
                                        echo "<option value='" . $row["dokter_id"] . "' $selected>" . $row["dokter"] . " - " . $row["spesialisasi"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_pertemuan" class="form-label">Tentukan Tanggal Pertemuan</label>
                            <input type="date" class="form-control" name="tanggal_pertemuan" value="<?php echo $pertemuan['tanggal_pertemuan']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="waktu_pertemuan" class="form-label">Tentukan Waktu Pertemuan</label>
                            <input type="time" class="form-control" name="waktu_pertemuan" value="<?php echo $pertemuan['waktu_pertemuan']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="post_title" class="form-label">Keluhan</label>
                            <input type="text" class="form-control" name="post_title" value="<?php echo $pertemuan['post_title']; ?>" required>
                        </div>

                        <button type="submit" name="update" class="btn btn-primary">Update</button>
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
