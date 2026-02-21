<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid py-4">
    <div class="page-header-section d-flex justify-content-between align-items-center">
        <div>
            <h3 class="page-title"><i class="fas fa-users me-2"></i>User</h3>
        </div>
        <a href="index.php?c=User&m=create" class="btn shadow-sm px-4"
           style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #15803d; border: 2px solid #6ee7b7; font-weight: 600; border-radius: 10px;">
            <i class="fas fa-plus me-2"></i> Tambah User
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="py-3 ps-4">No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php $no=1; foreach($data as $d): ?>
                            <tr>
                                <td class="ps-4"><?= $no++ ?></td>
                                <td><span class="badge text-uppercase" style="background: #1f2937; color: white; padding: 8px 20px; border-radius: 8px; font-weight: 600; font-size: 0.85rem;"><?= $d['username'] ?></span></td>
                                <td><?= $d['nama_lengkap'] ?? $d['nama'] ?? $d['nama_user'] ?? '-' ?></td>
                                <td>
                                    <span class="badge text-uppercase" style="background: #1f2937; color: white; padding: 8px 20px; border-radius: 8px; font-weight: 600; font-size: 0.85rem;"><?= $d['role'] ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="index.php?c=User&m=edit&id=<?= $d['id_user'] ?>" class="btn btn-sm me-1"
                                       style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #b45309; border: 2px solid #fcd34d; font-weight: 600; border-radius: 8px; padding: 6px 12px;">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="index.php?c=User&m=delete&id=<?= $d['id_user'] ?>" 
                                       onclick="return confirm('Yakin hapus user ini?')" 
                                       class="btn btn-sm"
                                       style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #dc2626; border: 2px solid #fca5a5; font-weight: 600; border-radius: 8px; padding: 6px 12px;">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-database fa-3x mb-3 d-block opacity-25"></i>
                                    Belum ada data user.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "views/layout/footer.php"; ?>
