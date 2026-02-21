<!DOCTYPE html>
<html>
<head>
  <title>Laporan Parkir</title>
  <style>
    body { font-family: Arial; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th,td { border:1px solid #000; padding:6px; text-align:center; }
  </style>
</head>
<body onload="window.print()">

<h3>Laporan Parkir</h3>
<p>Periode: <?= $tgl_awal ?> s/d <?= $tgl_akhir ?></p>

<table>
  <tr>
    <th>No</th>
    <th>Plat Nomor</th>
    <th>Masuk</th>
    <th>Keluar</th>
    <th>Durasi (Jam)</th>
    <th>Total</th>
    <th>Metode</th>
  </tr>

  <?php $no=1; foreach($data as $d): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $d['plat_nomor'] ?></td>
    <td><?= $d['waktu_masuk'] ?></td>
    <td><?= $d['waktu_keluar'] ?? '-' ?></td>
    <td>
      <?php 
        if (!empty($d['waktu_keluar'])) {
            $awal  = new DateTime($d['waktu_masuk']);
            $akhir = new DateTime($d['waktu_keluar']);
            $diff  = $awal->diff($akhir);
            
            // Menampilkan Jam dan Menit
            echo ($diff->days * 24) + $diff->h . "j " . $diff->i . "m";
        } else {
            echo "-";
        }
      ?>
    </td>
    <td>Rp <?= number_format($d['biaya_total'] ?? 0) ?></td>
    <td><?= $d['metode_bayar'] ?? '-' ?></td>
  </tr>
  <?php endforeach; ?>
</table>

</body>
</html>
