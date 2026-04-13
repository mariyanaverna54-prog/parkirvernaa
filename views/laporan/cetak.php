<!DOCTYPE html>
<html>
<head>
  <title>Laporan Parkir</title>
  <style>
    body { font-family: Arial; font-size: 13px; }
    h3, h4 { margin: 5px 0; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th, td { border:1px solid #000; padding:6px; text-align:center; }
    th { background: #f97316; color: white; }
    .section-title { margin-top: 20px; font-weight: bold; font-size: 14px; border-bottom: 2px solid #f97316; padding-bottom: 4px; }
    .total-row { font-weight: bold; background: #fff7ed; }
    .summary-box { display: inline-block; border: 1px solid #f97316; padding: 8px 16px; margin: 5px; border-radius: 6px; }
  </style>
</head>
<body onload="window.print()">

<h3>Laporan Parkir</h3>
<p>Periode: <?= date('d/m/Y', strtotime($tgl_awal)) ?> s/d <?= date('d/m/Y', strtotime($tgl_akhir)) ?></p>

<?php
// Hitung total keseluruhan
$total_pendapatan = array_sum(array_column($data, 'biaya_total'));
$total_kendaraan = count($data);

// Kelompokkan per hari
$per_hari = [];
foreach($data as $d) {
    $tgl = date('Y-m-d', strtotime($d['waktu_keluar']));
    if(!isset($per_hari[$tgl])) {
        $per_hari[$tgl] = ['total' => 0, 'jumlah' => 0];
    }
    $per_hari[$tgl]['total'] += $d['biaya_total'];
    $per_hari[$tgl]['jumlah']++;
}

// Kelompokkan per bulan
$per_bulan = [];
foreach($data as $d) {
    $bulan = date('Y-m', strtotime($d['waktu_keluar']));
    if(!isset($per_bulan[$bulan])) {
        $per_bulan[$bulan] = ['total' => 0, 'jumlah' => 0];
    }
    $per_bulan[$bulan]['total'] += $d['biaya_total'];
    $per_bulan[$bulan]['jumlah']++;
}
?>

<!-- Ringkasan -->
<div style="margin: 10px 0;">
    <div class="summary-box">Total Kendaraan: <strong><?= $total_kendaraan ?></strong></div>
    <div class="summary-box">Total Pendapatan: <strong>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></strong></div>
</div>

<!-- Pendapatan Bulanan -->
<?php if(count($per_bulan) > 0): ?>
<div class="section-title">Pendapatan Bulanan</div>
<table>
  <tr>
    <th>Bulan</th>
    <th>Jumlah Kendaraan</th>
    <th>Total Pendapatan</th>
  </tr>
  <?php foreach($per_bulan as $bulan => $info): ?>
  <tr>
    <td><?= date('F Y', strtotime($bulan . '-01')) ?></td>
    <td><?= $info['jumlah'] ?> kendaraan</td>
    <td>Rp <?= number_format($info['total'], 0, ',', '.') ?></td>
  </tr>
  <?php endforeach; ?>
  <tr class="total-row">
    <td colspan="2">TOTAL</td>
    <td>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td>
  </tr>
</table>
<?php endif; ?>

<!-- Pendapatan Harian -->
<div class="section-title">Pendapatan Harian</div>
<table>
  <tr>
    <th>Tanggal</th>
    <th>Jumlah Kendaraan</th>
    <th>Total Pendapatan</th>
  </tr>
  <?php foreach($per_hari as $tgl => $info): ?>
  <tr>
    <td><?= date('d/m/Y', strtotime($tgl)) ?></td>
    <td><?= $info['jumlah'] ?> kendaraan</td>
    <td>Rp <?= number_format($info['total'], 0, ',', '.') ?></td>
  </tr>
  <?php endforeach; ?>
  <tr class="total-row">
    <td colspan="2">TOTAL</td>
    <td>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td>
  </tr>
</table>

<!-- Detail Transaksi -->
<div class="section-title">Detail Transaksi</div>
<table>
  <tr>
    <th>No</th>
    <th>Plat Nomor</th>
    <th>Jenis</th>
    <th>Masuk</th>
    <th>Keluar</th>
    <th>Durasi</th>
    <th>Total</th>
    <th>Metode</th>
  </tr>
  <?php $no=1; foreach($data as $d): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $d['plat_nomor'] ?></td>
    <td><?= $d['jenis_kendaraan'] ?? '-' ?></td>
    <td><?= date('d/m/Y H:i', strtotime($d['waktu_masuk'])) ?></td>
    <td><?= $d['waktu_keluar'] ? date('d/m/Y H:i', strtotime($d['waktu_keluar'])) : '-' ?></td>
    <td>
      <?php 
        if (!empty($d['waktu_keluar'])) {
            $awal  = new DateTime($d['waktu_masuk']);
            $akhir = new DateTime($d['waktu_keluar']);
            $diff  = $awal->diff($akhir);
            echo ($diff->days * 24) + $diff->h . "j " . $diff->i . "m";
        } else {
            echo "-";
        }
      ?>
    </td>
    <td>Rp <?= number_format($d['biaya_total'] ?? 0, 0, ',', '.') ?></td>
    <td><?= $d['metode_bayar'] ?? '-' ?></td>
  </tr>
  <?php endforeach; ?>
  <tr class="total-row">
    <td colspan="6">TOTAL</td>
    <td>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td>
    <td></td>
  </tr>
</table>

</body>
</html>
