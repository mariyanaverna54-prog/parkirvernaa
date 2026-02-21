<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Area Parkir</h3>
            <p class="text-muted mb-0">Pantau dan kelola kapasitas lahan parkir berdasarkan kategori kendaraan.</p>
        </div>
        <a href="index.php?c=Area&m=create" class="btn btn-primary shadow-sm px-4">
            <i class="fas fa-plus me-2"></i> Tambah Area
        </a>
    </div>

    <div class="row">
        <?php if (!empty($data)): ?>
            <?php foreach($data as $a): 
                $terisi = $a['terisi'] ?? 0;
                $kapasitas = $a['kapasitas'] ?? 0;
                $sisa = $kapasitas - $terisi; 
                $persen = ($kapasitas > 0) ? ($terisi / $kapasitas) * 100 : 0;

                // Logika Penentuan Icon & Warna Berdasarkan Nama Area
                $nama_area = strtolower($a['nama_area']);
                if (strpos($nama_area, 'truk') !== false || strpos($nama_area, 'bus') !== false) {
                    $icon = "fa-truck-moving";
                    $themeColor = "text-danger"; // Merah untuk kendaraan berat
                } elseif (strpos($nama_area, 'mobil') !== false) {
                    $icon = "fa-car";
                    $themeColor = "text-primary"; // Biru untuk mobil
                } elseif (strpos($nama_area, 'motor') !== false) {
                    $icon = "fa-motorcycle";
                    $themeColor = "text-info"; // Biru muda/Cyan untuk motor
                } else {
                    $icon = "fa-layer-group";
                    $themeColor = "text-secondary";
                }

                // Warna Progress Bar berdasarkan kepadatan
                $colorClass = "bg-success"; 
                if ($persen >= 90) {
                    $colorClass = "bg-danger"; 
                } elseif ($persen >= 70) {
                    $colorClass = "bg-warning"; 
                }
            ?>
            
            <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-4 rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold text-dark mb-1"><?= htmlspecialchars($a['nama_area']) ?></h5>
                                <span class="badge bg-light <?= $themeColor ?> border rounded-pill px-3">
                                    <i class="fas <?= $icon ?> me-1"></i> Area Khusus
                                </span>
                            </div>
                            <div class="text-end">
                                <h2 class="fw-bold mb-0 <?= $sisa <= 0 ? 'text-danger' : 'text-success' ?>">
                                    <?= $sisa ?>
                                </h2>
                                <p class="text-muted small mb-0">Slot Tersedia</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted">Tingkat Keterisian</small>
                                <small class="fw-bold"><?= round($persen) ?>%</small>
                            </div>
                            <div class="progress rounded-pill shadow-sm" style="height: 12px;">
                                <div class="progress-bar <?= $colorClass ?> progress-bar-striped progress-bar-animated" 
                                     style="width: <?= $persen ?>%"></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4 border-top pt-3">
                            <div class="text-center">
                                <small class="text-muted d-block">Terisi</small>
                                <span class="fw-bold"><i class="fas <?= $icon ?> <?= $themeColor ?> me-1"></i><?= $terisi ?></span>
                            </div>
                            <div class="text-center border-start ps-4 pe-4">
                                <small class="text-muted d-block">Total Kapasitas</small>
                                <span class="fw-bold text-dark"><?= $kapasitas ?></span>
                            </div>
                            <div class="text-center border-start ps-4">
                                <small class="text-muted d-block">Status</small>
                                <?php if($sisa <= 0): ?>
                                    <span class="badge bg-danger">Penuh</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Tersedia</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <a href="index.php?c=Area&m=edit&id=<?= $a['id_area'] ?>" class="btn btn-sm btn-warning flex-fill">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="index.php?c=Area&m=delete&id=<?= $a['id_area'] ?>" 
                               onclick="return confirm('Yakin hapus area ini?')" 
                               class="btn btn-sm btn-danger flex-fill">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-map-marked-alt fa-3x text-muted mb-3 opacity-25"></i>
                <p class="text-muted">Data area parkir belum dikonfigurasi.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include "views/layout/footer.php"; ?>