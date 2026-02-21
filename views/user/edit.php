<?php include "views/layout/header.php"; ?>

<link rel="stylesheet" href="assets/css/halaman.css">

<div class="container-fluid py-4">
    <div class="mb-4">
        <h3 class="fw-bold m-0"><i class="fas fa-user-edit me-2"></i>Edit User</h3>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form method="POST" action="index.php?c=User&m=update">
                <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Password Baru</label>
                    <div class="position-relative">
                        <input type="password" name="password" id="passwordField" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password" style="padding-right: 45px;">
                        <i class="fas fa-eye position-absolute" id="togglePassword" style="right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #1e293b; font-size: 16px;"></i>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $data['nama_lengkap'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="petugas" <?= $data['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
                        <option value="owner" <?= $data['role'] == 'owner' ? 'selected' : '' ?>>Owner</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                    <a href="index.php?c=User&m=index" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('passwordField');

if (togglePassword && passwordField) {
    togglePassword.addEventListener('click', function() {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        
        // Toggle icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
}
</script>

<?php include "views/layout/footer.php"; ?>
