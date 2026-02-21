<!DOCTYPE html>
<html>
<head>
    <title>Struk Parkir</title>
    <style>
        @media print {
            .no-print { display: none; }
        }
        
        body {
            font-family: 'Courier New', monospace;
            width: 80mm;
            margin: 0 auto;
            padding: 10px;
        }
        
        .struk {
            border: 2px dashed #000;
            padding: 15px;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        
        .header h2 {
            margin: 5px 0;
            font-size: 20px;
        }
        
        .content {
            font-size: 14px;
        }
        
        .row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
        
        .footer {
            text-align: center;
            border-top: 2px dashed #000;
            padding-top: 10px;
            margin-top: 10px;
            font-size: 12px;
        }
        
        .total {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .no-print {
            text-align: center;
            margin-top: 20px;
        }
        
        .no-print button {
            transition: all 0.3s ease;
        }
        
        .no-print button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3) !important;
        }
        
        .no-print button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="struk">
        <div class="header">
            <h2>SISTEM PARKIR</h2>
            <p style="margin: 0;">Jl. Contoh No. 123</p>
            <p style="margin: 0;">Telp: (021) 12345678</p>
        </div>
        
        <div class="content">
            <div class="row">
                <span>No. Transaksi</span>
                <span><strong><?= $data['id_parkir'] ?></strong></span>
            </div>
            
            <div class="row">
                <span>Plat Nomor</span>
                <span><strong><?= strtoupper($data['plat_nomor']) ?></strong></span>
            </div>
            
            <div class="row">
                <span>Jenis</span>
                <span><?= ucfirst($data['jenis_kendaraan']) ?></span>
            </div>
            
            <div class="row">
                <span>Warna</span>
                <span><?= ucfirst($data['warna']) ?></span>
            </div>
            
            <div class="row">
                <span>Area</span>
                <span><?= $data['nama_area'] ?></span>
            </div>
            
            <hr style="border: 1px dashed #000;">
            
            <div class="row">
                <span>Waktu Masuk</span>
                <span><?= date('d/m/Y H:i', strtotime($data['waktu_masuk'])) ?></span>
            </div>
            
            <?php if($data['status'] == 'keluar'): ?>
            <div class="row">
                <span>Waktu Keluar</span>
                <span><?= date('d/m/Y H:i', strtotime($data['waktu_keluar'])) ?></span>
            </div>
            
            <div class="row">
                <span>Durasi</span>
                <span>
                    <?php 
                        $awal = new DateTime($data['waktu_masuk']);
                        $akhir = new DateTime($data['waktu_keluar']);
                        $diff = $awal->diff($akhir);
                        echo ($diff->days * 24) + $diff->h . " jam " . $diff->i . " menit";
                    ?>
                </span>
            </div>
            
            <hr style="border: 1px dashed #000;">
            
            <div class="row total">
                <span>TOTAL BAYAR</span>
                <span>Rp <?= number_format($data['biaya_total'], 0, ',', '.') ?></span>
            </div>
            
            <div class="row">
                <span>Metode</span>
                <span><?= $data['metode_bayar'] ?></span>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="footer">
            <p style="margin: 5px 0;">Terima Kasih</p>
            <p style="margin: 5px 0;">Hati-hati di Jalan</p>
            <p style="margin: 5px 0; font-size: 10px;">Dicetak: <?= date('d/m/Y H:i:s') ?></p>
        </div>
    </div>
    
    <div class="no-print">
        <button onclick="window.print()" class="btn btn-primary" style="background: linear-gradient(135deg, #fb923c, #f97316); border: none; padding: 12px 30px; border-radius: 10px; color: white; font-weight: bold; box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3); cursor: pointer; margin-right: 10px;">
            <i class="fas fa-print"></i> Cetak Struk
        </button>
        <button onclick="window.close()" class="btn btn-secondary" style="background: #6b7280; border: none; padding: 12px 30px; border-radius: 10px; color: white; font-weight: bold; box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3); cursor: pointer;">
            <i class="fas fa-times"></i> Tutup
        </button>
    </div>
    
    <script>
        // Auto print saat halaman dibuka
        window.onload = function() {
            // Uncomment baris di bawah jika ingin auto print
            // window.print();
        }
    </script>
</body>
</html>
