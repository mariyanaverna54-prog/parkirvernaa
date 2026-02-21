<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARKIR VERNA</title>
    
    <!-- ANTI-BACK: Cegah browser cache halaman setelah logout -->
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <link rel="stylesheet" href="assets/css/halaman.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    body { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        margin: 0;
    }

    .wrapper { display: flex; align-items: stretch; width: 100%; }

    /* --- SIDEBAR CUSTOM --- */
    #sidebar {
        min-width: 280px;
        max-width: 280px;
        min-height: 100vh;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .sidebar-header h4 {
        font-weight: 800;
        letter-spacing: 1px;
    }

    .sidebar-header i {
        color: #f97316;
    }

    #sidebar .nav-menu { padding: 25px 15px; }

    #sidebar .nav-link {
        padding: 14px 20px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
    }

    #sidebar .nav-link i {
        width: 32px;
        font-size: 1.2rem;
        transition: 0.3s;
    }

    /* --- CONTENT AREA & NAVBAR --- */
    #content { width: 100%; min-height: 100vh; }

    .top-navbar {
        background: linear-gradient(135deg, #fb923c, #f97316);
        padding: 18px 40px;
        margin-bottom: 30px;
        position: sticky;
        top: 0;
        z-index: 1020;
        box-shadow: 0 6px 20px rgba(249, 115, 22, 0.35);
        pointer-events: auto !important;
    }

    /* Dropdown z-index fix */
    .dropdown-menu {
        z-index: 1030 !important;
        pointer-events: auto !important;
    }

    .dropdown {
        z-index: 1025 !important;
        pointer-events: auto !important;
    }

    /* Pastikan dropdown toggle bisa diklik */
    [data-bs-toggle="dropdown"] {
        pointer-events: auto !important;
        cursor: pointer !important;
    }

    .container-fluid { padding: 0 40px 40px 40px; }
    
    /* Dropdown Hover Effect */
    .dropdown-item:hover {
        background-color: #fee2e2 !important;
        transform: translateX(4px);
    }
    
    .profile-dropdown-trigger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }

    /* FIX DROPDOWN PROFIL - CRITICAL */
    .dropdown {
        position: relative !important;
        z-index: 9999 !important;
    }

    .dropdown-menu {
        position: absolute !important;
        z-index: 9999 !important;
        display: none;
    }

    .dropdown-menu.show {
        display: block !important;
        z-index: 9999 !important;
    }

    .user-profile-card {
        cursor: pointer !important;
        position: relative !important;
        z-index: 9999 !important;
    }

    /* Pastikan navbar di atas semua */
    .top-navbar {
        position: sticky !important;
        z-index: 9998 !important;
    }

    /* Pastikan content di bawah navbar */
    #content {
        position: relative !important;
        z-index: 1 !important;
    }

    .container-fluid {
        position: relative !important;
        z-index: 1 !important;
    }

    .card, .card-custom, .table-responsive, table {
        position: relative !important;
        z-index: 1 !important;
    }
</style>
<body>

<?php 
$user_role = $_SESSION['user']['role'] ?? 'guest';
$user_nama = $_SESSION['user']['nama_lengkap'] ?? $_SESSION['user']['nama_user'] ?? $_SESSION['user']['nama'] ?? $_SESSION['user']['username'] ?? 'User';
?>

<div class="wrapper">
    <nav id="sidebar">
    <div class="sidebar-header p-3 text-center">
        <h4 class="fw-bold mb-0" style="letter-spacing: 2px; color: #431407;">
            <i class="fas fa-parking me-2" style="color: #f97316;"></i>PARKIR
        </h4>
        <hr style="border-color: #fed7aa; margin-top: 15px; margin-bottom: 0;">
    </div>
        
       <div class="nav-menu">
            <!-- MENU UTAMA -->
            <a href="index.php?c=Dashboard&m=index" class="nav-link <?= (!isset($_GET['c']) || $_GET['c'] == 'Dashboard') ? 'active' : '' ?>">
                <i class="fas fa-home"></i> Dashboard
            </a>

             <a href="index.php?c=Kendaraan&m=index" class="nav-link <?= (isset($_GET['c']) && $_GET['c'] == 'Kendaraan') ? 'active' : '' ?>">
                <i class="fas fa-car"></i> Kendaraan
            </a>
            
            <?php if (in_array($user_role, ['admin', 'petugas'])): ?>
            <a href="index.php?c=Transaksi&m=index" class="nav-link <?= (isset($_GET['c']) && $_GET['c'] == 'Transaksi') ? 'active' : '' ?>">
                <i class="fas fa-exchange-alt"></i> Transaksi
            </a>
            <?php endif; ?>

            <?php if (in_array($user_role, ['admin', 'owner'])): ?>
            <a href="index.php?c=Laporan&m=index" class="nav-link <?= (isset($_GET['c']) && $_GET['c'] == 'Laporan' && (!isset($_GET['m']) || $_GET['m'] == 'index')) ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> Laporan
            </a>
            <?php endif; ?>

            <?php if ($user_role == 'admin'): ?>
            <!-- KELOLA DATA -->
            <div style="margin-top: 30px; margin-bottom: 10px;">
                <small class="text-muted px-3 d-block text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">
                    Kelola Data
                </small>
            </div>
            
            <a href="index.php?c=User&m=index" class="nav-link <?= (isset($_GET['c']) && $_GET['c'] == 'User') ? 'active' : '' ?>">
                <i class="fas fa-users-cog"></i> User
            </a>
            
            <a href="index.php?c=Tarif&m=index" class="nav-link <?= (isset($_GET['c']) && $_GET['c'] == 'Tarif') ? 'active' : '' ?>">
                <i class="fas fa-tags"></i> Tarif Parkir
            </a>
            
            <a href="index.php?c=Area&m=index" class="nav-link <?= (isset($_GET['c']) && $_GET['c'] == 'Area') ? 'active' : '' ?>">
                <i class="fas fa-map-marked-alt"></i> Area Parkir
            </a>
            
            <!-- LOG AKTIVITAS -->
            <div style="margin-top: 30px; margin-bottom: 10px;">
                <small class="text-muted px-3 d-block text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">
                    Monitoring
                </small>
            </div>
            
            <a href="index.php?c=Laporan&m=log_aktivitas" class="nav-link <?= (isset($_GET['c']) && $_GET['c'] == 'Laporan' && isset($_GET['m']) && $_GET['m'] == 'log_aktivitas') ? 'active' : '' ?>">
                <i class="fas fa-history"></i> Log Aktivitas
            </a>

            <!-- INFO ADMIN -->
            <div style="margin: 30px 15px 20px 15px; padding: 18px; background: linear-gradient(135deg, #fff7ed, #ffedd5); border-radius: 12px; border: 2px solid #fed7aa;">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #f97316, #fb923c); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(249, 115, 22, 0.3);">
                        <i class="fas fa-user-cog" style="color: white; font-size: 1.1rem;"></i>
                    </div>
                    <div>
                        <p class="mb-0 fw-bold" style="color: #431407; font-size: 0.85rem;">Administrator</p>
                        <small style="color: #9a3412; font-size: 0.7rem;">Full Access Control</small>
                    </div>
                </div>
            </div>

            <?php endif; ?>

            <?php if ($user_role == 'petugas'): ?>
            <!-- JAM DIGITAL -->
            <div style="margin: 40px 15px 20px 15px; padding: 20px; background: linear-gradient(135deg, #f97316, #fb923c); border-radius: 16px; text-align: center; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);">
                <p class="mb-1" style="color: rgba(255,255,255,0.8); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;"> Sekarang</p>
                <h4 class="mb-0 fw-bold" style="color: white; font-size: 1.5rem;" id="clock">00:00:00</h4>
                <p class="mb-0 mt-1" style="color: rgba(255,255,255,0.9); font-size: 0.75rem;" id="date">Loading...</p>
            </div>

            <!-- INFO PETUGAS -->
            <div style="margin: 20px 15px; padding: 18px; background: #fff; border-radius: 12px; border: 2px solid #fed7aa;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #fff7ed, #ffedd5); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-shield" style="color: #f97316; font-size: 1.3rem;"></i>
                    </div>
                    <div>
                        <p class="mb-0 fw-bold" style="color: #431407; font-size: 0.85rem;">Petugas Parkir</p>
                        <small style="color: #9a3412; font-size: 0.7rem;">Sistem Operasional</small>
                    </div>
                </div>
                <div style="padding: 10px; background: #fff7ed; border-radius: 8px; border-left: 3px solid #f97316;">
                    <p class="mb-1" style="color: #431407; font-size: 0.75rem; line-height: 1.5;">
                        <i class="fas fa-check-circle me-2" style="color: #16a34a;"></i>Dashboard Aktif
                    </p>
                    <p class="mb-0" style="color: #431407; font-size: 0.75rem; line-height: 1.5;">
                        <i class="fas fa-check-circle me-2" style="color: #16a34a;"></i>Transaksi Siap
                    </p>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($user_role == 'owner'): ?>
            <!-- JAM DIGITAL -->
            <div style="margin: 40px 15px 20px 15px; padding: 20px; background: linear-gradient(135deg, #f97316, #fb923c); border-radius: 16px; text-align: center; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);">
                <p class="mb-1" style="color: rgba(255,255,255,0.8); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;">Waktu Sekarang</p>
                <h4 class="mb-0 fw-bold" style="color: white; font-size: 1.5rem;" id="clock2">00:00:00</h4>
                <p class="mb-0 mt-1" style="color: rgba(255,255,255,0.9); font-size: 0.75rem;" id="date2">Loading...</p>
            </div>

            <!-- INFO OWNER -->
            <div style="margin: 20px 15px; padding: 18px; background: #fff; border-radius: 12px; border: 2px solid #fed7aa;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #fff7ed, #ffedd5); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-crown" style="color: #f97316; font-size: 1.3rem;"></i>
                    </div>
                    <div>
                        <p class="mb-0 fw-bold" style="color: #431407; font-size: 0.85rem;">Owner</p>
                        <small style="color: #9a3412; font-size: 0.7rem;">Monitoring System</small>
                    </div>
                </div>
                <div style="padding: 10px; background: #fff7ed; border-radius: 8px; border-left: 3px solid #f97316;">
                    <p class="mb-1" style="color: #431407; font-size: 0.75rem; line-height: 1.5;">
                        <i class="fas fa-chart-line me-2" style="color: #3b82f6;"></i>Laporan Real-time
                    </p>
                    <p class="mb-0" style="color: #431407; font-size: 0.75rem; line-height: 1.5;">
                        <i class="fas fa-filter me-2" style="color: #8b5cf6;"></i>Filter Tanggal
                    </p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </nav>

    <div id="content">
    <nav class="top-navbar d-flex justify-content-between align-items-center">
        <div></div>   
        
        <div class="d-flex align-items-center gap-3">
            <?php if($user_role == 'admin'): ?>
            <!-- Notifikasi Kendaraan Keluar -->
            <div class="dropdown">
                <?php
                // Ambil kendaraan yang keluar hari ini
                $db = Database::connect();
                date_default_timezone_set('Asia/Jakarta');
                $today = date('Y-m-d');
                $query = "SELECT t.*, k.plat_nomor, k.jenis_kendaraan 
                         FROM tb_transaksi t
                         JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                         WHERE DATE(t.waktu_keluar) = ? AND t.status = 'keluar'
                         ORDER BY t.waktu_keluar DESC
                         LIMIT 5";
                $stmt = $db->prepare($query);
                $stmt->execute([$today]);
                $notif_keluar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $jumlah_keluar = count($notif_keluar);
                ?>
                
                <div class="notif-trigger" 
                    id="dropdownNotif" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                    style="cursor: pointer; position: relative; padding: 8px 12px; background: rgba(255, 255, 255, 0.95); border-radius: 12px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    
                    <i class="fas fa-bell" style="color: #f97316; font-size: 1.2rem;"></i>
                    
                    <?php if($jumlah_keluar > 0): ?>
                    <span class="notif-badge" style="position: absolute; top: 4px; right: 4px; background: #ef4444; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 700; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.4);">
                        <?= $jumlah_keluar ?>
                    </span>
                    <?php endif; ?>
                </div>
                
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" 
                    aria-labelledby="dropdownNotif" 
                    style="border-radius: 16px; overflow: hidden; min-width: 320px; max-width: 400px; padding: 0;">
                    
                    <li class="dropdown-header" style="background: linear-gradient(135deg, #fff7ed, #ffedd5); padding: 16px; border-bottom: 1px solid #fed7aa;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="mb-0 fw-bold" style="font-size: 0.95rem; color: #431407;">
                                    <i class="fas fa-car-side me-2" style="color: #f97316;"></i>Kendaraan Keluar
                                </p>
                                <small style="font-size: 0.75rem; color: #9a3412;">Hari ini</small>
                            </div>
                            <span class="badge" style="background: #f97316; color: white; padding: 4px 10px; border-radius: 8px; font-size: 0.75rem;">
                                <?= $jumlah_keluar ?>
                            </span>
                        </div>
                    </li>
                    
                    <?php if($jumlah_keluar > 0): ?>
                        <?php foreach($notif_keluar as $n): ?>
                        <li class="notif-item" data-id="<?= $n['id_parkir'] ?>" style="padding: 12px 16px; border-bottom: 1px solid #f5f5f5; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#fff7ed'" onmouseout="this.style.background='white'" onclick="goToLaporan('<?= $n['plat_nomor'] ?>', <?= $n['id_parkir'] ?>)">
                            <div class="d-flex align-items-start gap-3">
                                <div style="width: 40px; height: 40px; background: #dcfce7; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fas fa-check-circle" style="color: #16a34a; font-size: 1.1rem;"></i>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <p class="mb-1 fw-bold" style="font-size: 0.85rem; color: #431407;">
                                        <?= strtoupper($n['plat_nomor']) ?>
                                    </p>
                                    <p class="mb-1" style="font-size: 0.75rem; color: #6b7280;">
                                        <?= ucfirst($n['jenis_kendaraan']) ?> • Rp <?= number_format($n['biaya_total'], 0, ',', '.') ?>
                                    </p>
                                    <small style="font-size: 0.7rem; color: #9ca3af;">
                                        <i class="fas fa-clock me-1"></i>
                                        <?= date('H:i', strtotime($n['waktu_keluar'])) ?> WIB
                                    </small>
                                </div>
                                <div class="unread-indicator" style="width: 8px; height: 8px; background: #ef4444; border-radius: 50%; flex-shrink: 0; margin-top: 4px;"></div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        
                        <li style="padding: 12px 16px; text-align: center; background: #fafafa;">
                            <a href="index.php?c=Laporan&m=index" style="color: #f97316; font-weight: 600; font-size: 0.85rem; text-decoration: none;">
                                Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </li>
                    <?php else: ?>
                        <li style="padding: 32px 16px; text-align: center;">
                            <i class="fas fa-inbox" style="font-size: 2rem; color: #d1d5db; margin-bottom: 8px;"></i>
                            <p class="mb-0" style="color: #9ca3af; font-size: 0.85rem;">Belum ada kendaraan keluar hari ini</p>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <!-- Profile Dropdown -->
            <div class="dropdown">
            <div class="profile-dropdown-trigger d-flex align-items-center gap-2" 
                id="dropdownMenuUser" 
                data-bs-toggle="dropdown" 
                aria-expanded="false" 
                role="button"
                style="cursor: pointer; padding: 8px 16px; background: rgba(255, 255, 255, 0.95); border-radius: 50px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                
                <span class="profile-name d-none d-sm-block" style="color: #431407; font-weight: 600; font-size: 0.9rem; margin-right: 4px;">
                    Profil
                </span>
                
                <div class="profile-avatar" style="width: 36px; height: 36px; background: linear-gradient(135deg, #f97316, #fb923c); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 0.9rem; font-weight: 600; box-shadow: 0 2px 6px rgba(249, 115, 22, 0.3);">
                    <i class="fas fa-user"></i>
                </div>
                
                <i class="fas fa-chevron-down" style="color: #9a3412; font-size: 0.7rem; margin-left: 4px;"></i>
            </div>

            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" 
                aria-labelledby="dropdownMenuUser" 
                style="border-radius: 16px; overflow: hidden; min-width: 200px; padding: 0;">
                
                <li class="dropdown-header" style="background: linear-gradient(135deg, #fff7ed, #ffedd5); padding: 16px; border-bottom: 1px solid #fed7aa;">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #f97316, #fb923c); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1rem; box-shadow: 0 2px 8px rgba(249, 115, 22, 0.3);">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-bold" style="font-size: 0.95rem; color: #431407;"><?= $user_nama ?></p>
                        </div>
                    </div>
                </li>
                
                <li style="padding: 8px;">
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 rounded-3" href="index.php?c=Auth&m=logout" style="transition: all 0.2s; color: #ef4444; font-weight: 600;">
                        <i class="fas fa-sign-out-alt" style="width: 20px;"></i> 
                        <span>Logout</span>
                    </a>
                </li>
            </div>
        </div>
    </nav>

        <div class="container-fluid">