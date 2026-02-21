<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0" style="color: var(--text-main);">Riwayat Parkir Selesai</h3>
            <p class="text-muted small mb-0">Laporan transaksi kendaraan yang sudah keluar.</p>
        </div>
        
        <a href="index.php?c=Transaksi&m=index" class="btn btn-orange shadow-sm px-4">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Monitoring
        </a>
    </div>

    <div class="card card-custom overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color: #fffaf5;">
                        <th class="text-center" width="5%" style="color: var(--accent-color);">NO</th>
                        <th class="text-center" width="15%" style="color: var(--accent-color);">PLAT NOMOR</th>
                        <th class="text-center" style="color: var(--accent-color);">WAKTU MASUK</th>
                        <th class="text-center" style="color: var(--accent-color);">WAKTU KELUAR</th>
                        <th class="text-end" style="color: var(--accent-color); padding-right: 30px;">TOTAL BAYAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php $no = 1; foreach($data as $row): ?>
                            <tr>
                                <td class="text-center fw-bold" style="color: #5d4037;">
                                    <?= $no++ ?>
                                </td>
                                
                                <td class="text-center">
                                    <span class="plat-nomor px-3 py-1" style="background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; font-weight: bold; letter-spacing: 1px;">
                                        <?= strtoupper(htmlspecialchars($row['plat_nomor'])) ?>
                                    </span>
                                </td>
                                
                                <td class="text-center">
                                    <div class="small fw-bold text-dark">
                                        <?= date('d M Y', strtotime($row['waktu_masuk'])) ?>
                                    </div>
                                    <div class="text-muted small" style="font-size: 11px;">
                                        <i class="far fa-clock me-1"></i><?= date('H:i', strtotime($row['waktu_masuk'])) ?> WIB
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="small fw-bold text-dark">
                                        <?= date('d M Y', strtotime($row['waktu_keluar'])) ?>
                                    </div>
                                    <div class="text-muted small" style="font-size: 11px;">
                                        <i class="far fa-clock me-1"></i><?= date('H:i', strtotime($row['waktu_keluar'])) ?> WIB
                                    </div>
                                </td>
                                
                                <td class="text-end" style="padding-right: 30px;">
                                    <span class="fw-bold" style="color: #2e7d32;">
                                        Rp <?= number_format($row['biaya_total'], 0, ',', '.') ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat parkir yang selesai.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "views/layout/footer.php"; ?>