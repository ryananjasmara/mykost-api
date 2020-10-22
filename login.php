<?php

header('Content-Type: application/json');

$json = json_decode(file_get_contents('php://input'), true);

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/config.php';

if (empty($json['login_type']) || empty($json['nomor_handphone']) || empty($json['email']) || empty($json['password'])) {
  http_response_code(400);
  $response["message"] = "isi parameter";
  echo json_encode($response);
} else {
  $login_type = $json['login_type'];
  $nomor_handphone = $json['nomor_handphone'];
  $email = $json['email'];
  $password = md5($json['password']);
  
  if ($login_type === 'pemilik') {
    $sql = "SELECT * FROM pemilik WHERE kontak_pemilik = '$nomor_handphone' AND email_pemilik = '$email' AND password_pemilik = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      $response["data"] = array();
      
      while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $data["nama"] = $row["nama_pemilik"];
        $data["kontak"] = $row["kontak_pemilik"];
        $data["email"] = $row["email_pemilik"];
        $data["saldo"] = $row["saldo_pemilik"];
        $data["poin"] = $row["poin_pemilik"];
        $data["tipe"] = "pemilik";
        $response["data"] = $data;
      }
      http_response_code(200);
      $response["message"] = 'login berhasil';
      echo json_encode($response);
    } else {
      http_response_code(400);
      $response["message"] = 'login gagal';
      echo json_encode($response);
    }
  } else if ($login_type === 'pencari') {
    $sql = "SELECT * FROM pencari WHERE kontak_pencari = '$nomor_handphone' AND email_pencari = '$email' AND password_pencari = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      $response["data"] = array();
      
      while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $data["nama"] = $row["nama_pencari"];
        $data["kontak"] = $row["kontak_pencari"];
        $data["email"] = $row["email_pencari"];
        $data["saldo"] = $row["saldo_pencari"];
        $data["poin"] = $row["poin_pencari"];
        $data["tipe"] = "pencari";
        $response["data"] = $data;
      }
      http_response_code(200);
      $response["message"] = 'login berhasil';
      echo json_encode($response);
    } else {
      http_response_code(400);
      $response["message"] = 'login gagal';
      echo json_encode($response);
    }
  }
}

?>