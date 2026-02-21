<?php
class AuthController {

  function login(){
    $error = null;
    
    if($_POST){
      $u = (new UserModel)->login($_POST['username'], $_POST['password']);
      if($u){
        $_SESSION['user'] = $u;
        
        // CATAT LOG AKTIVITAS LOGIN
        $this->simpanLog($u['id_user'], "Login ke sistem");
        
        header("Location:index.php?c=Dashboard&m=index");
        exit();
      } else {
        $error = "Username / Password salah!";
      }
    }
    
    // Tampilkan halaman login (dengan atau tanpa error)
    include "views/login.php";
  }

  function logout(){
    // CATAT LOG AKTIVITAS LOGOUT
    if(isset($_SESSION['user'])) {
      $this->simpanLog($_SESSION['user']['id_user'], "Logout dari sistem");
    }
    
    session_unset();
    session_destroy();
    
    // ANTI-BACK: Clear cache
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    
    header("Location:index.php");
    exit();
  }
  
  function checkSession(){
    header('Content-Type: application/json');
    echo json_encode(['loggedIn' => isset($_SESSION['user'])]);
    exit();
  }

  private function simpanLog($id_user, $pesan) {
    $db = Database::connect();
    // Set timezone ke WIB (Asia/Jakarta)
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('Y-m-d H:i:s');
    $stmt = $db->prepare("INSERT INTO tb_log_aktivitas (id_user, aktivitas, waktu_aktivitas) VALUES (?, ?, ?)");
    $stmt->execute([$id_user, $pesan, $waktu]);
  }

}
