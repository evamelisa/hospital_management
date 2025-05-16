<?php
// Memasukkan header halaman
include '.includes/header.php';
// Menyertakan file untuk menampilkan notifikasi (jika ada)
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Tabel data dokter -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Nama Dokter</h4>
            <!-- Tombol untuk menambah dokter baru -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDokter">
                Tambah Dokter
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th width="50px">#</th>
                            <th>Nama Dokter</th>
                            <th>Spesialisasi</th>
                            <th width="150px">Pilihan</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
<!-- Mengambil data dokter dari database -->
<?php
$index = 1;
$query = "SELECT * FROM dokter";
$exec = mysqli_query($conn, $query);
while ($dokter= mysqli_fetch_assoc($exec)) :
?>
<tr>
    <!-- Menampilkan nomor, nama dokter, dan opsi -->
    <td><?= $index++; ?></td>
    <td><?= $dokter['dokter']; ?></td>
    <td><?= $dokter['spesialisasi']; ?></td>
    <td>
        <!-- Dropdown untuk opsi Edit dan Delete -->
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editDokter_<?= $dokter['dokter_id']; ?>">
                    <i class="bx bx-edit-alt me-2"></i> Edit
                </a>
                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteDokter_<?= $dokter['dokter_id']; ?>">
                    <i class="bx bx-trash me-2"></i> Delete
                </a>
            </div>
        </div>
    </td>
</tr>

<!-- Modal untuk Hapus Data dokter -->
<div class="modal fade" id="deleteDokter_<?= $dokter['dokter_id']; ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Dokter?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="proses_dokter.php" method="POST">
          <div>
            <p>Tindakan ini tidak bisa dibatalkan.</p>
            <input type="hidden" name="catID" value="<?= $dokter['dokter_id']; ?>">
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


<!-- Modal untuk Update Data dokter -->
<div id="editDokter_<?= $dokter['dokter_id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Data dokter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="proses_dokter.php" method="POST">
          <!-- Input tersembunyi untuk menyimpan ID dokter -->
          <input type="hidden" name="catID" value="<?= $dokter['dokter_id']; ?>">
          <div class="form-group">
            <label for="dokter">Nama dokter</label>
            <!-- Input untuk nama dokter -->
            <input 
              type="text" 
              value="<?= $dokter['dokter']; ?>" 
              name="dokter" 
              class="form-control" 
            >
             <label for="spesialisasi">Spesialisasi</label>
            <!-- Input untuk nama dokter -->
            <input 
              type="text" 
              value="<?= $dokter['spesialisasi']; ?>" 
              name="spesialisasi" 
              class="form-control" 
            >
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
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
</div>
<?php include '.includes/footer.php'; ?>

<!-- Modal untuk Tambah Data Dokter -->
<div class="modal fade" id="addDokter" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Dokter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="proses_dokter.php" method="POST">
          <div class="form-group mb-3">
            <label for="dokter">Nama Dokter</label>
            <input type="text" class="form-control" name="dokter" required />
          </div>
          <div class="form-group mb-3">
            <label for="spesialisasi">Spesialisasi</label>
            <input type="text" class="form-control" name="spesialisasi" required />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>