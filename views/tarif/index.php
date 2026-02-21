<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid py-4">
    <div class="page-header-section d-flex justify-content-between align-items-center">
        <div>
            <h3 class="page-title"><i class="fas fa-money-bill-wave me-2"></i>Tarif Parkir</h3>
        </div>
        <a href="index.php?c=Tarif&m=create" class="btn btn-primary shadow-sm px-4">
            <i class="fas fa-plus me-2"></i> Tambah Tarif
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="py-3 ps-4">No</th>
                            <th>Jenis Kendaraan</th>
                            <th>Tarif Per Jam</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php $no=1; foreach($data as $d): ?>
                            <tr>
                                <td class="ps-4"><?= $no++ ?></td>
                                <td>
                                    <span class="badge text-uppercase" style="background: #1f2937; color: white; padding: 8px 20px; border-radius: 8px; font-weight: 600; font-size: 0.85rem;"><?= $d['jenis_kendaraan'] ?></span>
                                </td>
                                <td class="fw-bold text-success">Rp <?= number_format($d['tarif_per_jam'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <a href="index.php?c=Tarif&m=edit&id=<?= $d['id_tarif'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="index.php?c=Tarif&m=delete&id=<?= $d['id_tarif'] ?>" 
                                       onclick="return confirm('Yakin hapus tarif ini?')" 
                                       class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-database fa-3x mb-3 d-block opacity-25"></i>
                                    Belum ada data tarif.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "views/layout/footer.php"; ?>
