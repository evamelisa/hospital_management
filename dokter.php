<?php
// memasukkan header halaman
include '.includes/header.php';
// menyertakan file untuk menampilkan notifikasi (jika ada)
include '.includes/toast_notification.php';
?>

<div class="container-xxl flex-groe-1 container-p-y">
    <!-- tabel data kategori -->
     <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Data Dokter</h4>
            <!-- tombol untuk menambah kategori baru -->
             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDokter">
                Tambah
             </button>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="datatable" class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th width="50px">#</th>
                            <th width="200">Nama</th>
                            <th width="200px">Spesialis</th>
                            <th width="150px">Pilihan</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <!-- mengambil data dokter dari database -->
                     <?php
                     $index = 1;
                     $query = "SELECT * FROM dokter";
                     $exec = mysqli_query($conn, $query);
                     while ($dokter = mysqli_fetch_assoc($exec)) :
                        ?>
                        <tr>
                            <!-- menampilkan nomor, nama dokter, spesialis, dan opsi -->
                             <td><?= $index++; ?></td>
                             <td><?= $dokter['nama']; ?></td>
                             <td>
                                <!-- dropdown untuk opsi edit dan delete -->
                                 <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle 
                                    hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-toggle="#editDokter_<?= $dokter['dokter_id']; ?>">
                                        <i class="bx bx-edit-alt me-2"></i>Edit</a>
                                        <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#deleteDokter_<?= $dokter['dokter_id']; ?>">
                                    <i class="bx bx-trash me-2"></i>Delete</a>
                                    </div>
                                 </div>
                             </td>
                        </tr>
                        <!-- modal untuk hapus data kategori -->
                          <div class="modal fade" id="deleteDokter_<?= $dokter['dokter_id']; ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Dokter?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="proses_dokter.php" method="POST">
                                            <div>
                                                <p>Tindakan ini tidak bisa dibaatalkan.</p>
                                                <input type="hidden" nama="catID" value="<?= $dokter['dokter_id']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" name="delete" class="btn btn-primary">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                          </div>
                        <!-- modal untuk update data kategori -->
                         <div id="editDokter_<?= $dokter['dokter_id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Data Dokter</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="proses_dokter.php" method="POST">
                                            <!-- input untuk nama dokter -->
                                             <input type="hidden" name="catID" value="<?= $dokter['dokter_id']; ?>">
                                             <div class="form-group">
                                                <label>Nama Dokter</label>
                                                <!-- input untuk nama dokter -->
                                                 <input type="text" value="<?= $dokter['dokter_id']; ?>" name="nama" class="form-control">
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

<!-- modal untuk tambah data kategori -->
 <div class="modal fade" id="addDokter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="proses_dokter.php" method="POST">
                    <div>
                        <label for="namaDokter" class="form-label">Nama Dokter</label>
                        <!-- input untuk nama dokter baru -->
                         <input type="text" class="form-control" name="nama" require/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>