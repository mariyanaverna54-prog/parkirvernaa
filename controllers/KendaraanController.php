<?php
class KendaraanController {

    public function __construct() {
        if(!isset($_SESSION['user'])) {
            header("Location: index.php"); 
            exit;
        }
    }

    public function index(){
        // Petugas dan Admin bisa lihat list kendaraan
        $model = new KendaraanModel();
        $data = $model->all();
        include "views/kendaraan/list.php";
    }

    public function create() {
        // Hanya admin yang bisa tambah kendaraan
        if($_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Akses ditolak! Hanya Admin yang bisa menambah kendaraan.'); window.location='index.php?c=Dashboard';</script>";
            exit;
        }
        
        $areaModel = new AreaModel();
        $areas = $areaModel->getArea(); 
        include "views/kendaraan/create.php";
    }

    public function store(){
        // Hanya admin yang bisa tambah kendaraan
        if($_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Hanya Admin yang bisa menambah kendaraan!'); window.location='index.php?c=Kendaraan&m=index';</script>";
            exit;
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $model = new KendaraanModel();
            
            // Eksekusi simpan ke tb_kendaraan
            $simpan = $model->insert($_POST);

            if($simpan) {
                // Update area (logika kamu tetap dipertahankan)
                if(isset($_POST['id_area']) && !empty($_POST['id_area'])) {
                    $id_area = $_POST['id_area'];
                    $db = Database::connect(); 
                    $sql = "UPDATE tb_area_parkir SET terisi = terisi + 1 WHERE id_area = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$id_area]);
                }
                
                // Lempar balik ke list kendaraan
                header("Location: index.php?c=Kendaraan&m=index");
                exit;
            } else {
                die("Gagal simpan ke database. Cek koneksi!");
            }
        }
    }

    public function edit() {
        // Hanya admin yang bisa edit kendaraan
        if($_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Hanya Admin yang bisa mengubah kendaraan!'); window.location='index.php?c=Kendaraan&m=index';</script>";
            exit;
        }
        
        $id = $_GET['id'];
        $model = new KendaraanModel();
        $data = $model->getById($id);
        include "views/kendaraan/edit.php";
    }

    public function update() {
        // Hanya admin yang bisa edit kendaraan
        if($_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Hanya Admin yang bisa mengubah kendaraan!'); window.location='index.php?c=Kendaraan&m=index';</script>";
            exit;
        }
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_kendaraan'];
            $model = new KendaraanModel();
            $model->update($id, $_POST);
            header("Location: index.php?c=Kendaraan&m=index");
            exit;
        }
    }

    public function delete() {
        // Hanya admin yang bisa hapus kendaraan
        if($_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Hanya Admin yang bisa menghapus kendaraan!'); window.location='index.php?c=Kendaraan&m=index';</script>";
            exit;
        }
        
        $id = $_GET['id'];
        $model = new KendaraanModel();
        $model->delete($id);
        header("Location: index.php?c=Kendaraan&m=index");
        exit;
    }
}
