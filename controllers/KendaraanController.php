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
            $db = Database::connect();
            
            // Cek apakah plat nomor sudah ada
            $cek_plat = $db->prepare("SELECT id_kendaraan FROM tb_kendaraan WHERE plat_nomor = ?");
            $cek_plat->execute([$_POST['plat_nomor']]);
            $kendaraan_ada = $cek_plat->fetch(PDO::FETCH_ASSOC);
            
            if($kendaraan_ada) {
                // Plat nomor sudah terdaftar, langsung masukkan ke transaksi
                $id_kendaraan = $kendaraan_ada['id_kendaraan'];
                
                if(isset($_POST['id_area']) && !empty($_POST['id_area'])) {
                    $id_area = $_POST['id_area'];
                    
                    // Cek apakah kendaraan ini sedang parkir
                    $cek_parkir = $db->prepare("SELECT id_parkir FROM tb_transaksi WHERE id_kendaraan = ? AND status = 'masuk'");
                    $cek_parkir->execute([$id_kendaraan]);
                    $sedang_parkir = $cek_parkir->fetch(PDO::FETCH_ASSOC);
                    
                    if($sedang_parkir) {
                        echo "<script>alert('Kendaraan dengan plat nomor {$_POST['plat_nomor']} sedang parkir!'); window.location='index.php?c=Kendaraan&m=create';</script>";
                        exit;
                    }
                    
                    // Insert ke tb_transaksi
                    $sql_transaksi = "INSERT INTO tb_transaksi (id_kendaraan, id_area, waktu_masuk, status) 
                                      VALUES (?, ?, NOW(), 'masuk')";
                    $stmt_transaksi = $db->prepare($sql_transaksi);
                    $stmt_transaksi->execute([$id_kendaraan, $id_area]);
                }
                
                echo "<script>alert('Kendaraan dengan plat nomor {$_POST['plat_nomor']} sudah terdaftar. Berhasil masuk parkir!'); window.location='index.php?c=Kendaraan&m=index';</script>";
                exit;
            }
            
            // Simpan kendaraan baru
            $pemilik = $_SESSION['user']['nama_lengkap'] ?? $_SESSION['user']['nama_user'] ?? 'Umum';
            $id_user = $_SESSION['user']['id_user'] ?? 1;
            
            $sql_kendaraan = "INSERT INTO tb_kendaraan (plat_nomor, jenis_kendaraan, warna, pemilik, id_user) 
                              VALUES (?, ?, ?, ?, ?)";
            $stmt_kendaraan = $db->prepare($sql_kendaraan);
            $simpan = $stmt_kendaraan->execute([
                $_POST['plat_nomor'],
                $_POST['jenis_kendaraan'],
                $_POST['warna'],
                $pemilik,
                $id_user
            ]);

            if($simpan) {
                // Ambil ID kendaraan yang baru disimpan
                $id_kendaraan = $db->lastInsertId();
                
                // Langsung masukkan ke transaksi parkir (status: masuk)
                if(isset($_POST['id_area']) && !empty($_POST['id_area'])) {
                    $id_area = $_POST['id_area'];
                    
                    // Insert ke tb_transaksi
                    $sql_transaksi = "INSERT INTO tb_transaksi (id_kendaraan, id_area, waktu_masuk, status) 
                                      VALUES (?, ?, NOW(), 'masuk')";
                    $stmt_transaksi = $db->prepare($sql_transaksi);
                    $stmt_transaksi->execute([$id_kendaraan, $id_area]);
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
