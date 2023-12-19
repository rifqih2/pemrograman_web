<?php
  include 'koneksi.php';

  $query = 'SELECT * FROM data_barang;';
  $sql = mysqli_query($conn, $query);
  $id_barang = 0;
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="style.css" />
    <title>latihan1</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> Pertemuan 11 </a>
      </div>
    </nav>
    <!-- Judul -->
    <div class="container">
      <h1 class="my-5">Data Barang</h1>
      <a href="kelola.php" type="button" class="btn btn-success mb-3"
        >Tambah Baru</a
      >
      <div class="table-responsive text-center">
        <table class="table table-striped align-middle px-5">
          <thead class="table-primary">
            <tr class="">
              <th class="nama-gambar">Gambar</th>
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>Harga Jual</th>
              <th>Harga Beli</th>
              <th>Stok</th>
              <th class="aksi">Aksi</th>
            </tr>
          </thead>
          <tbody>

          <?php
             while ($result= mysqli_fetch_assoc($sql)) {
          ?>
              <tr class="parent-gambar-hp">
                <td><?php echo ++$id_barang;?></td>
                <td><img src="asset/<?php echo $result['gambar']; ?>" alt=""></td>
                <td><?php echo $result['nama_barang']; ?></td>
                <td><?php echo $result['kategori']; ?></td>
                <td><?php echo $result['harga_jual']; ?></td>
                <td><?php echo $result['harga_beli']; ?></td>
                <td><?php echo $result['stok']; ?></td>
                <td>
                  <div class="d-flex justify-content-evenly">
                    <a href="kelola.php?ubah=<?php echo $result["id_barang"]; ?>" type="button" class="btn btn-primary"
                      >Edit</a
                    >
                    <a href="proses.php?hapus=<?php echo $result["id_barang"]; ?>" type="button" class="btn btn-danger" onClick="return confirm('Apakah anda yakin ingin menghapus data tersebut???')" >Hapus</a>
                  </div>
                </td>
              </tr>
          <?php
             }
          ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Bootsrapt JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
