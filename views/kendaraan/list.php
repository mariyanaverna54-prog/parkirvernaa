<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<style>
/* Fix dropdown profil di halaman kendaraan */
.dropdown-menu {
    position: absolute !important;
    inset: 0px 0px auto auto !important;
    margin: 0px !important;
    transform: translate(0px, 50px) !important;
    z-index: 99999 !important;
}

/* Pastikan card tidak menutupi dropdown */
.card, .table-responsive {
    position: relative !important;
    z-index: 1 !important;
}

/* Button Soft Theme untuk Kendaraan */
.btn-detail-soft {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe) !important;
    color: #1d4ed8 !important;
    border: 2px solid #93c5fd !important;
    border-radius: 10px !important;
    padding: 6px 14px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15) !important;
}

.btn-detail-soft:hover {
    background: linear-gradient(135deg, #93c5fd, #60a5fa) !important;
    color: #1e40af !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25) !important;
}

.btn-edit-soft {
    background: linear-gradient(135deg, #fef3c7, #fde68a) !important;
    color: #b45309 !important;
    border: 2px solid #fcd34d !important;
    border-radius: 10px !important;
    padding: 6px 14px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.15) !important;
}

.btn-edit-soft:hover {
    background: linear-gradient(135deg, #fcd34d, #fbbf24) !important;
    color: #92400e !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.25) !important;
}

.btn-delete-soft {
    background: linear-gradient(135deg, #fee2e2, #fecaca) !important;
    color: #dc2626 !important;
    border: 2px solid #fca5a5 !important;
    border-radius: 10px !important;
    padding: 6px 14px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.15) !important;
}

.btn-delete-soft:hover {
    background: linear-gradient(135deg, #fca5a5, #f87171) !important;
    color: #b91c1c !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25) !important;
}

.btn-masuk-soft {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0) !important;
    color: #15803d !important;
    border: 2px solid #6ee7b7 !important;
    border-radius: 10px !important;
    padding: 6px 14px !important;
    font-weight: 600 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 8px rgba(22, 163, 74, 0.15) !important;
}

.btn-masuk-soft:hover {
    background: linear-gradient(135deg, #6ee7b7, #34d399) !important;
    color: #14532d !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25) !important;
}
</style>

<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0" style="color: var(--text-main);">Data Kendaraan</h3>
            <p class="text-muted small mb-0">Data kendaraan masuk dan keluar.</p>
        </div>
        
        <?php if($_SESSION['user']['role'] == 'admin'): ?>
        <a href="index.php?c=Kendaraan&m=create" class="btn btn-orange shadow-sm px-4">
            <i class="fas fa-plus-circle me-2"></i>Tambah Kendaraan Baru
        </a>
        <?php endif; ?>
    </div>

    <div class="card card-custom overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Plat Nomor</th>
                        <th class="text-start">Info Kendaraan</th>
                        <th class="text-center">Status Parkir</th>
                        <?php if($_SESSION['user']['role'] == 'owner'): ?>
                            <th width="15%" class="text-center">Keterangan</th>
                        <?php elseif($_SESSION['user']['role'] == 'admin'): ?>
                            <th width="15%" class="text-center">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php $no = 1; foreach($data as $d): ?>
                            <tr>
                                <td class="text-center fw-bold" style="color: var(--text-main);"><?= $no++ ?></td>
                                
                                <td class="text-center align-middle">
                                    <span class="plat-nomor">
                                        <?= strtoupper(htmlspecialchars($d['plat_nomor'])) ?>
                                    </span>
                                </td>
                                
                                <td class="text-start">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold" style="color: var(--text-main);"><?= htmlspecialchars($d['jenis_kendaraan']) ?></span>
                                        <small class="text-muted text-uppercase"><?= htmlspecialchars($d['warna']) ?></small>
                                    </div>
                                </td>
                                
                                <td class="text-center">
                                    <?php 
                                    $status = $d['status_terakhir'] ?? '';
                                    if ($status == 'masuk'): ?>
                                        <span class="badge-parkir status-proses">
                                            <i class="fas fa-clock me-1"></i> Sedang Parkir
                                        </span>
                                    <?php elseif ($status == 'keluar'): ?>
                                        <span class="badge-parkir status-selesai">
                                            <i class="fas fa-check-double me-1"></i> Sudah Keluar
                                        </span>
                                    <?php else: ?>
                                        <span class="badge-parkir" style="background: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0;">
                                            <i class="fas fa-check-circle me-1"></i> Tersedia
                                        </span>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="text-center">
                                    <?php if($_SESSION['user']['role'] == 'owner'): ?>
                                        <!-- UNTUK OWNER: Tampilkan info keterangan -->
                                        <?php if (empty($status)): ?>
                                            <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb); color: #6b7280; border: 2px solid #d1d5db; font-weight: 600;">
                                                <i class="fas fa-minus-circle me-1"></i>Belum Parkir
                                            </span>
                                        <?php elseif ($status == 'masuk'): ?>
                                            <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #b45309; border: 2px solid #fcd34d; font-weight: 600;">
                                                <i class="fas fa-parking me-1"></i>Sedang Parkir
                                            </span>
                                        <?php else: ?>
                                            <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #15803d; border: 2px solid #6ee7b7; font-weight: 600;">
                                                <i class="fas fa-check-circle me-1"></i>Selesai
                                            </span>
                                        <?php endif; ?>
                                    <?php elseif($_SESSION['user']['role'] == 'admin'): ?>
                                        <!-- UNTUK ADMIN: Tampilkan tombol aksi -->
                                        <div class="d-flex justify-content-center gap-2">
                                            <?php if (empty($status)): ?>
                                                <a href="index.php?c=Transaksi&m=masuk&id=<?= $d['id_kendaraan'] ?>" 
                                                   class="btn btn-masuk-soft btn-sm">
                                                    <i class="fas fa-sign-in-alt me-1"></i> Masuk
                                                </a>
                                            <?php elseif ($status == 'masuk'): ?>
                                                <a href="index.php?c=Transaksi&m=index" 
                                                   class="btn btn-detail-soft btn-sm">
                                                    <i class="fas fa-eye me-1"></i> Detail
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted small fw-bold">Selesai</span>
                                            <?php endif; ?>
                                            
                                            <a href="index.php?c=Kendaraan&m=edit&id=<?= $d['id_kendaraan'] ?>" 
                                               class="btn btn-edit-soft btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="index.php?c=Kendaraan&m=delete&id=<?= $d['id_kendaraan'] ?>" 
                                               onclick="return confirm('Yakin hapus kendaraan ini?')"
                                               class="btn btn-delete-soft btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="<?= ($_SESSION['user']['role'] == 'owner' || $_SESSION['user']['role'] == 'admin') ? '5' : '4' ?>" class="text-center py-5 text-muted">Belum ada data kendaraan terdaftar.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "views/layout/footer.php"; ?>