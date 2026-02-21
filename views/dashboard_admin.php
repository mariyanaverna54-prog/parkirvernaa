<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">
<link rel="stylesheet" href="assets/css/dashboard.css">

<div class="container-fluid py-4">
    <div class="page-header-section">
        <h3 class="page-title">Dashboard Admin</h3>
        <p class="page-subtitle">Operasi parkir admin.</p>
    </div>

<div class="row g-4 mb-5">
    
    <div class="col-md-4">
        <div class="card card-custom">
            <div class="card-body p-0">
                <div class="icon-circle" style="color: #f97316; background: #fff7ed;">
                    <i class="fas fa-list-ol"></i>
                </div>
                <h6>Jumlah Parkir Hari Ini</h6>
                  <?php $di_dalam = ($data['totalMasuk'] ?? 0) - ($data['totalKeluar'] ?? 0); ?>
                    <h2><?= ($di_dalam < 0) ? 0 : $di_dalam ?> <small class="fs-6">Unit</small></h2>
                <p class="text-muted small mb-0">Total semua kendaraan masuk</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-custom">
            <div class="card-body p-0">
                <div class="icon-circle" style="color: #3b82f6; background: #dbeafe;">
                    <i class="fas fa-car-side"></i>
                </div>
                <h6>Sedang Parkir</h6>
                <h2><?= number_format($data['sedangParkir'] ?? 0) ?> <small style="font-size: 1rem; font-weight: 400;">Unit</small></h2>
                <p class="text-muted small mt-2 mb-0">Kendaraan yang masih di dalam area</p>
            </div>
        </div>
    </div>

        <div class="col-md-4">
            <div class="card card-custom">
                <div class="card-body p-0">
                    <div class="icon-circle" style="color: #8b5cf6; background: #ede9fe;"><i class="fas fa-clock"></i></div>
                    <h6>Jam</h6>
                    <h2 id="clock" style="letter-spacing: 2px;">00:00:00</h2>
                </div>
            </div>
        </div>
    </div>

    <?php 
    // Pastikan $dataArea adalah array dan bisa di-looping
    if (isset($dataArea) && is_array($dataArea)): 
        foreach($dataArea as $a): 
            // Tambahkan pengecekan: jika $a bukan array, lewati (skip)
            if (!is_array($a)) continue;

            $terisi = $a['terisi'] ?? 0;
            $kapasitas = $a['kapasitas'] ?? 0;
            $sisa = $kapasitas - $terisi; 
            $persen = ($kapasitas > 0) ? ($terisi / $kapasitas) * 100 : 0;

            // Logika Icon & Warna
            $nama_area = strtolower($a['nama_area'] ?? '');
            if (strpos($nama_area, 'truk') !== false || strpos($nama_area, 'bus') !== false) {
                $icon = "fa-truck-moving"; $themeColor = "text-danger";
            } elseif (strpos($nama_area, 'mobil') !== false) {
                $icon = "fa-car"; $themeColor = "text-primary";
            } elseif (strpos($nama_area, 'motor') !== false) {
                $icon = "fa-motorcycle"; $themeColor = "text-info";
            } else {
                $icon = "fa-layer-group"; $themeColor = "text-secondary";
            }

            $barColor = ($persen >= 90) ? "bg-danger" : (($persen >= 70) ? "bg-warning" : "bg-success");
    ?>
    
    <?php 
        endforeach; 
    else: 
    ?>
    <?php endif; ?>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const clock = document.getElementById('clock');
        if(clock) {
            clock.textContent = now.getHours().toString().padStart(2, '0') + ":" + 
                              now.getMinutes().toString().padStart(2, '0') + ":" + 
                              now.getSeconds().toString().padStart(2, '0');
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

<?php include "views/layout/footer.php"; ?>