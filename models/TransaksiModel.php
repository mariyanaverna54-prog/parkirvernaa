<?php
class TransaksiModel {
  private $db;
  
  function __construct(){
    $this->db = Database::connect();
  }

  // Menampilkan kendaraan yang sedang parkir
  function all(){
    $sql = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan, a.nama_area 
            FROM tb_transaksi t
            JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan 
            JOIN tb_area_parkir a ON t.id_area = a.id_area
            WHERE t.status = 'masuk' 
            ORDER BY t.id_parkir DESC";
            
    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  // Menampilkan riwayat parkir yang sudah keluar
  function getHistory() {
    $sql = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan, a.nama_area 
            FROM tb_transaksi t
            JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan 
            JOIN tb_area_parkir a ON t.id_area = a.id_area
            WHERE t.status = 'keluar' 
            ORDER BY t.waktu_keluar DESC";
            
    return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  } 

  function getById($id){
    $q = $this->db->prepare("SELECT t.*, k.plat_nomor, k.jenis_kendaraan, k.warna, a.nama_area 
                             FROM tb_transaksi t 
                             JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan 
                             JOIN tb_area_parkir a ON t.id_area = a.id_area
                             WHERE t.id_parkir=?");
    $q->execute([$id]);
    return $q->fetch(PDO::FETCH_ASSOC);
  }

  public function masuk($data) {
      $db = Database::connect();
      $query = "INSERT INTO tb_transaksi (id_kendaraan, id_area, waktu_masuk, status) 
                VALUES (?, ?, NOW(), 'masuk')";
      $stmt = $db->prepare($query);
      $stmt->execute([
          $data['id_kendaraan'], 
          $data['id_area']
      ]);

      $updateArea = "UPDATE tb_area_parkir SET terisi = terisi + 1 WHERE id_area = ?";
      $stmtUpdate = $db->prepare($updateArea);
      $stmtUpdate->execute([$data['id_area']]); 

      return true;
  }

  // --- BAGIAN YANG SUDAH DIPERBAIKI (TANPA ERROR STATUS KENDARAAN) ---
  public function keluar($id, $metode) {
    date_default_timezone_set('Asia/Jakarta');

    // 1. Ambil info transaksi sebelum update
    $stmt = $this->db->prepare("SELECT id_area, waktu_masuk FROM tb_transaksi WHERE id_parkir = ?");
    $stmt->execute([$id]);
    $tr = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$tr) return false;

    $id_area = $tr['id_area'];
    $waktu_masuk = new DateTime($tr['waktu_masuk']);
    $waktu_keluar = new DateTime();
    
    // Hitung Biaya (3000 per jam)
    $diff = $waktu_masuk->diff($waktu_keluar);
    $jam = $diff->h + ($diff->days * 24);
    if($diff->i > 0 || $diff->s > 0) $jam++; 
    $total_bayar = ($jam == 0 ? 1 : $jam) * 3000;

    // 2. Update status transaksi (Menggunakan kolom yang pasti ada di tb_transaksi)
    $sql_update = "UPDATE tb_transaksi SET 
                    waktu_keluar = NOW(), 
                    biaya_total = ?,
                    status = 'keluar', 
                    metode_bayar = ? 
                   WHERE id_parkir = ?";
    
    $res = $this->db->prepare($sql_update)->execute([$total_bayar, $metode, $id]);

    if ($res) {
        // 3. Update slot area parkir (Agar slot kembali tersedia)
        if (!empty($id_area)) {
            $this->db->prepare("UPDATE tb_area_parkir SET terisi = terisi - 1 WHERE id_area = ? AND terisi > 0")
                     ->execute([$id_area]);
        }
    }

    return $res;
  }
  // --- AKHIR PERBAIKAN ---

  function delete($id){
    $stmt = $this->db->prepare("SELECT id_area, status FROM tb_transaksi WHERE id_parkir = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($data && $data['status'] == 'masuk') {
        $this->db->prepare("UPDATE tb_area_parkir SET terisi = terisi - 1 WHERE id_area = ? AND terisi > 0")
                 ->execute([$data['id_area']]);
    }

    $q = $this->db->prepare("DELETE FROM tb_transaksi WHERE id_parkir=?");
    return $q->execute([$id]);
  }

  function update($id, $data){
    $q = $this->db->prepare("UPDATE tb_transaksi SET 
                             status = ?, 
                             biaya_total = ?, 
                             metode_bayar = ? 
                             WHERE id_parkir = ?");
    return $q->execute([
        $data['status'], 
        $data['biaya_total'], 
        $data['metode_bayar'], 
        $id
    ]);
  }
}