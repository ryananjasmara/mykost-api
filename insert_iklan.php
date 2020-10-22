<?php

header('Content-Type: application/json');

$json = json_decode(file_get_contents('php://input'), true);

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/config.php';

if (empty($json['id_pemilik']) || empty($json['nama_property']) || empty($json['nama_pemilik']) || empty($json['tipe_property']) || empty($json['alamat_property']) || empty($json['kota_property']) || empty($json['kecamatan_property']) || empty($json['kodepos_property']) || empty($json['kontak_property']) || empty($json['gender_property']) || empty($json['harga_sewa_property']) || empty($json['luas_unit_property']) || empty($json['fasilitas_property']) || empty($json['deskripsi_property']) || empty($json['jumlah_unit_property'])) {
  http_response_code(400);
  $response["message"] = "isi parameter";
  echo json_encode($response);
} else {
  $id_pemilik = $json['id_pemilik'];
  $nama_property = $json['nama_property'];
  $nama_pemilik = $json['nama_pemilik'];
  $tipe_property = $json['tipe_property'];
  $alamat_property = $json['alamat_property'];
  $kota_property = $json['kota_property'];
  $kecamatan_property = $json['kecamatan_property'];
  $kodepos_property = $json['kodepos_property'];
  $kontak_property = $json['kontak_property'];
  $gender_property = $json['gender_property'];
  $harga_sewa_property = $json['harga_sewa_property'];
  $luas_unit_property = $json['luas_unit_property'];
  $fasilitas_property = $json['fasilitas_property'];
  $deskripsi_property = $json['deskripsi_property'];
  $jumlah_unit_property = $json['jumlah_unit_property'];
  
  $insert = "INSERT INTO property (id_pemilik, nama_property, nama_pemilik, tipe_property, alamat_property, kota_property, kecamatan_property, kodepos_property, kontak_property, gender_property, harga_sewa_property, luas_unit_property, fasilitas_property, deskripsi_property, jumlah_unit_property) VALUES ($id_pemilik, '$nama_property', '$nama_pemilik', '$tipe_property', '$alamat_property', '$kota_property', '$kecamatan_property', '$kodepos_property', '$kontak_property', '$gender_property', $harga_sewa_property, $luas_unit_property, '$fasilitas_property', '$deskripsi_property', $jumlah_unit_property)";
  $result = mysqli_query($conn, $insert);
  
  if ($result) {
    http_response_code(200);
    $response["message"] = 'iklan berhasil ditambahkan';
    echo json_encode($response);
  } else {
    http_response_code(400);
    $response["message"] = 'iklan gagal ditambahkan';
    echo json_encode($response);
  }
  
}

?>