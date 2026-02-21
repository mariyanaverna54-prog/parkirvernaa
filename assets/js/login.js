document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#passwordField');

    // Cek dulu apakah elemennya ada, biar tidak error di console
    if (togglePassword && password) {
        togglePassword.addEventListener('click', function () {
            // 1. Toggle tipe input
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // 2. Toggle ikon mata (tambah/hapus class fa-eye-slash)
            this.classList.toggle('fa-eye-slash');
            
            // Opsi tambahan: pastikan fa-eye juga ikut berganti jika perlu
            // this.classList.toggle('fa-eye'); 
        });
    }
});