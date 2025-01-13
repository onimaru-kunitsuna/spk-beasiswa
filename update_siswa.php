<!-- letakkan proses update data disini -->
<?php 

if(isset($_POST['update'])){
    
   // ambil data dari masing-masing input
   $nisn=$_POST['nisn'];
   $nama_siswa=$_POST['nama_siswa'];
   $kelas=$_POST['kelas'];
   $jenis_kelamin=$_POST['jenis_kelamin'];
   $alamat=$_POST['alamat'];

    // proses update
    $sql = "UPDATE siswa SET nama_siswa='$nama_siswa',kelas='$kelas',jenis_kelamin='$jenis_kelamin',alamat='$alamat' WHERE nisn='$nisn'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=siswa");
    }
}

$nisn=$_GET['nisn'];

$sql = "SELECT * FROM siswa WHERE nisn='$nisn'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
   <div class="col-sm-12">
      <form action="" method="POST">
         <div class="card border-dark">
            <div class="card">
               <div class="card-header bg-primary text-white border-dark"><strong>Update Data Siswa</strong></div>
                  <div class="card-body">

                     <div class="form-group">
                        <label for="">NISN</label>
                        <input type="text" class="form-control" value="<?php echo $row["nisn"] ?>" name="nisn" readonly>
                     </div>
                     <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input type="text" class="form-control" value="<?php echo $row["nama_siswa"] ?>" name="nama_siswa" maxlength="30" required>
                     </div>
                     <div class="form-group">
                        <label for="">Kelas</label>
                        <input type="text" class="form-control" value="<?php echo $row["kelas"] ?>" name="kelas" maxlength="5" required>
                     </div>
                     <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <input type="text" class="form-control" value="<?php echo $row["jenis_kelamin"] ?>" name="jenis_kelamin" maxlength="15" required>
                     </div>
                     <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" value="<?php echo $row["alamat"] ?>" name="alamat" maxlength="20" required>
                     </div>

                     <input class="btn btn-primary" type="submit" name="update" value="Update">
                     <a class="btn btn-danger" href="?page=siswa">Batal</a>

                  </div>
         </div>
      </form>
   </div>
</div>