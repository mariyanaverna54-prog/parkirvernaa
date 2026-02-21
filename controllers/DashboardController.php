<?php
class DashboardController {
  function index(){
    if(!isset($_SESSION['user'])) header("Location:index.php");

    $db = Database::connect();
    $role = $_SESSION['user']['role'];

    // --- DATA GLOBAL (Dibutuhkan semua role) ---
    $data['totalMasuk'] = $db->query("SELECT COUNT(*) FROM tb_transaksi WHERE DATE(waktu_masuk) = CURDATE()")->fetchColumn();
    $data['sedangParkir'] = $db->query("SELECT COUNT(*) FROM tb_transaksi WHERE status = 'masuk'")->fetchColumn();

    // Data untuk Area Parkir (Kapasitas)
    $qArea = $db->query("SELECT * FROM tb_area_parkir");
    $dataArea = $qArea->fetchAll(PDO::FETCH_ASSOC);

    // --- LOGIKA PER ROLE ---
    if($role == 'owner') {
        // Query Pendapatan Hari Ini (Hanya yang sudah keluar/bayar)
        $data['totalPendapatan'] = $db->query("SELECT IFNULL(SUM(biaya_total), 0) FROM tb_transaksi WHERE DATE(waktu_keluar) = CURDATE() AND status = 'keluar'")->fetchColumn();

        // Query Transaksi Selesai (Lunas)
        $data['totalSelesai'] = $db->query("SELECT COUNT(*) FROM tb_transaksi WHERE DATE(waktu_keluar) = CURDATE() AND status = 'keluar'")->fetchColumn();

        // Query Area Ter-Ramai (Logic JOIN)
// Query Area Ter-Ramai (Menggunakan COUNT(*) agar lebih aman dari salah nama kolom)
      $queryPopuler = $db->query("SELECT b.nama_area, COUNT(*) as jumlah 
                            FROM tb_transaksi a 
                            JOIN tb_area_parkir b ON a.id_area = b.id_area 
                            WHERE DATE(a.waktu_masuk) = CURDATE()
                            GROUP BY a.id_area 
                            ORDER BY jumlah DESC 
                            LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $data['areaPopuler'] = $queryPopuler['nama_area'] ?? 'Belum Ada';

        // Data Chart Pendapatan Bulanan
        $qChart = $db->query("SELECT MONTH(waktu_keluar) bulan, SUM(biaya_total) total 
                              FROM tb_transaksi WHERE status = 'keluar' 
                              GROUP BY MONTH(waktu_keluar)");
        $data['chart'] = $qChart->fetchAll(PDO::FETCH_ASSOC);

        include "views/dashboard_owner.php";

    } elseif($role == 'admin') {
        // Data Khusus Admin (Management)
        $data['totalPetugas'] = $db->query("SELECT COUNT(*) FROM tb_user WHERE role = 'petugas'")->fetchColumn();
        $data['totalKendaraan'] = $db->query("SELECT COUNT(*) FROM tb_kendaraan")->fetchColumn();

        include "views/dashboard_admin.php";

    } else {
        // Data Khusus Petugas (Operasional)
        $data['totalKeluar'] = $db->query("SELECT COUNT(*) FROM tb_transaksi WHERE DATE(waktu_keluar) = CURDATE()")->fetchColumn();

        include "views/dashboard_petugas.php";
    }
  }
}