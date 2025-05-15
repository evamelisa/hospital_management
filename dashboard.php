<?php
include (".includes/header.php");
$title = "Dashboard";
// Menyertakan file untuk menampilkan notifikasi (jika ada)
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Card untuk menampilkan tabel postingan -->
    <div class="card">
        <!-- Tabel dengan baris yang dapat di-hover -->
        <div class="card">
            <!-- Header Tabel -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Semua Pertemuan</h4>
            </div>
            <div class="card-body">
                <!-- Tabel responsif -->
                <div class="table-responsive text-nowrap">
                    <table id="datatable" class="table table-hover">
            <thead>
                <tr class="text-center">
                     <th width="50px">#</th>
                     <th>Nama</th>                    
                     <th>Tgl Lahir</th>
                     <th>Gender</th>
                     <th>dokter</th>
                     <th>Tgl pertemuan</th>
                     <th>Waktu</th>
                     <th>Keluhan</th>
                     <th width="150px">Pilihan</th>
                </tr>
            </thead>
       <tbody class="table-border-bottom-0">
<!-- Menampilkan data dari tabel database -->
<?php
$index = 1; // Variabel untuk nomor urut
// Query untuk mengambil data dari tabel pertemuan, pasien, dokter
$query = "SELECT pertemuan.*, dokter.dokter FROM pertemuan
          INNER JOIN pasien ON pertemuan.pasien_id = pasien.pasien_id
          LEFT JOIN dokter ON pertemuan.dokter_id = dokter.dokter_id
          WHERE pertemuan.pasien_id = $pasienId";
// Eksekusi query
$exec = mysqli_query($conn, $query);

// Perulangan untuk menampilkan setiap baris hasil query
while ($pertemuan = mysqli_fetch_assoc($exec)) :
?>
<tr>
    <td><?= $index++; ?></td>
    <td><?= $pertemuan['nama_pasien']; ?></td>
    <td><?= $pertemuan['tgl_lahir']; ?></td>
    <td><?= $pertemuan['gender']; ?></td>
    <td><?= $pertemuan['dokter']; ?></td>
    <td><?= $pertemuan['tanggal_pertemuan']; ?></td>
    <td><?= $pertemuan['waktu_pertemuan']; ?></td>
    <td><?= $pertemuan['post_title']; ?></td>
    <td>
        <div class="dropdown">
            <!-- Tombol dropdown untuk Pilihan -->
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <!-- Menu dropdown -->
            <div class="dropdown-menu">
                <!-- Pilihan Edit -->
                <a href="edit_pertemuan.php?id_pertemuan=<?= $pertemuan['pertemuan_id']; ?>" class="dropdown-item">
                    <i class="bx bx-edit-alt me-2"></i> Edit
                </a>

<!-- Pilihan Delete -->
<a href="#" class="dropdown-item" data-bs-toggle="modal"
    data-bs-target="#deletePost_<?= $pertemuan['pertemuan_id']; ?>">
    <i class="bx bx-trash me-2"></i> Delete
</a>
</div>
        </div>
    </td>
</tr>

<!-- Modal untuk Hapus Perttemuan -->
<div class="modal fade" id="deletePost_<?= $pertemuan['pertemuan_id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Pertemuan?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_pertemuan.php" method="POST">
                    <div>
                        <p>Tindakan ini tidak bisa dibatalkan.</p>
                        <input type="hidden" name="pertemuanID" value="<?= $pertemuan['pertemuan_id']; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="delete" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>
<!-- Akhir tabel dengan baris yang dapat di-hover -->
</div>
</div>

<?php
include (".includes/footer.php");
?>
