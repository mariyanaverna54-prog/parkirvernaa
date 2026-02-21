<?php include "views/layout/header.php"; ?>

<style>
/* CSS Kamu tetap aman */
:root {
    --sidebar-width: 280px;
    --bg-body: #fff9f5;
    --bg-sidebar: #ffffff;
    --bg-card: #ffffff;
    --accent-color: #f97316;
    --accent-light: #fff7ed;
    --text-main: #431407;
    --text-muted: #9a3412;
    --border-color: #fed7aa;
}

body { 
    font-family: 'Plus Jakarta Sans', sans-serif; 
    background-color: var(--bg-body) !important; 
    margin: 0;
    color: var(--text-main);
}

.card-custom {
    background-color: #fff !important;
    border: 1px solid var(--border-color) !important;
    border-radius: 20px !important;
    padding: 25px;
    box-shadow: 0 10px 15px -3px rgba(249, 115, 22, 0.05) !important;
    transition: 0.3s;
    height: 100%;
}

.card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 20px -3px rgba(249, 115, 22, 0.1) !important;
}

.icon-circle {
    width: 55px;
    height: 55px;
    background: var(--accent-light);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent-color);
    font-size: 1.6rem;
    margin-bottom: 20px;
}

.card-custom h6 {
    color: var(--text-muted);
    font-weight: 600;
    font-size: 0.8rem; /* Sedikit lebih kecil agar muat */
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card-custom h2 {
    color: var(--text-main);
    font-weight: 800;
    margin-bottom: 0;
    font-size: 1.5rem; /* Menyesuaikan agar proporsional */
}

.container-fluid { padding: 0 40px 40px 40px; }
</style>

<div class="container-fluid py-4">
    <div class="page-header-section">
        <h3 class="page-title">Dashboard Petugas</h3>
        <p class="page-subtitle">Operasi parkir petugas.</p>
    </div>

<div class="row g-4 mb-5">
    
    <div class="col-md-4">
        <div class="card card-custom">
            <div class="card-body p-0">
                <div class="icon-circle" style="color: #f97316; background: #fff7ed;">
                    <i class="fas fa-list-ol"></i>
                </div>
                <h6>Jumlah Parkir Hari Ini</h6>
                <?php 
                    // Total transaksi hari ini = kendaraan yang masuk hari ini (termasuk yang sudah keluar)
                    $totalHariIni = $data['totalMasuk'] ?? 0;
                ?>
                <h2><?= number_format($totalHariIni) ?> <small class="fs-6">Kendaraan</small></h2>
                <p class="text-muted small mb-0">Total kendaraan parkir hari ini</p>
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