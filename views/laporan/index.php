<?php include "views/layout/header.php"; ?>

<?php if (isset($halaman) && $halaman == 'log') : ?>

<style>
    /* Override dark theme untuk halaman log aktivitas */
    body { 
        background-color: #fff9f5 !important; 
        color: #1f2937 !important;
    }
    
    #content {
        background-color: #fff9f5 !important;
    }
    
    .container-fluid {
        background-color: #fff9f5 !important;
    }
    
    /* Override sidebar ke tema orange */
    #sidebar {
        background: #ffffff !important;
        box-shadow: 4px 0 10px rgba(0,0,0,0.05) !important;
    }
    
    #sidebar .sidebar-header h4 {
        color: #1f2937 !important;
    }
    
    #sidebar .sidebar-header i {
        color: #f97316 !important;
    }
    
    #sidebar .nav-link {
        color: #6b7280 !important;
    }
    
    #sidebar .nav-link:hover {
        color: #1f2937 !important;
        background: rgba(249, 115, 22, 0.1) !important;
    }
    
    #sidebar .nav-link.active {
        background: linear-gradient(135deg, #fb923c, #f97316) !important;
        color: #fff !important;
    }
    
    #sidebar hr {
        border-color: #e5e7eb !important;
    }
</style>

    <div class="mb-4">
        <h3 class="fw-bold m-0 text-dark"><i class="fas fa-history me-2 text-warning"></i>Log Aktivitas Sistem</h3>
        <p class="text-muted small mb-0">Riwayat login dan logout pengguna sistem</p>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; background: white;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle m-0">
                    <thead style="background: linear-gradient(135deg, #fb923c, #f97316); color: white;">
                        <tr>
                            <th class="py-3 ps-4" width="5%">No</th>
                            <th width="20%">Waktu Kejadian</th>
                            <th width="20%">Pelaksana</th>
                            <th>Detail Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody style="background: white;">
                        <?php if (!empty($logs)): ?>
                            <?php $no=1; foreach($logs as $l): ?>
                            <tr>
                                <td class="ps-4 text-dark"><?= $no++ ?></td>
                                <td>
                                    <div class="text-dark fw-bold"><?= date('d M Y', strtotime($l['waktu_aktivitas'])) ?></div>
                                    <small class="text-muted"><?= date('H:i:s', strtotime($l['waktu_aktivitas'])) ?> WIB</small>
                                </td>
                                <td>
                                    <span class="badge px-3 py-2" style="background: #fff7ed; color: #f97316; border: 1px solid #fed7aa; border-radius: 8px;">
                                        <i class="fas fa-user me-1"></i> <?= $l['username'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="p-2 rounded border-start border-4 border-warning text-dark" style="background: #fff7ed;">
                                        <?= $l['aktivitas'] ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x mb-3 opacity-25 text-muted"></i>
                                    <p class="text-muted">Belum ada riwayat aktivitas yang tercatat.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php else : ?>
<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0"><i class="fas fa-file-invoice-dollar me-2"></i>Laporan Parkir</h3>
        
        <?php if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['role'] == 'petugas') : ?>
            <a target="_blank"
               href="index.php?c=Laporan&m=cetak&tgl_awal=<?= $_GET['tgl_awal'] ?? date('Y-m-d') ?>&tgl_akhir=<?= $_GET['tgl_akhir'] ?? date('Y-m-d') ?>"
               class="btn btn-success shadow-sm px-4"
               style="background: linear-gradient(135deg, #d1fae5, #a7f3d0) !important; color: #15803d !important; border: 2px solid #6ee7b7 !important; font-weight: 600;">
               <i class="fas fa-print me-2"></i> Cetak Laporan
            </a>
        <?php endif; ?>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form method="get" class="row g-3">
    <input type="hidden" name="c" value="Laporan">
    <input type="hidden" name="m" value="index">

    <div class="col-md-3">
        <label class="form-label small fw-bold text-muted">Dari Tanggal</label>
        <input type="date" name="tgl_awal" class="form-control shadow-sm" value="<?= $_GET['tgl_awal'] ?? date('Y-m-d') ?>">
    </div>
    
    <div class="col-md-3">
        <label class="form-label small fw-bold text-muted">Sampai Tanggal</label>
        <input type="date" name="tgl_akhir" class="form-control shadow-sm" value="<?= $_GET['tgl_akhir'] ?? date('Y-m-d') ?>">
    </div>

    <div class="col-md-4">
        <label class="form-label small fw-bold text-muted">Cari Plat Nomor</label>
        <div class="input-group shadow-sm">
            <span class="input-group-text bg-white border-end-0">
                <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" name="search" class="form-control border-start-0" 
                   value="<?= $_GET['search'] ?? '' ?>" placeholder="Contoh: D 1234 ABC">
            <button class="btn px-4" type="submit"
                    style="background: linear-gradient(135deg, #dbeafe, #bfdbfe) !important; color: #1d4ed8 !important; border: 2px solid #93c5fd !important; font-weight: 600;">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
        </div>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <a href="index.php?c=Laporan&m=index" class="btn w-100 shadow-sm"
           style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb) !important; color: #4b5563 !important; border: 2px solid #d1d5db !important; font-weight: 600;">
            <i class="fas fa-sync-alt me-1"></i> Reset
        </a>
    </div>
</form>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle bg-white shadow-sm" style="border-radius: 10px; overflow: hidden;">
            <thead class="table-dark">
                <tr>
                    <th class="py-3 ps-3">No</th>
                    <th>Plat Nomor</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Durasi</th>
                    <th>Total Biaya</th>
                    <th>Metode</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php $no=1; foreach($data as $d): ?>
                    <tr data-plat="<?= strtoupper($d['plat_nomor']) ?>" class="laporan-row">
                        <td class="ps-3"><?= $no++ ?></td>
                        <td>
                            <span class="badge bg-dark text-uppercase px-3 py-2" style="letter-spacing: 1px; font-family: monospace;">
                                <?= $d['plat_nomor'] ?>
                            </span>
                        </td>
                        <td><small class="text-muted"><i class="far fa-clock me-1"></i><?= $d['waktu_masuk'] ?></small></td>
                        <td>
                            <small class="text-primary fw-bold">
                                <i class="fas fa-sign-out-alt me-1"></i><?= $d['waktu_keluar'] ?? '-' ?>
                            </small>
                        </td>
                        
                        <td class="fw-bold text-dark">
                            <?php 
                                if (!empty($d['waktu_keluar'])) {
                                    $awal  = new DateTime($d['waktu_masuk']);
                                    $akhir = new DateTime($d['waktu_keluar']);
                                    $diff  = $awal->diff($akhir);
                                    
                                    // Menampilkan Jam dan Menit
                                    echo ($diff->days * 24) + $diff->h . "j " . $diff->i . "m";
                                } else {
                                    echo "-";
                                }
                            ?>
                        </td>

                        <td class="fw-bold text-success">Rp <?= number_format($d['biaya_total'] ?? 0, 0, ',', '.') ?></td>
                        <td>
                            <span class="badge bg-info-subtle text-info border border-info-subtle px-3">
                                <?= $d['metode_bayar'] ?? 'Tunai' ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if (!empty($d['waktu_keluar'])): ?>
                                <span class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #15803d; border: 2px solid #6ee7b7; font-weight: 600;">
                                    <i class="fas fa-check-circle me-1"></i>Selesai
                                </span>
                            <?php else: ?>
                                <span class="badge px-3 py-2 rounded-pill" style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #b45309; border: 2px solid #fcd34d; font-weight: 600;">
                                    <i class="fas fa-clock me-1"></i>Parkir
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-database fa-3x mb-3 d-block opacity-25"></i>
                            Data tidak ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php endif; ?>

<script>
// Highlight row dari notifikasi
document.addEventListener('DOMContentLoaded', function() {
    const highlightPlat = sessionStorage.getItem('highlightPlat');
    if (highlightPlat) {
        const rows = document.querySelectorAll('.laporan-row');
        rows.forEach(row => {
            const platNomor = row.getAttribute('data-plat');
            if (platNomor && platNomor.toUpperCase() === highlightPlat.toUpperCase()) {
                // Highlight dengan animasi
                row.style.background = 'linear-gradient(90deg, #fff7ed, #ffedd5)';
                row.style.border = '2px solid #f97316';
                row.style.transition = 'all 0.3s ease';
                
                // Scroll ke row
                setTimeout(() => {
                    row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
                
                // Animasi pulse
                let pulseCount = 0;
                const pulseInterval = setInterval(() => {
                    row.style.transform = pulseCount % 2 === 0 ? 'scale(1.02)' : 'scale(1)';
                    pulseCount++;
                    if (pulseCount > 4) {
                        clearInterval(pulseInterval);
                        row.style.transform = 'scale(1)';
                    }
                }, 300);
            }
        });
        
        // Clear setelah digunakan
        sessionStorage.removeItem('highlightPlat');
    }
});
</script>

<?php include "views/layout/footer.php"; ?>