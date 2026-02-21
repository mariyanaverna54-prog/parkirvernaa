<?php include "views/layout/header.php"; 

// --- LOGIKA PENGAMAN ---
if (!isset($total_bayar) || $total_bayar == 0) {
    if (isset($kendaraan['waktu_masuk'])) {
        $awal   = new DateTime($kendaraan['waktu_masuk']);
        $akhir = new DateTime(); 
        $diff   = $awal->diff($akhir);
        $jam    = $diff->h + ($diff->days * 24);
        if ($diff->i > 0) $jam++; 
        $total_bayar = ($jam <= 0 ? 1 : $jam) * 3000; 
    } else {
        $total_bayar = 3000; 
    }
}
?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container py-4" style="background-color: #f8f9fa; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                
                <div class="card-header bg-dark py-3 text-center">
                    <h6 class="text-white fw-bold mb-0 text-uppercase">
                        <i class="fas fa-receipt me-2"></i>Konfirmasi Pembayaran
                    </h6>
                </div>

                <div class="card-body p-4">
                    <div class="text-center mb-4 p-3 bg-white border border-2 rounded-3" style="border-style: dashed !important;">
                        <span class="text-muted small d-block fw-bold text-uppercase">Plat Nomor</span>
                        <h2 class="fw-bold text-uppercase mb-0" style="letter-spacing: 3px; color: var(--text-main);">
                            <?= strtoupper($kendaraan['plat_nomor'] ?? 'N/A') ?>
                        </h2>
                    </div>

                    <div class="row g-3 mb-4 text-uppercase">
                        <div class="col-6">
                            <label class="text-muted small d-block fw-bold" style="font-size: 0.65rem;">Jenis Kendaraan</label>
                            <span class="fw-bold text-dark small"><?= $kendaraan['jenis_kendaraan'] ?? '-' ?></span>
                        </div>
                        <div class="col-6 text-end">
                            <label class="text-muted small d-block fw-bold" style="font-size: 0.65rem;">Warna</label>
                            <span class="fw-bold text-dark small"><?= $kendaraan['warna'] ?? '-' ?></span>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small d-block fw-bold" style="font-size: 0.65rem;">Waktu Masuk</label>
                            <span class="fw-bold" style="font-size: 0.75rem;"><?= isset($kendaraan['waktu_masuk']) ? date('d/m/Y H:i', strtotime($kendaraan['waktu_masuk'])) : '-' ?></span>
                        </div>
                        <div class="col-6 text-end">
                            <label class="text-muted small d-block fw-bold" style="font-size: 0.65rem;">Area Parkir</label>
                            <span class="fw-bold text-primary small"><?= $kendaraan['nama_area'] ?? '-' ?></span>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="p-3 rounded-3 mb-4 border-start border-danger border-4" style="background-color: #fff5f5;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold mb-0 text-uppercase small">Total Tagihan</span>
                            <h4 class="text-danger fw-bold mb-0">Rp <?= number_format($total_bayar, 0, ',', '.') ?></h4>
                        </div>
                    </div>

                    <form action="index.php?c=Transaksi&m=prosesKeluar" method="POST">
                        <input type="hidden" name="id_transaksi" value="<?= $kendaraan['id_transaksi'] ?? $kendaraan['id_parkir'] ?? $kendaraan['id'] ?? '' ?>">
                        <input type="hidden" name="total_bayar" value="<?= $total_bayar ?>">

                        <label class="form-label small fw-bold text-muted text-uppercase mb-2 text-center d-block">Metode Pembayaran</label>
                        
                        <div class="row g-2 mb-4">
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="metode" id="m_cash" value="CASH" checked onclick="pilihPembayaran('cash')">
                                <label class="btn btn-outline-dark w-100 py-2 fw-bold" for="m_cash" style="font-size: 0.7rem;">
                                    <i class="fas fa-money-bill-wave d-block mb-1"></i>CASH
                                </label>
                            </div>
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="metode" id="m_qris" value="QRIS" onclick="pilihPembayaran('qris')">
                                <label class="btn btn-outline-dark w-100 py-2 fw-bold" for="m_qris" style="font-size: 0.7rem;">
                                    <i class="fas fa-qrcode d-block mb-1"></i>QRIS
                                </label>
                            </div>
                            <div class="col-4">
                                <input type="radio" class="btn-check" name="metode" id="m_debit" value="DEBIT" onclick="pilihPembayaran('debit')">
                                <label class="btn btn-outline-dark w-100 py-2 fw-bold" for="m_debit" style="font-size: 0.7rem;">
                                    <i class="fas fa-credit-card d-block mb-1"></i>DEBIT
                                </label>
                            </div>
                        </div>

                        <div id="panel-bayar" class="mb-4 d-none">
                            <div class="card card-body border-primary bg-light text-center shadow-sm p-2">
                                <div id="info-qris" class="d-none">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=PARKIR-<?= ($kendaraan['plat_nomor'] ?? 'UNKNWN') ?>-<?= $total_bayar ?>" 
                                         alt="QR Code" class="img-fluid mx-auto rounded shadow-sm border border-white border-4 mb-2">
                                    <p class="text-muted x-small italic text-uppercase mb-0">Scan untuk membayar</p>
                                </div>

                                <div id="info-debit" class="d-none py-2">
                                    <i class="fas fa-rss fa-2x text-primary animate-pulse"></i>
                                    <p class="small fw-bold text-uppercase mt-2 mb-0">Tap Kartu Disini</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-orange fw-bold rounded-3 py-2 shadow border-0">
                                SELESAI & CETAK <i class="fas fa-print ms-2"></i>
                            </button>
                            <a href="index.php?c=Transaksi" class="btn btn-link text-muted text-decoration-none fw-bold text-uppercase" style="font-size: 0.7rem;">Batal</a>
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
    .x-small { font-size: 0.6rem; letter-spacing: 1px; }
    
    /* Warna kustom jika dashboard.css tidak memiliki .btn-orange */
    .btn-orange {
        background-color: #f26522;
        color: white;
    }
    .btn-orange:hover {
        background-color: #d4561c;
        color: white;
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