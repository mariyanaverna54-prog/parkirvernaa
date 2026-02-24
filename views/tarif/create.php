<?php include "views/layout/header.php"; ?>

<style>
    body { background-color: #fff9f5 !important; color: #1f2937 !important; }
    #content, .container-fluid { background-color: #fff9f5 !important; }
    #sidebar { background: #ffffff !important; box-shadow: 4px 0 10px rgba(0,0,0,0.05) !important; }
    #sidebar .sidebar-header h4 { color: #1f2937 !important; }
    #sidebar .sidebar-header i { color: #f97316 !important; }
    #sidebar .nav-link { color: #6b7280 !important; }
    #sidebar .nav-link:hover { color: #1f2937 !important; background: rgba(249, 115, 22, 0.1) !important; }
    #sidebar .nav-link.active { background: linear-gradient(135deg, #fb923c, #f97316) !important; color: #fff !important; }
    #sidebar hr { border-color: #e5e7eb !important; }
    #sidebar small { color: #9ca3af !important; }
    .card { background: white !important; }
</style>

<div class="container-fluid py-4">
    <div class="mb-4">
        <h3 class="fw-bold m-0"><i class="fas fa-plus-circle me-2"></i>Tambah Tarif Parkir</h3>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form method="POST" action="index.php?c=Tarif&m=store">
                <div class="mb-3">
                    <label class="form-label fw-bold">Jenis Kendaraan</label>
                    <input type="text" name="jenis_kendaraan" class="form-control" placeholder="Contoh: Motor, Mobil, Truk/Bus" required>
                    <small class="text-muted">Masukkan jenis kendaraan sesuai kebutuhan</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Tarif Per Jam (Rp)</label>
                    <input type="number" name="tarif_per_jam" class="form-control" placeholder="Contoh: 3000" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <a href="index.php?c=Tarif&m=index" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "views/layout/footer.php"; ?>
