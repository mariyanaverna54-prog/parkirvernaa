<?php
class UserModel {
  private $db;
  function __construct(){
    $this->db = Database::connect();
  }

  function login($u,$p){
    $q = $this->db->prepare("SELECT * FROM tb_user WHERE username=? AND password=?");
    $q->execute([$u,$p]);
    return $q->fetch(PDO::FETCH_ASSOC);
  }

  function all(){
    $q = $this->db->query("SELECT * FROM tb_user ORDER BY FIELD(role, 'owner', 'admin', 'petugas')");
    return $q->fetchAll(PDO::FETCH_ASSOC);
  }

  function getById($id){
    $q = $this->db->prepare("SELECT * FROM tb_user WHERE id_user=?");
    $q->execute([$id]);
    return $q->fetch(PDO::FETCH_ASSOC);
  }

  function insert($data){
    $q = $this->db->prepare("INSERT INTO tb_user (username, password, nama_lengkap, role) VALUES (?, ?, ?, ?)");
    return $q->execute([$data['username'], $data['password'], $data['nama_lengkap'], $data['role']]);
  }

  function update($id, $data){
    if(!empty($data['password'])){
      $q = $this->db->prepare("UPDATE tb_user SET username=?, password=?, nama_lengkap=?, role=? WHERE id_user=?");
      return $q->execute([$data['username'], $data['password'], $data['nama_lengkap'], $data['role'], $id]);
    } else {
      $q = $this->db->prepare("UPDATE tb_user SET username=?, nama_lengkap=?, role=? WHERE id_user=?");
      return $q->execute([$data['username'], $data['nama_lengkap'], $data['role'], $id]);
    }
  }

  function delete($id){
    $q = $this->db->prepare("DELETE FROM tb_user WHERE id_user=?");
    return $q->execute([$id]);
  }
}
