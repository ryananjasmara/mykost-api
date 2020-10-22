<?php

header('Content-Type: application/json');

$json = json_decode(file_get_contents('php://input'), true);

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/config.php';

if (empty($json['register_type']) || empty($json['nomor_handphone']) || empty($json['email']) || empty($json['password']) || empty($json['nama'])) {
  http_response_code(400);
  $response["message"] = "isi parameter";
  echo json_encode($response);
} else {
  $register_type = $json['register_type'];
  $nama = $json['nama'];
  $nomor_handphone = $json['nomor_handphone'];
  $email = $json['email'];
  $password = md5($json['password']);
  
  if ($register_type === 'pemilik') {
    
    $insert = "INSERT INTO pemilik (nama_pemilik, kontak_pemilik, email_pemilik, password_pemilik) VALUES ('$nama', '$nomor_handphone', '$email', '$password')";
    $result = mysqli_query($conn, $insert);
    
    if ($result) {
      http_response_code(200);
      $response["message"] = 'register berhasil';
      echo json_encode($response);
    } else {
      http_response_code(400);
      $response["message"] = 'register gagal';
      echo json_encode($response);
    }
  } else if ($register_type === 'pencari') {
    $insert = "INSERT INTO pencari (nama_pencari, kontak_pencari, email_pencari, password_pencari) VALUES ('$nama', '$nomor_handphone', '$email', '$password')";
    $result = mysqli_query($conn, $insert);
    
    if ($result) {
      http_response_code(200);
      $response["message"] = 'register berhasil';
      echo json_encode($response);
    } else {
      http_response_code(400);
      $response["message"] = 'register gagal';
      echo json_encode($response);
    }
  }
}

?>