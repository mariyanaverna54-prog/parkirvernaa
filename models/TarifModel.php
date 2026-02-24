<?php
class TarifModel {
  private $db;
  
  function __construct(){
    $this->db = Database::connect();
  }

  function all(){
    $q = $this->db->query("SELECT * FROM tb_tarif ORDER BY FIELD(LOWER(jenis_kendaraan), 'motor', 'mobil', 'truk/bus', 'elf')");
    return $q->fetchAll(PDO::FETCH_ASSOC);
  }

  function getById($id){
    $q = $this->db->prepare("SELECT * FROM tb_tarif WHERE id_tarif=?");
    $q->execute([$id]);
    return $q->fetch(PDO::FETCH_ASSOC);
  }

  function insert($data){
    $q = $this->db->prepare("INSERT INTO tb_tarif (jenis_kendaraan, tarif_per_jam) VALUES (?, ?)");
    return $q->execute([$data['jenis_kendaraan'], $data['tarif_per_jam']]);
  }

  function update($id, $data){
    $q = $this->db->prepare("UPDATE tb_tarif SET jenis_kendaraan=?, tarif_per_jam=? WHERE id_tarif=?");
    return $q->execute([$data['jenis_kendaraan'], $data['tarif_per_jam'], $id]);
  }

  function delete($id){
    $q = $this->db->prepare("DELETE FROM tb_tarif WHERE id_tarif=?");
    return $q->execute([$id]);
  }
}
