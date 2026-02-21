<?php
class LaporanController {

    public function index() {
        // Owner dan Admin bisa akses laporan
        if (!in_array($_SESSION['user']['role'], ['owner', 'admin'])) {
            header("Location: index.php?c=Dashboard");
            exit;
        }
        
        $tgl_awal = $_GET['tgl_awal'] ?? date('Y-m-d');
        $tgl_akhir = $_GET['tgl_akhir'] ?? date('Y-m-d');
        
        // 1. TANGKAP INPUT SEARCH DI SINI
        $search = $_GET['search'] ?? ''; 
        
        $model = new LaporanModel();
        
        // 2. KIRIM $search SEBAGAI PARAMETER KETIGA
        $data = $model->getLaporan($tgl_awal, $tgl_akhir, $search);
        
        include "views/laporan/index.php";
    }

    function cetak(){
        if(!isset($_SESSION['user'])) header("Location:index.php");

        $model = new LaporanModel();

        $tgl_awal  = $_GET['dari']   ?? ($_GET['tgl_awal'] ?? date('Y-m-d'));
        $tgl_akhir = $_GET['sampai'] ?? ($_GET['tgl_akhir'] ?? date('Y-m-d'));
        
        // Tambahkan search juga di cetak jika ingin hasil cetakannya terfilter
        $search = $_GET['search'] ?? '';

        // Pastikan di Model kamu ada method getLaporan atau getByTanggal yang mendukung 3 parameter
        $data = $model->getLaporan($tgl_awal, $tgl_akhir, $search);

        include "views/laporan/cetak.php";
    }

public function log_aktivitas() {
    // Hanya Admin yang bisa akses log aktivitas
    if ($_SESSION['user']['role'] !== 'admin') {
        header("Location: index.php?c=Dashboard");
        exit;
    }

    $db = Database::connect();
    
    $query = "SELECT tb_log_aktivitas.*, tb_user.username 
              FROM tb_log_aktivitas 
              JOIN tb_user ON tb_log_aktivitas.id_user = tb_user.id_user 
              ORDER BY tb_log_aktivitas.waktu_aktivitas DESC"; 
              
    $stmt = $db->query($query);
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $halaman = 'log'; 
    include "views/laporan/index.php";
}

private function simpanLog($pesan) {
    $db = Database::connect();
    $id_user = $_SESSION['user']['id_user'];
    $waktu = date('Y-m-d H:i:s');
    $stmt = $db->prepare("INSERT INTO tb_log_aktivitas (id_user, aktivitas, waktu_aktivitas) VALUES (?, ?, ?)");
    $stmt->execute([$id_user, $pesan, $waktu]);
}
}