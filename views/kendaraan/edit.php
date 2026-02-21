<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid py-4">
    <div class="mb-4">
        <h3 class="fw-bold m-0"><i class="fas fa-edit me-2"></i>Edit Kendaraan</h3>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form method="POST" action="index.php?c=Kendaraan&m=update">
                <input type="hidden" name="id_kendaraan" value="<?= $data['id_kendaraan'] ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold">Plat Nomor</label>
                    <input type="text" name="plat_nomor" class="form-control" value="<?= $data['plat_nomor'] ?>" 
                           style="text-transform: uppercase;" 
                           oninput="this.value = this.value.toUpperCase()" 
                           placeholder="Contoh: B 1234 ABC" required>
                    <small class="text-muted">Otomatis huruf besar</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" class="form-control" required>
                        <option value="motor" <?= $data['jenis_kendaraan'] == 'motor' ? 'selected' : '' ?>>Motor</option>
                        <option value="mobil" <?= $data['jenis_kendaraan'] == 'mobil' ? 'selected' : '' ?>>Mobil</option>
                        <option value="truk" <?= $data['jenis_kendaraan'] == 'truk' ? 'selected' : '' ?>>Truk</option>
                        <option value="bus" <?= $data['jenis_kendaraan'] == 'bus' ? 'selected' : '' ?>>Bus</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Warna</label>
                    <input type="text" name="warna" class="form-control" value="<?= $data['warna'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Pemilik</label>
                    <input type="text" name="pemilik" class="form-control" value="<?= $data['pemilik'] ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn px-4" 
                            style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1d4ed8; border: 2px solid #93c5fd; font-weight: 600; border-radius: 10px;">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                    <a href="index.php?c=Kendaraan&m=index" class="btn px-4"
                       style="background: linear-gradient(135deg, #f3f4f6, #e5e7eb); color: #4b5563; border: 2px solid #d1d5db; font-weight: 600; border-radius: 10px;">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "views/layout/footer.php"; ?>
