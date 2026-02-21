<?php
class TransaksiController {

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php");
            exit;
        }
    }

    public function index() {
        // Owner tidak boleh akses transaksi, hanya Admin dan Petugas
        if ($_SESSION['user']['role'] == 'owner') {
            echo "<script>alert('Akses ditolak! Owner hanya bisa melihat Laporan.'); window.location='index.php?c=Laporan&m=index';</script>";
            exit;
        }
        
        // Admin dan Petugas bisa melihat daftar transaksi
        $data = (new TransaksiModel)->all(); 
        include "views/transaksi/list.php";
        include "views/layout/footer.php";
    }

    public function masuk() {
        // Berdasarkan matriks: Transaksi Masuk/Keluar adalah tugas PETUGAS
        if ($_SESSION['user']['role'] !== 'petugas' && $_SESSION['user']['role'] !== 'admin') {
            echo "<script>alert('Akses ditolak! Hanya petugas yang bisa memproses kendaraan.'); window.location='index.php?c=Dashboard';</script>";
            exit;
        }

        if (isset($_GET['id'])) {
            $id_kendaraan = $_GET['id'];
            
            $db = Database::connect();
            $k = $db->prepare("SELECT jenis_kendaraan FROM tb_kendaraan WHERE id_kendaraan = ?");
            $k->execute([$id_kendaraan]);
            $v = $k->fetch(PDO::FETCH_ASSOC);
            $jenis = ($v) ? strtoupper($v['jenis_kendaraan']) : '';

            if ($jenis == 'MOTOR') {
                $nama_target = 'Lantai 2 (Motor)';
            } elseif ($jenis == 'MOBIL') {
                $nama_target = 'Lantai 1 (Mobil)';
            } else {
                $nama_target = 'Basement (Truk/Bus)';
            }

            // Cari area dengan nama yang mengandung kata kunci (lebih fleksibel)
            $query = "SELECT id_area, nama_area, kapasitas, terisi FROM tb_area_parkir WHERE nama_area LIKE ? LIMIT 1";
            $stmt = $db->prepare($query);
            $stmt->execute(['%' . $nama_target . '%']);
            $area = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($area) {
                // AUTO-FIX: Hitung ulang terisi yang sebenarnya dari database
                $checkQuery = "SELECT COUNT(*) as jumlah FROM tb_transaksi WHERE id_area = ? AND status = 'masuk'";
                $checkStmt = $db->prepare($checkQuery);
                $checkStmt->execute([$area['id_area']]);
                $checkResult = $checkStmt->fetch(PDO::FETCH_ASSOC);
                $terisi_sebenarnya = $checkResult['jumlah'];
                
                // Update terisi jika tidak sinkron
                if ($terisi_sebenarnya != $area['terisi']) {
                    $fixQuery = "UPDATE tb_area_parkir SET terisi = ? WHERE id_area = ?";
                    $fixStmt = $db->prepare($fixQuery);
                    $fixStmt->execute([$terisi_sebenarnya, $area['id_area']]);
                    $area['terisi'] = $terisi_sebenarnya; // Update variable lokal
                }
                
                // Cek apakah masih ada kapasitas
                if ($area['terisi'] < $area['kapasitas']) {
                    $data = [
                        'id_kendaraan' => $id_kendaraan, 
                        'id_area' => $area['id_area']
                    ];
                    (new TransaksiModel)->masuk($data);
                    
                    header("Location: index.php?c=Transaksi&m=index");
                    exit;
                } else {
                    echo "<script>alert('Area " . $area['nama_area'] . " penuh! (Terisi: " . $area['terisi'] . "/" . $area['kapasitas'] . ")'); window.location='index.php?c=Kendaraan';</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Area parkir untuk $jenis tidak ditemukan! Silakan hubungi admin.'); window.location='index.php?c=Kendaraan';</script>";
                exit;
            }
        }
        header("Location: index.php?c=Kendaraan");
    }

    public function keluar() {
        // Berdasarkan matriks: Transaksi Keluar/Pembayaran adalah tugas PETUGAS
        if ($_SESSION['user']['role'] !== 'petugas' && $_SESSION['user']['role'] !== 'admin') {
            header("Location: index.php?c=Transaksi&m=index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_transaksi']; 
            $metode = $_POST['metode']; 
            $total = $_POST['total_bayar'];
            
            (new TransaksiModel)->keluar($id, $metode, $total);
            
            header("Location: index.php?c=Transaksi&m=index");
            exit;
        } else {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $kendaraan = (new TransaksiModel)->getById($id);
                if ($kendaraan) {
                    $total_bayar = 3000; 
                    include "views/transaksi/keluar.php";
                    include "views/layout/footer.php";
                } else {
                    header("Location: index.php?c=Transaksi&m=index");
                    exit;
                }
            } else {
                header("Location: index.php?c=Transaksi&m=index");
                exit;
            }
        }
    }

    public function delete() {
        // Sesuai matriks: Pengelolaan data (termasuk hapus) biasanya hanya ADMIN
        if ($_SESSION['user']['role'] != 'admin') {
            echo "<script>alert('Hanya Admin yang boleh menghapus transaksi!'); window.location='index.php?c=Transaksi&m=index';</script>";
            exit;
        }
        $id = $_GET['id'];
        (new TransaksiModel)->delete($id);
        
        header("Location: index.php?c=Transaksi&m=index");
        exit;
    }

    public function edit() {
        // Sesuai matriks: Edit data adalah tugas ADMIN
        if ($_SESSION['user']['role'] != 'admin') {
            header("Location: index.php?c=Transaksi&m=index");
            exit;
        }
        if ($_POST) {
            $id = $_POST['id_parkir'];
            (new TransaksiModel)->update($id, $_POST);
            
            header("Location: index.php?c=Transaksi&m=index");
            exit;
        }
        $id = $_GET['id'];
        $data = (new TransaksiModel)->getById($id);
        
        include "views/layout/header.php";
        include "views/transaksi/edit.php";
        include "views/layout/footer.php";
    }

    public function laporan() {
        // Sesuai matriks: OWNER berhak melihat laporan/rekap
        header("Location: index.php?c=Laporan&m=index");
        exit;
    }

    public function struk() {
        // Petugas dan Admin bisa cetak struk
        if (!in_array($_SESSION['user']['role'], ['petugas', 'admin'])) {
            header("Location: index.php?c=Transaksi&m=index");
            exit;
        }
        
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = Database::connect();
            $query = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan, k.warna, a.nama_area 
                      FROM tb_transaksi t
                      JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                      JOIN tb_area_parkir a ON t.id_area = a.id_area
                      WHERE t.id_parkir = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($data) {
                include "views/transaksi/struk.php";
            } else {
                echo "<script>alert('Data tidak ditemukan!'); window.location='index.php?c=Transaksi&m=index';</script>";
            }
        } else {
            header("Location: index.php?c=Transaksi&m=index");
            exit;
        }
    }

    public function prosesKeluar() {
        // Alias untuk method keluar - dipanggil dari form keluar.php
        $this->keluar();
    }
}
