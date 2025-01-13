<!-- letakkan proses tambah data disini -->
<?php

if(isset($_POST['simpan'])){

    //ambil data dari input
    $tgldaftar = date("Y-m-d");
    $tahun=$_POST['tahun'];
    $nama_siswa=$_POST['nama_siswa'];
    $pendapatan_ortu=$_POST['pendapatan_ortu'];
    $nilai_raport=$_POST['nilai_raport'];
    $jumlah_tanggungan=$_POST['jumlah_tanggungan'];
	
    // validasi data pendaftaran
    $sql = "SELECT*FROM pendaftaran WHERE tahun='$tahun' AND nisn='$nama_siswa'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data sudah ada</strong>
            </div>
        <?php
    }else{
	//proses simpan data pendaftaran
        $sql = "INSERT INTO pendaftaran VALUES (Null,'$tgldaftar','$tahun','$nama_siswa','$pendapatan_ortu','$nilai_raport','$jumlah_tanggungan')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=pendaftaran");
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA PENDAFTARAN</strong></div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select class="form-control chosen" data-placeholder="Pilih Tahun" name="tahun">
                                <option value=""></option>
                                <?php
                                    for($x=date("Y");$x>=2015;$x--){
                                ?>
                                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                <?php
                                    }
                                ?>
                            </select> 
                        </div>

                        <div class="form-group">
                            <label for="">Nama Siswa</label>
                            <select class="form-control chosen" data-placeholder="Pilih Nama Siswa" name="nama_siswa">
                            <option value=""></option>
                            <?php
                                $sql = "SELECT * FROM siswa ORDER BY nama_siswa ASC";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['nisn']; ?>"><?php echo $row['nisn'] . "-" . $row['nama_siswa']; ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pendapatan Orang Tua</label>
                            <input type="number" class="form-control" name="pendapatan_ortu" min="0" max="999999999" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nilai Raport</label>
                            <input type="number" class="form-control" name="nilai_raport" value="0.00" step="0.01" min="0" max="100" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Tanggungan</label>
                            <input type="number" class="form-control" name="jumlah_tanggungan" min="0" max="100" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=pendaftaran">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>