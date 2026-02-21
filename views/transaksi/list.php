<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<style>
/* Fix dropdown profil di halaman transaksi - FORCE VISIBLE */
.dropdown-menu {
    position: absolute !important;
    top: 100% !important;
    right: 0 !important;
    left: auto !important;
    z-index: 999999 !important;
    margin-top: 8px !important;
}

.dropdown-menu.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    z-index: 999999 !important;
}

.dropdown {
    position: relative !important;
    z-index: 99999 !important;
}

.profile-dropdown-trigger {
    position: relative !important;
    z-index: 99999 !important;
    pointer-events: auto !important;
}

/* Pastikan card tidak menutupi dropdown */
.card, .table-responsive, table, tbody, thead {
    position: relative !important;
    z-index: 1 !important;
}

.container-fluid {
    position: relative !important;
    z-index: 1 !important;
}

/* Button Soft Orange Theme */
.btn-keluar-soft {
    background: linear-gradient(135deg, #fff7ed, #ffedd5) !important;
    color: #ea580c !important;
    border: 2px solid #fed7aa !important;
    border-radius: 10px !important;
    padding: 8px 16px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 8px rgba(249, 115, 22, 0.15) !important;
}

.btn-keluar-soft:hover {
    background: linear-gradient(135deg, #fed7aa, #fdba74) !important;
    color: #c2410c !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(249, 115, 22, 0.25) !important;
}

.btn-struk-soft {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe) !important;
    color: #1d4ed8 !important;
    border: 2px solid #93c5fd !important;
    border-radius: 10px !important;
    padding: 8px 16px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15) !important;
}

.btn-struk-soft:hover {
    background: linear-gradient(135deg, #93c5fd, #60a5fa) !important;
    color: #1e40af !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25) !important;
}
</style>

<div class="container-fluid py-4 px-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="page-title mb-0">Transaksi Kendaraan</h5>
            <?php if($_SESSION['user']['role'] !== 'owner'): ?>
                <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th class="text-center">Plat Nomor</th>
                        <th class="text-center">Waktu Masuk</th>
                        <th class="text-center">Status</th>
                        <?php if($_SESSION['user']['role'] == 'petugas'): ?>
                        <th class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($data)): ?>
                    <?php $no=1; foreach($data as $d): ?>
                        <tr>
                            <td class="ps-4"><?= $no++ ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <span class="badge bg-dark px-3 py-2 font-monospace fs-6 shadow-sm text-uppercase" 
                                          style="min-width: 120px; letter-spacing: 2px; border: 2px solid #333; border-radius: 6px;">
                                        <?= htmlspecialchars($d['plat_nomor']) ?>
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <strong><?= date('H:i', strtotime($d['waktu_masuk'])) ?></strong><br>
                                <small class="text-muted"><?= date('d/m/Y', strtotime($d['waktu_masuk'])) ?></small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success border border-success px-3 rounded-pill">
                                    Aktif
                                </span>
                            </td>
                            <?php if($_SESSION['user']['role'] == 'petugas'): ?>
                            <td class="text-end pe-4">
                                <a href="index.php?c=Transaksi&m=keluar&id=<?= $d['id_parkir'] ?>" 
                                   class="btn btn-keluar-soft btn-sm me-2">
                                    <i class="fas fa-sign-out-alt me-1"></i> Keluar
                                </a>
                                <a href="index.php?c=Transaksi&m=struk&id=<?= $d['id_parkir'] ?>" 
                                   target="_blank"
                                   class="btn btn-struk-soft btn-sm">
                                    <i class="fas fa-print me-1"></i> Struk
                                </a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">Tidak ada kendaraan yang sedang parkir.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Force dropdown to work on transaksi page
document.addEventListener('DOMContentLoaded', function() {
    const dropdownTrigger = document.getElementById('dropdownMenuUser');
    const dropdownMenu = dropdownTrigger ? dropdownTrigger.nextElementSibling : null;
    
    if (dropdownTrigger && dropdownMenu) {
        dropdownTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Toggle show class
            if (dropdownMenu.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
            } else {
                dropdownMenu.classList.add('show');
            }
        });
        
        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!dropdownTrigger.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }
});
</script>

<?php include "views/layout/footer.php"; ?>