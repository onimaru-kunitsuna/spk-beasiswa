<!-- proses perangkingan -->
<?php



if(isset($_POST['proses'])){
    //mengambil data tahun dari input
    $tahun=$_POST['tahun'];

    //mengambil data dari tabel pendaftaran
    $sql = "SELECT*FROM pendaftaran WHERE tahun=$tahun";
    $result = $conn->query($sql);
    if($result->num_rows > 0){

        // mencari nilai max dan min
        $sql = "SELECT min(pendapatan_ortu) as mpendapatan, max(nilai_raport) as mnilai, max(jumlah_tanggungan) as mtanggungan FROM pendaftaran WHERE tahun=$tahun";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        // mengambil nilai min dan max
        $mpendapatan=$row["mpendapatan"];
        $mnilai=$row["mnilai"];
        $mtanggungan=$row["mtanggungan"];

        // proses normaslisasi
        $sql = "SELECT*FROM pendaftaran WHERE tahun=$tahun";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            
            // mengambil data pendaftaran
            $iddaftar=$row["iddaftar"];
            $pendapatan_ortu=$row["pendapatan_ortu"];
            $nilai_raport=$row["nilai_raport"];
            $jumlah_tanggungan=$row["jumlah_tanggungan"];

            // menghapus data perangkingan yang lama
            $sql = "DELETE FROM perangkingan WHERE iddaftar='$iddaftar'";
            $conn->query($sql);

            // hitung normalisasi
            $npendapatan_ortu = $mpendapatan / $pendapatan_ortu;
            $nnilai_raport = $nilai_raport / $mnilai;
            $njumlah_tanggungan = $jumlah_tanggungan / $mtanggungan;

            // hitung nilai preferensi
            $preferensi = ($npendapatan_ortu*0.5)+($nnilai_raport*0.3)+($njumlah_tanggungan*0.2);

            // simpan data perangkingan
            $sql = "INSERT INTO perangkingan VALUES (Null,'$iddaftar','$npendapatan_ortu','$nnilai_raport','$njumlah_tanggungan','$preferensi')";
            if ($conn->query($sql) === TRUE) {
                header("Location:?page=perangkingan&thn=$tahun");
            }
        }
    }else{
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data tidak ditemukan</strong>
            </div>
        <?php
    }
}    

?>

<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Perangkingan</strong></div>
    <div class="card-body">

    <!-- form memilih tahun dan tombol proses -->
    <form action="" method="POST">
        <div class="form-group">
            <label for="">Tahun</label>
            <select class="form-control chosen" data-placeholder="Pilih Tahun" name="tahun">
                <option value="<?php echo $_GET['thn']; ?>"><?php echo $_GET['thn'];?></option>
                <?php
                    for($x=date("Y");$x>=2015;$x--){
                ?>
                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                <?php
                    }
                ?>
            </select> 
        </div>
        <input class="btn btn-primary mb-2" type="submit" name="proses" value="Proses">
    </form>

    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="100px">No</th>
            <th width="100px">NISN</th>
            <th width="300px">Nama Siswa</th>
            <th width="100px">n_pendapatan</th>
            <th width="300px">n_nilai raport</th>
            <th width="100px">n_tanggungan</th>
            <th width="100px">Preferensi</th>
        </tr>
        </thead>
        <tbody>
                <!-- letakkan proses menampilkan disini -->

    <?php
    $i=1;
     $sql = "SELECT perangkingan.idperangkingan,pendaftaran.iddaftar,
                         pendaftaran.tgldaftar,pendaftaran.nisn,
                         siswa.nama_siswa,perangkingan.n_pendapatan,perangkingan.n_nilai,
                         perangkingan.n_tanggungan,perangkingan.preferensi 
             FROM perangkingan INNER JOIN pendaftaran ON perangkingan.iddaftar = pendaftaran.iddaftar
             INNER JOIN siswa ON pendaftaran.nisn = siswa.nisn ORDER BY preferensi DESC";
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc()) {
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['nisn']; ?></td>
        <td><?php echo $row['nama_siswa']; ?></td>
        <td><?php echo $row['n_pendapatan']; ?></td>
        <td><?php echo $row['n_nilai']; ?></td>
        <td><?php echo $row['n_tanggungan']; ?></td>
        <td><?php echo $row['preferensi']; ?></td>
        <td align="center">
            <a class="btn btn-warning" href="?page=perangkingan&action=update&nisn=<?php echo $row['nisn']; ?>">
                <span class="fas fa-edit"></span>
            </a>
            <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=siswa&action=hapus&nisn=<?php echo $row['nisn']; ?>">
                <span class="fas fa-times"></span>
            </a>
        </td>
    </tr>
    <?php
        }
        $conn->close();
    ?>
    </tbody>
    </table>
    </div>
    </div>