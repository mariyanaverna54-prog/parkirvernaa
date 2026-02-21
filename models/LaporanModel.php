<?php
class LaporanModel {
    private $db;

    function __construct(){
        $this->db = Database::connect();
    }

public function getLaporan($tgl_awal, $tgl_akhir, $search = '') {
    // Gunakan parameter untuk keamanan (SQL Injection)
    $params = [$tgl_awal, $tgl_akhir];
    
    $sql = "SELECT t.*, k.plat_nomor 
            FROM tb_transaksi t 
            INNER JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan 
            WHERE t.status = 'keluar' 
            AND DATE(t.waktu_keluar) BETWEEN ? AND ?";

    // HANYA tambahkan filter ini kalau user ngetik sesuatu di search bar
    if (!empty($search)) {
        $sql .= " AND k.plat_nomor LIKE ?";
        $params[] = "%$search%";
    }

    $sql .= " ORDER BY t.waktu_keluar DESC";

    $q = $this->db->prepare($sql);
    $q->execute($params);
    return $q->fetchAll(PDO::FETCH_ASSOC);
}
}