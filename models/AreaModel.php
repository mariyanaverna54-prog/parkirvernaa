<?php
class AreaModel {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getArea() {
        $sql = "SELECT a.*, 
                (SELECT COUNT(*) FROM tb_transaksi t 
                WHERE t.id_area = a.id_area AND t.status = 'masuk') as terisi 
                FROM tb_area_parkir a 
                ORDER BY a.id_area ASC"; 
        
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tb_area_parkir WHERE id_area = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $stmt = $this->db->prepare("INSERT INTO tb_area_parkir (nama_area, kapasitas) VALUES (?, ?)");
        return $stmt->execute([$data['nama_area'], $data['kapasitas']]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE tb_area_parkir SET nama_area = ?, kapasitas = ? WHERE id_area = ?");
        return $stmt->execute([$data['nama_area'], $data['kapasitas'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tb_area_parkir WHERE id_area = ?");
        return $stmt->execute([$id]);
    }
}