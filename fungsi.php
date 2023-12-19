<?php
  include 'koneksi.php';

  function tambah_data($data, $files)
{
    $sqlRow = "SELECT * FROM data_barang";
    $totalRow = mysqli_query($GLOBALS['conn'], $sqlRow);
    $row = mysqli_num_rows($totalRow);
    $idBarang = $row + 1;

    // Check if the generated id already exists in the table
    while (idExists($idBarang)) {
        $idBarang++;
    }

    $kategori = $data['kategori'];
    $nama_barang = $data['namaBarang'];

    $split = explode('.', $files['gambar']['name']);
    $ekstensi = $split[count($split) - 1];

    $gambar = $idBarang . '.' . $ekstensi;
    $harga_jual = $data['hargaJual'];
    $harga_beli = $data['hargaBeli'];
    $stok = $data['stok'];

    $dir = "asset/";
    $tmpFile = $files['gambar']['tmp_name'];

    move_uploaded_file($tmpFile, $dir . $gambar);
    $query = "INSERT INTO data_barang VALUES('$idBarang', '$kategori', '$nama_barang', '$gambar', '$harga_jual', '$harga_beli','$stok')";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}

function idExists($id)
    {
        $query = "SELECT * FROM data_barang WHERE id_barang = '$id'";
        $result = mysqli_query($GLOBALS['conn'], $query);
        return mysqli_num_rows($result) > 0;
    }


    function ubah_data($data, $files){

        $id_Barang = $data['id_barang'];
        $kategori = $data['kategori'];
        $nama_barang = $data['namaBarang'];
        $harga_jual = $data['hargaJual'];
        $harga_beli = $data['hargaBeli'];
        $stok = $data['stok'];
  
        $queryShow = "SELECT * FROM data_barang WHERE id_barang = '$id_Barang';";
        $sqlShow = mysqli_query ($GLOBALS['conn'], $queryShow);
        $result= mysqli_fetch_assoc($sqlShow);
  
        if($files['gambar']['name'] == ""){
          $gambar = $result['gambar'];
        } else {
          $gambar = $files['gambar']['name'];
          unlink("asset/".$result['gambar']);
          move_uploaded_file($files['gambar']['tmp_name'], 'asset/'.$files['gambar']['name']);
        }
  
        $query = "UPDATE data_barang SET kategori='$kategori',nama_barang='$nama_barang',harga_jual='$harga_jual',harga_beli='$harga_beli',stok='$stok',gambar='$gambar' WHERE id_barang ='$id_Barang';";
        $sql = mysqli_query($GLOBALS['conn'], $query);
  
        return true;
    }

    function hapus_data($data){

        $id_Barang = $data['hapus'];

        $queryShow = "SELECT * FROM data_barang WHERE id_barang = '$id_Barang';";
        $sqlShow = mysqli_query ($GLOBALS['conn'], $queryShow);
        $result= mysqli_fetch_assoc($sqlShow);
    
        unlink("asset/".$result['gambar']);
    
        $query = "DELETE FROM data_barang WHERE id_barang = '$id_Barang';";
        $sql = mysqli_query($GLOBALS['conn'], $query);
        $updateQuery = "SET @count = 0; UPDATE data_barang SET id_barang = @count:= @count + 1; ALTER TABLE data_barang AUTO_INCREMENT = @count + 1;";
        mysqli_multi_query($GLOBALS['conn'], $updateQuery);

      return true;
    }

?>