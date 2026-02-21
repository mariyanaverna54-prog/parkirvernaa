<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid py-4">
    <div class="mb-4">
        <h3 class="fw-bold m-0"><i class="fas fa-edit me-2"></i>Edit Area Parkir</h3>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form method="POST" action="index.php?c=Area&m=update">
                <input type="hidden" name="id_area" value="<?= $data['id_area'] ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Area</label>
                    <input type="text" name="nama_area" class="form-control" value="<?= $data['nama_area'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Kapasitas</label>
                    <input type="number" name="kapasitas" class="form-control" value="<?= $data['kapasitas'] ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update
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
