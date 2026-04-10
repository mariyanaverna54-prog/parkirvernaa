<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/dashboard.css">

<div class="container-fluid py-4">
    <div class="page-header-section">
        <h3 class="page-title">Dashboard Owner</h3>
        <p class="page-subtitle">Analisis pendapatan dan performa bisnis Anda secara real-time.</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card card-custom bg-orange border-0 shadow-sm">
                <div class="card-body p-0"> 
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="icon-circle m-0">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <span class="badge bg-white text-orange rounded-pill px-3" style="color: #f97316 !important; font-weight: bold;">Hari Ini</span>
                    </div>
                    <h6 class="small mb-1 opacity-75">TOTAL PENDAPATAN</h6>
                    <h2 class="fw-bold mb-0">Rp <?= number_format($data['totalPendapatan'] ?? 0) ?></h2>
                    <p class="small mb-0 mt-2 opacity-75"><i class="fas fa-check-circle me-1"></i> Transaksi lunas</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="icon-circle" style="color: #3b82f6; background: #dbeafe;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h6 class="text-muted small mb-1">AREA TER-RAMAI</h6>
                    <h2 class="fw-bold" style="color: #3b82f6;"><?= $data['areaPopuler'] ?? 'Belum Ada' ?></h2>
                    <p class="text-muted small mb-0 mt-2">Titik favorit hari ini</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-custom border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="icon-circle" style="color: #10b981; background: #d1fae5;">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <h6 class="text-muted small mb-1">TRANSAKSI SELESAI</h6>
                    <h2 class="fw-bold" style="color: #10b981;"><?= number_format($data['totalSelesai'] ?? 0) ?> <small class="fs-6 fw-normal text-muted">Unit</small></h2>
                    <p class="text-muted small mb-0 mt-2">Kendaraan sudah keluar</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card card-custom p-4 border-0 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-0" style="color: var(--text-main);">Komposisi Kendaraan</h5>
                        <small class="text-muted">Data berdasarkan jenis hari ini</small>
                    </div>
                </div>
                
                <div class="row align-items-center h-100">
                    <div class="col-md-5 text-center">
                        <div class="p-4 rounded-4" style="background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); border: 1px solid #fed7aa;">
                            <i class="fas fa-chart-pie fa-3x mb-3 text-orange opacity-50"></i>
                            <h4 class="fw-bold text-orange mb-1"><?= number_format(($data['totalSelesai'] ?? 0) + ($data['sedangParkir'] ?? 0)) ?></h4>
                            <p class="small text-muted mb-0">Total Hari Ini</p>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item border-0 px-0 mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold small"><i class="fas fa-car text-primary me-2"></i> Mobil</span>
                                    <span class="badge bg-primary rounded-pill">60%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0 mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold small"><i class="fas fa-motorcycle text-info me-2"></i> Motor</span>
                                    <span class="badge bg-info rounded-pill">35%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-info" style="width: 35%"></div>
                                </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold small"><i class="fas fa-truck text-secondary me-2"></i> Truk</span>
                                    <span class="badge bg-secondary rounded-pill">5%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-secondary" style="width: 5%"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
                <div class="d-flex align-items-center p-3 rounded-4 mb-3" style="background: #fff1f2; border: 1px solid #fecdd3;">
                    <div class="bg-danger bg-opacity-10 p-3 rounded-3 text-danger me-3">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold" style="font-size: 0.85rem;"><?= number_format($data['sedangParkir'] ?? 0) ?> Unit</h6>
                        <small class="text-danger">Sedang Parkir</small>
                    </div>
                </div>

                <div class="text-center mt-auto">
                    <p class="small text-muted mb-3 italic">Butuh data pembukuan?</p>
                    <a href="index.php?c=Laporan" class="btn w-100 fw-bold rounded-3 py-3 mb-2 shadow-sm" style="background: linear-gradient(135deg, #fb923c, #f97316); color: white; border: none;">
                        <i class="fas fa-file-export me-2"></i> Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "views/layout/footer.php"; ?>