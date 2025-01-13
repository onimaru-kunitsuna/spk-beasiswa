<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Pendaftaran</strong></div>
    <div class="card-body">
        <a class="btn btn-primary mb-2" href="?page=pendaftaran&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr align="center">
            <th width="0">No</th>
            <th width="100px">Tanggal</th>
            <th width="80px">Tahun</th>
            <th width="300px">NISN</th>
            <th width="700px">Nama Siswa</th>
            <th width="300px">Pendapatan Orang Tua</th>
            <th width="200px">Nilai Raport</th>
            <th width="200px">Jumlah Tanggungan</th>
            <th width="500px"></th>
        </tr>
        </thead>
        <tbody>
                <!-- letakkan proses menampilkan disini -->

    <?php
    $i=1;
     $sql = "SELECT pendaftaran.iddaftar,pendaftaran.tgldaftar,pendaftaran.tahun,pendaftaran.nisn,siswa.nama_siswa,pendaftaran.pendapatan_ortu,pendaftaran.nilai_raport,pendaftaran.jumlah_tanggungan 
             FROM siswa INNER JOIN pendaftaran ON siswa.nisn=pendaftaran.nisn ORDER BY iddaftar ASC";
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc()) {
    ?>
    <tr>
        <td><?php echo $i++;['nisn']; ?></td>
        <td><?php echo $row['tgldaftar']; ?></td>
        <td><?php echo $row['tahun']; ?></td>
        <td><?php echo $row['nisn']; ?></td>
        <td><?php echo $row['nama_siswa']; ?></td>
        <td><?php echo $row['pendapatan_ortu']; ?></td>
        <td><?php echo $row['nilai_raport']; ?></td>
        <td><?php echo $row['jumlah_tanggungan']; ?></td>
        <td align="center">
            <a class="btn btn-warning" href="?page=pendaftaran&action=update&id=<?php echo $row['iddaftar']; ?>">
                <span class="fas fa-edit"></span>
            </a>
            <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=pendaftaran&action=hapus&id=<?php echo $row['iddaftar']; ?>">
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