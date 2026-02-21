<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid py-4">
    <div class="mb-4">
        <h3 class="fw-bold m-0"><i class="fas fa-plus-circle me-2"></i>Tambah Area Parkir</h3>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form method="POST" action="index.php?c=Area&m=store">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Area</label>
                    <input type="text" name="nama_area" class="form-control" placeholder="Contoh: Lantai 1 (Mobil)" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Kapasitas</label>
                    <input type="number" name="kapasitas" class="form-control" placeholder="Contoh: 50" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <a href="index.php?c=Area&m=index" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "views/layout/footer.php"; ?>
