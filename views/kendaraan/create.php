<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid p-0 m-0" style="min-height: 100vh; background-color: #f4f7f6;">
    <div class="p-4">
        <div class="row">
            <div class="col-md-8"> 
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0 text-dark">
                            <i class="fas fa-car me-2 text-primary"></i>Tambah Data Kendaraan
                        </h5>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="index.php?c=Kendaraan&m=store" method="POST">
                        
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Plat Nomor</label>
                                <input type="text" name="plat_nomor" class="form-control form-control-lg rounded-3 shadow-sm" 
                                       style="text-transform: uppercase;" 
                                       oninput="this.value = this.value.toUpperCase()" 
                                       placeholder="Contoh: B 1234 ABC" required>
                                <small class="text-muted">Otomatis huruf besar</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Jenis Kendaraan</label>
                                <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select form-control-lg rounded-3 shadow-sm" required onchange="pilihAreaOtomatis()">
                                    <option value="">-- Pilih --</option>
                                    <option value="Mobil">Mobil</option>
                                    <option value="Motor">Motor</option>
                                    <option value="Truk">Truk/Bus</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Area Parkir</label>
                                <select name="id_area" id="id_area" class="form-select form-control-lg rounded-3 shadow-sm" required>
                                    <option value="">-- Pilih Lokasi Parkir --</option>
                                    <?php
                                    $db = Database::connect();
                                    
                                    $sql = "SELECT a.*, 
                                            (SELECT COUNT(*) FROM tb_transaksi t 
                                             WHERE t.id_area = a.id_area AND t.status = 'masuk') as terisi_real 
                                            FROM tb_area_parkir a";
                                    
                                    $areas = $db->query($sql)->fetchAll();
                                    
                                    foreach($areas as $area):
                                        $sisa = $area['kapasitas'] - $area['terisi_real'];
                                        $disabled = ($sisa <= 0) ? 'disabled' : '';
                                        // Simpan nama area dalam format kecil untuk dideteksi JS
                                        $nama_clean = strtolower($area['nama_area']);
                                    ?>
                                        <option value="<?= $area['id_area'] ?>" 
                                                data-nama="<?= $nama_clean ?>" 
                                                <?= $disabled ?>>
                                            <?= htmlspecialchars($area['nama_area']) ?> 
                                            (Tersedia: <?= $sisa ?> Slot) 
                                            <?= ($sisa <= 0) ? '- [PENUH]' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Warna Kendaraan</label>
                                <input type="text" name="warna" class="form-control form-control-lg rounded-3 shadow-sm" placeholder="Contoh: Hitam / Putih" required>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn rounded-3 px-4 py-2 shadow-sm fw-bold" 
                                        style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #15803d; border: 2px solid #6ee7b7;">
                                    <i class="fas fa-save me-2"></i>Simpan Data
                                </button>
                                <a href="index.php?c=Kendaraan" class="btn rounded-3 px-4 py-2 fw-bold shadow-sm"
                                   style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb); color: #4b5563; border: 2px solid #d1d5db;">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="alert alert-info border-0 shadow-sm rounded-4 p-4 mt-3">
                    <h6 class="fw-bold"><i class="fas fa-magic me-2"></i>Sistem Pintar</h6>
                    <p class="small mb-0 text-muted">
                        Pilih jenis kendaraan, dan sistem akan mengarahkan lokasi parkir secara otomatis berdasarkan ketersediaan di area yang tepat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function pilihAreaOtomatis() {
    const jenis = document.getElementById('jenis_kendaraan').value;
    const areaSelect = document.getElementById('id_area');
    const options = areaSelect.options;

    // Reset ke pilihan pertama jika jenis kosong
    if (jenis === "") {
        areaSelect.selectedIndex = 0;
        return;
    }

    for (let i = 0; i < options.length; i++) {
        const namaArea = options[i].getAttribute('data-nama');
        
        if (!namaArea) continue;

        // Logika pencocokan berdasarkan kata kunci di nama area
        if (jenis === "Truk" && namaArea.includes("basement")) {
            areaSelect.selectedIndex = i;
            break;
        } else if (jenis === "Mobil" && (namaArea.includes("lantai 1") || namaArea.includes("lt 1"))) {
            areaSelect.selectedIndex = i;
            break;
        } else if (jenis === "Motor" && (namaArea.includes("lantai 2") || namaArea.includes("lt 2"))) {
            areaSelect.selectedIndex = i;
            break;
        } else if (jenis === "Elf" && namaArea.includes("elf")) {
            areaSelect.selectedIndex = i;
            break;
        }
    }
}
</script>

<?php include "views/layout/footer.php"; ?>
<script src="assets/js/parkir_otomatis.js"></script>