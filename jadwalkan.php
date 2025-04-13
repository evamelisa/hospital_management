<?php
// menyertakan header halaman
include '.includes/header.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- judul halaman -->
     <div class="row">
        <!-- form untuk menambahkan jadwal baru -->
         <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_jadwalkan.php"
                    enctype="multipart/form-data">
                <!-- input untuk mengunggah nama pasien -->
                 <div class="mb-3">
                    <label for="post_title" class="form-label">Nama Anda</label>
                    <input type="text" class="form-control" name="post_title" require>
                 </div>
                 <!-- input untuk mengunggah tanggal pertemuan -->
                  <div class="mb-3">
                  <label for="meetingDate" class="form-label">Tentukan Tanggal Pertemuan</label>
                  <input class="form-control" type="date" id="meetingDate" name="meetingDate" placeholder="Pilih tanggal" />
                  </div>
                  <!-- dropdown untuk memilih kategori -->
                   <div class="mb-3">
                    <label for="dokter_id" class="form-label">Dokter</label>
                    <select class="form-select" name="dokter_id" required>
                      <!-- mengambil data dokter dari database untuk mengisi opsi dropdown -->
                       <option value="" selected disabled>Pilih Salah Satu</option>
                       <?php
                       $query = "SELECT * FROM dokter"; // mengambil data dokter
                       $result = $conn->query($query); // menjalankan query
                       if ($result->num_rows > 0) { // jika terdapat data dokter
                        while ($row = $result->fetch_assoc()) { // iterasi setiap dokter
                          echo "<option value='" . $row["dokter_id"] . "'>" . $row["spesialis"] . "</option>";  
                        }
                       }
                       ?>
                    </select>
                   </div>
                   <!-- textarea untuk konten -->
                    <div class="mb-3">
                      <label for="content" class="form-label">Keluhan yang di alami</label>
                      <textarea class="form-control" id="content" name="content" required></textarea>
                    </div>
                    <!-- tombol submit -->
                     <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </form>
                </div>
            </div>
         </div>
     </div>
</div>
<?php
// menyertakan footer halaman
include '.includes/footer.php';
?>