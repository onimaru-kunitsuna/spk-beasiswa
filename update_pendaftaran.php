<!-- letakkan proses update data disini -->
<?php 

// memanggil data san memasukkan ke masing-masing input
$id=$_GET['id'];

if(isset($_POST['update'])){
    
   // ambil data dari masing-masing input
   $pendapatan_ortu=$_POST['pendapatan_ortu'];
   $nilai_raport=$_POST['nilai_raport'];
   $jumlah_tanggungan=$_POST['jumlah_tanggungan'];

    // proses update
    $sql = "UPDATE pendaftaran SET pendapatan_ortu='$pendapatan_ortu',nilai_raport='$nilai_raport',jumlah_tanggungan='$jumlah_tanggungan' WHERE iddaftar='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=pendaftaran");
    }
}


$sql = "SELECT pendaftaran.iddaftar,pendaftaran.tgldaftar,pendaftaran.tahun,pendaftaran.nisn,siswa.nama_siswa,pendaftaran.pendapatan_ortu,pendaftaran.nilai_raport,pendaftaran.jumlah_tanggungan 
             FROM siswa INNER JOIN pendaftaran ON siswa.nisn=pendaftaran.nisn WHERE iddaftar='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header bg-primary text-white border-dark"><strong>Update Data Pendaftaran</strong></div>
                  <div class="card-body">

                     <div class="form-group">
                        <label for="">Tahun</label>
                        <input type="text" class="form-control" value="<?php echo $row["tahun"] ?>" name="tahun" readonly>
                     </div>
                     <div class="form-group">
                        <label for="">NISN</label>
                        <input type="text" class="form-control" value="<?php echo $row["nisn"] ?>" name="nisn" readonly>
                     </div>
                     <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input type="text" class="form-control" value="<?php echo $row["nama_siswa"] ?>" readonly>
                     </div>
                     <div class="form-group">
                        <label for="">Pendapatan Orang Tua</label>
                        <input type="number" class="form-control" value="<?php echo $row["pendapatan_ortu"] ?>" name="pendapatan_ortu" min="0" max="999999999" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nilai Raport</label>
                        <input type="number" class="form-control" value="<?php echo $row["nilai_raport"] ?>" name="nilai_raport" value="0.00" step="0.01" min="0" max="100" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Tanggungan</label>
                        <input type="number" class="form-control" value="<?php echo $row["jumlah_tanggungan"] ?>" name="jumlah_tanggungan" min="0" max="100" required>
                    </div>

                     <input class="btn btn-primary" type="submit" name="update" value="Update">
                     <a class="btn btn-danger" href="?page=pendaftaran">Batal</a>

                  </div>
         </div>
      </form>
   </div>
</div>