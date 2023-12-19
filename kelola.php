<!DOCTYPE html>

<?php
  include 'koneksi.php';

    $id_barang = '';
    $kategori = '';
    $nama_barang = '';
    $gambar = '';
    $harga_beli = '';
    $harga_jual = '';
    $stok = '';

    if(isset($_GET['ubah'])){
      $id_barang = $_GET['ubah'];
      
      $query = "SELECT * FROM data_barang WHERE id_barang = '$id_barang';";
      $sql = mysqli_query($conn, $query);

      $result = mysqli_fetch_assoc($sql);

      $kategori = $result['kategori'];
      $nama_barang = $result['nama_barang'];
      $gambar = $result['gambar'];
      $harga_beli = $result['harga_beli'];
      $harga_jual = $result['harga_jual'];
      $stok = $result['stok'];

    }
?>


<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>Input Barang</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar bg-body-tertiary mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> Pertemuan 11 </a>
      </div>
    </nav>

    <!-- Content -->
    <div class="container">
      <form method="POST" action="proses.php" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $id_barang; ?>" name="id_barang">
        <div class="mb-3 row">
          <label for="namaBarang" class="col-sm-2 col-form-label"
            >Nama Barang</label
          >
          <div class="col-sm-10">
            <input required type="text" name="namaBarang" class="form-control" id="namaBarang" value="<?php echo $nama_barang;?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
          <div class="col-sm-10">
            <select required class="form-select" name="kategori">
              <option <?php if($kategori == 'Handphone'){echo "selected";} ?> value="Handphone" >Handphone</option>
              <option <?php if($kategori == 'Laptop'){echo "selected";} ?> value="Laptop">Laptop</option>
              <option <?php if($kategori == 'Komputer'){echo "selected";} ?> value="Komputer">Komputer</option>
              <option <?php if($kategori == 'Elektronik'){echo "selected";} ?> value="Elektronik">Elektronik</option>
            </select>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
          <div class="col-sm-10">
            <input <?php if(!isset($_GET['ubah'])){ echo "required";} ?> class="form-control" name="gambar" type="file" id="gambar" accept="image/*" value="<?php echo $gambar;?>"/>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="hargaJual" class="col-sm-2 col-form-label"
            >Harga Jual</label
          >
          <div class="col-sm-10">
            <input required type="number" name="hargaJual" class="form-control" id="hargaJual" value="<?php echo $harga_jual;?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="hargaBeli" class="col-sm-2 col-form-label"
            >Harga Beli</label
          >
          <div class="col-sm-10">
            <input required type="number" name="hargaBeli" class="form-control" id="hargaBeli" value="<?php echo $harga_beli;?>" />
          </div>
        </div>
        <div class="mb-3 row">
          <label for="stok" class="col-sm-2 col-form-label">Stok</label>
          <div class="col-sm-10">
            <input required type="number" name="stok" class="form-control" id="stok" value="<?php echo $stok;?>" />
          </div>
        </div>
        <div class="mb-3 row mt-4">
          <div class="col-sm-2"></div>
          <div class="col-sm-10">
            <?php
              if(isset($_GET['ubah'])){
            ?>
              <button type="submit" name="aksi" value="edit" class="btn btn-primary">Simpan Perubahan</button>
            <?php
              } else {
            ?>
              <button type="submit" name="aksi" value="add" class="btn btn-primary">Tambahkan</button>
            <?php
              }
            ?>
              <a href="index.php" type="button" class="btn btn-danger">Batal</a>
                </div>
        </div>
      </form>
    </div>
    <!-- kelola -->
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
