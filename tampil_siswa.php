<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Siswa</strong></div>
    <div class="card-body">
        <a class="btn btn-primary mb-2" href="?page=siswa&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="">NISN</th>
            <th width="300px">Nama Siswa</th>
            <th width="100px">Kelas</th>
            <th width="300px">Jenis Kelamin</th>
            <th width="100px">Alamat</th>
            <th width="100px"></th>
        </tr>
        </thead>
        <tbody>
                <!-- letakkan proses menampilkan disini -->

    <?php
     $sql = "SELECT*FROM siswa ORDER BY nisn ASC";
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc()) {
    ?>
    <tr>
        <td><?php echo $row['nisn']; ?></td>
        <td><?php echo $row['nama_siswa']; ?></td>
        <td><?php echo $row['kelas']; ?></td>
        <td><?php echo $row['jenis_kelamin']; ?></td>
        <td><?php echo $row['alamat']; ?></td>
        <td align="center">
            <a class="btn btn-warning" href="?page=siswa&action=update&nisn=<?php echo $row['nisn']; ?>">
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