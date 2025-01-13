<!-- letakkan proses tambah data disini -->
<?php

if(isset($_POST['simpan'])){

    //ambil data dari input
    $nisn=$_POST['nisn'];
    $nama_siswa=$_POST['nama_siswa'];
    $kelas=$_POST['kelas'];
    $jenis_kelamin=$_POST['jenis_kelamin'];
    $alamat=$_POST['alamat'];
	
    // validasi data siswa
    $sql = "SELECT*FROM siswa WHERE nisn='$nisn'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>NISN sudah ada</strong>
            </div>
        <?php
    }else{
	//proses simpan data siswa
        $sql = "INSERT INTO siswa VALUES ('$nisn','$nama_siswa','$kelas','$jenis_kelamin','$alamat')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=siswa");
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA SISWA</strong></div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="">NISN</label>
                            <input type="text" class="form-control" name="nisn" maxlength="11" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama_siswa" maxlength="30" required>
                        </div>
                        <div class="form-group">
                            <label for="">Kelas</label>
                            <input type="text" class="form-control" name="kelas" maxlength="5" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <input type="text" class="form-control" name="jenis_kelamin" maxlength="15" required>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" maxlength="20" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=siswa">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>