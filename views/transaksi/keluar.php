<?php include "views/layout/header.php"; 

// --- LOGIKA PENGAMAN - AMBIL TARIF DARI DATABASE ---
if (!isset($total_bayar) || $total_bayar == 0) {
    if (isset($kendaraan['waktu_masuk']) && isset($kendaraan['jenis_kendaraan'])) {
        // Ambil tarif dari database berdasarkan jenis kendaraan
        $db = Database::connect();
        $jenis = trim($kendaraan['jenis_kendaraan']);
        
        // Coba cari exact match dulu (case-insensitive, trim whitespace)
        $stmt = $db->prepare("SELECT tarif_per_jam FROM tb_tarif WHERE TRIM(LOWER(jenis_kendaraan)) = TRIM(LOWER(?))");
        $stmt->execute([$jenis]);
        $tarif_data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Jika tidak ada, coba cari dengan LIKE untuk variasi nama
        if (!$tarif_data) {
            $jenis_lower = strtolower($jenis);
            
            // Coba cari berdasarkan kata kunci
            if (strpos($jenis_lower, 'truk') !== false || strpos($jenis_lower, 'bus') !== false || strpos($jenis_lower, 'elf') !== false) {
                // Cari tarif untuk truk/bus/elf
                $stmt = $db->query("SELECT tarif_per_jam FROM tb_tarif WHERE LOWER(jenis_kendaraan) LIKE '%truk%' OR LOWER(jenis_kendaraan) LIKE '%bus%' OR LOWER(jenis_kendaraan) LIKE '%elf%' ORDER BY tarif_per_jam DESC LIMIT 1");
                $tarif_data = $stmt->fetch(PDO::FETCH_ASSOC);
            } elseif (strpos($jenis_lower, 'mobil') !== false) {
                // Cari tarif untuk mobil
                $stmt = $db->query("SELECT tarif_per_jam FROM tb_tarif WHERE LOWER(jenis_kendaraan) LIKE '%mobil%' LIMIT 1");
                $tarif_data = $stmt->fetch(PDO::FETCH_ASSOC);
            } elseif (strpos($jenis_lower, 'motor') !== false) {
                // Cari tarif untuk motor
                $stmt = $db->query("SELECT tarif_per_jam FROM tb_tarif WHERE LOWER(jenis_kendaraan) LIKE '%motor%' LIMIT 1");
                $tarif_data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        
        // Jika masih tidak ada, ambil tarif terendah
        if (!$tarif_data) {
            $stmt_min = $db->query("SELECT MIN(tarif_per_jam) as min_tarif FROM tb_tarif");
            $min_tarif = $stmt_min->fetch(PDO::FETCH_ASSOC);
            $tarif_per_jam = $min_tarif['min_tarif'] ?? 2000;
        } else {
            $tarif_per_jam = $tarif_data['tarif_per_jam'];
        }
        
        // Hitung durasi parkir
        $awal   = new DateTime($kendaraan['waktu_masuk']);
        $akhir = new DateTime(); 
        $diff   = $awal->diff($akhir);
        $jam    = $diff->h + ($diff->days * 24);
        if ($diff->i > 0) $jam++; // Pembulatan ke atas jika ada menit
        
        $total_bayar = ($jam <= 0 ? 1 : $jam) * $tarif_per_jam; 
    } else {
        // Ambil tarif terendah dari database sebagai default
        $db = Database::connect();
        $stmt = $db->query("SELECT MIN(tarif_per_jam) as min_tarif FROM tb_tarif");
        $min_tarif = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_bayar = $min_tarif['min_tarif'] ?? 2000;
    }
}
?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container py-4" style="background-color: #fff9f5; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                
                <div class="card-header py-3 text-center" style="background: linear-gradient(135deg, #f97316, #ea580c);">
                    <h6 class="text-white fw-bold mb-0">
                        <i class="fas fa-cash-register me-2"></i>Konfirmasi Pembayaran
                    </h6>
                </div>

                <div class="card-body p-4" style="background: #ffffff;">
                    
                    <div class="text-center mb-3 p-3 rounded-3" style="background: linear-gradient(135deg, #fff7ed, #ffedd5);">
                        <small class="d-block mb-1" style="font-size: 0.7rem; color: #9a3412;">Plat Nomor</small>
                        <h3 class="fw-bold text-uppercase mb-0" style="letter-spacing: 3px; color: #431407;">
                            <?= strtoupper($kendaraan['plat_nomor'] ?? 'N/A') ?>
                        </h3>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="p-2 rounded-3" style="background-color: #fff7ed; border: 1px solid #fed7aa;">
                                <small class="text-muted d-block" style="font-size: 0.65rem; color: #9a3412;">Jenis</small>
                                <span class="fw-bold" style="font-size: 0.85rem; color: #431407;"><?= $kendaraan['jenis_kendaraan'] ?? '-' ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 rounded-3" style="background-color: #fff7ed; border: 1px solid #fed7aa;">
                                <small class="text-muted d-block" style="font-size: 0.65rem; color: #9a3412;">Warna</small>
                                <span class="fw-bold" style="font-size: 0.85rem; color: #431407;"><?= $kendaraan['warna'] ?? '-' ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 rounded-3" style="background-color: #ffedd5; border: 1px solid #fed7aa;">
                                <small class="text-muted d-block" style="font-size: 0.65rem; color: #9a3412;">Waktu Masuk</small>
                                <span class="fw-bold" style="font-size: 0.75rem; color: #431407;"><?= isset($kendaraan['waktu_masuk']) ? date('d/m/Y H:i', strtotime($kendaraan['waktu_masuk'])) : '-' ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 rounded-3" style="background-color: #ffedd5; border: 1px solid #fed7aa;">
                                <small class="text-muted d-block" style="font-size: 0.65rem; color: #9a3412;">Area Parkir</small>
                                <span class="fw-bold" style="font-size: 0.75rem; color: #f97316;"><?= $kendaraan['nama_area'] ?? '-' ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded-3 mb-3 text-center" style="background: linear-gradient(135deg, #fee2e2, #fecaca); border: 2px solid #fca5a5;">
                        <small class="d-block mb-1" style="font-size: 0.7rem; color: #991b1b;">Total Tagihan</small>
                        <h3 class="fw-bold mb-0" style="color: #dc2626;">Rp <?= number_format($total_bayar, 0, ',', '.') ?></h3>
                    </div>

                    <form action="index.php?c=Transaksi&m=prosesKeluar" method="POST">
                        <input type="hidden" name="id_transaksi" value="<?= $kendaraan['id_transaksi'] ?? $kendaraan['id_parkir'] ?? $kendaraan['id'] ?? '' ?>">
                        <input type="hidden" name="total_bayar" value="<?= $total_bayar ?>">

                        <small class="d-block text-center fw-bold mb-2" style="font-size: 0.7rem; color: #9a3412;">Pilih Metode Pembayaran</small>
                        
                        <div class="row g-2 mb-3">
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="metode" id="m_cash" value="CASH" checked onclick="pilihPembayaran('cash')">
                                <label class="btn btn-outline-success w-100 py-2" for="m_cash" style="font-size: 0.7rem; border-color: #10b981; color: #10b981;">
                                    <i class="fas fa-money-bill-wave d-block mb-1"></i>
                                    <span class="fw-bold">CASH</span>
                                </label>
                            </div>
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="metode" id="m_qris" value="QRIS" onclick="pilihPembayaran('qris')">
                                <label class="btn w-100 py-2" for="m_qris" style="font-size: 0.7rem; border: 2px solid #f97316; color: #f97316; background: transparent;">
                                    <i class="fas fa-qrcode d-block mb-1"></i>
                                    <span class="fw-bold">QRIS</span>
                                </label>
                            </div>
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="metode" id="m_debit" value="DEBIT" onclick="pilihPembayaran('debit')">
                                <label class="btn btn-outline-warning w-100 py-2" for="m_debit" style="font-size: 0.7rem; border-color: #f59e0b; color: #f59e0b;">
                                    <i class="fas fa-credit-card d-block mb-1"></i>
                                    <span class="fw-bold">DEBIT</span>
                                </label>
                            </div>
                        </div>

                        <div id="panel-bayar" class="mb-3 d-none">
                            <div class="card card-body text-center p-3 border-0 shadow-sm" style="background: #fff7ed;">
                                <div id="info-qris" class="d-none">
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data=PARKIR-<?= ($kendaraan['plat_nomor'] ?? 'UNKNWN') ?>-<?= $total_bayar ?>" 
                                             alt="QR Code" class="rounded mb-2" style="width: 130px; height: 130px;">
                                        <small class="d-block text-center" style="font-size: 0.75rem; color: #6b7280; font-weight: 500;">Scan untuk membayar</small>
                                    </div>
                                </div>

                                <div id="info-debit" class="d-none py-2">
                                    <i class="fas fa-rss fa-2x animate-pulse mb-2" style="color: #f97316;"></i>
                                    <p class="mb-0" style="font-size: 0.85rem; color: #6b7280; font-weight: 500;">Tempelkan Kartu</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn fw-bold rounded-3 py-2 shadow-sm" 
                                    style="background: linear-gradient(135deg, #f97316, #ea580c); color: white; border: none;">
                                <i class="fas fa-check-circle me-2"></i>Selesai
                            </button>
                            <a href="index.php?c=Transaksi" class="btn btn-link text-decoration-none" style="font-size: 0.75rem; color: #9a3412;">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-pulse { animation: pulse 1.2s infinite ease-in-out; }
    @keyframes pulse {
        0% { transform: scale(0.9); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 1; }
        100% { transform: scale(0.9); opacity: 0.5; }
    }
    
    .btn-check:checked + label {
        background: linear-gradient(135deg, #f97316, #ea580c) !important;
        color: white !important;
        border-color: #f97316 !important;
    }
</style>

<script>
function pilihPembayaran(metode) {
    const panel = document.getElementById('panel-bayar');
    const qris = document.getElementById('info-qris');
    const debit = document.getElementById('info-debit');

    panel.classList.add('d-none');
    qris.classList.add('d-none');
    debit.classList.add('d-none');

    if (metode === 'qris') {
        panel.classList.remove('d-none');
        qris.classList.remove('d-none');
    } else if (metode === 'debit') {
        panel.classList.remove('d-none');
        debit.classList.remove('d-none');
    }
}
</script>

<?php include "views/layout/footer.php"; ?>