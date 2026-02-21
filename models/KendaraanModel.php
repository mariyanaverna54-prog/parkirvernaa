<?php
class KendaraanModel {
    private $db;
    
    function __construct(){
        $this->db = Database::connect();
    }

    function all() {
        $sql = "SELECT k.*, t.status as status_terakhir
                FROM tb_kendaraan k
                LEFT JOIN (
                    SELECT t1.id_kendaraan, t1.status
                    FROM tb_transaksi t1
                    WHERE t1.waktu_masuk = (
                        SELECT MAX(waktu_masuk) 
                        FROM tb_transaksi t2 
                        WHERE t2.id_kendaraan = t1.id_kendaraan
                    )
                ) t ON k.id_kendaraan = t.id_kendaraan
                ORDER BY k.id_kendaraan DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function insert($d){
        $pemilik = $_SESSION['user']['nama_lengkap'] ?? $_SESSION['user']['nama_user'] ?? 'Umum';
        $id_user = $_SESSION['user']['id_user'] ?? 1; 

        $sql = "INSERT INTO tb_kendaraan (plat_nomor, jenis_kendaraan, warna, pemilik, id_user) 
                VALUES (?, ?, ?, ?, ?)";
        
        $q = $this->db->prepare($sql);
        
        try {
            return $q->execute([
                $d['plat_nomor'],
                $d['jenis_kendaraan'],
                $d['warna'],
                $pemilik,
                $id_user
            ]);
        } catch (PDOException $e) {
            die("Waduh, gagal simpan! Errornya: " . $e->getMessage());
        }
    }

    function getById($id){
        $q = $this->db->prepare("SELECT * FROM tb_kendaraan WHERE id_kendaraan=?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }

    function update($id, $data){
        $q = $this->db->prepare("UPDATE tb_kendaraan SET plat_nomor=?, jenis_kendaraan=?, warna=?, pemilik=? WHERE id_kendaraan=?");
        return $q->execute([$data['plat_nomor'], $data['jenis_kendaraan'], $data['warna'], $data['pemilik'], $id]);
    }

    function delete($id){
        $q = $this->db->prepare("DELETE FROM tb_kendaraan WHERE id_kendaraan=?");
        return $q->execute([$id]);
    }
}
