<!-- Navbar -->
<link rel="stylesheet" href="color.css">
<nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-4 aulia">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Pengaturan Pengguna</span>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-key mr-2"></i> Ubah Password
                </a>
                <a href="#" id="logoutButton" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Tambahkan SweetAlert JavaScript -->
<script src="../../js/sweetalert2.all.min.js"></script>
<!-- /.navbar -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tentukan elemen tautan logout
    var logoutButton = document.getElementById('logoutButton');

    // Tambahkan event listener untuk tautan logout
    logoutButton.addEventListener('click', function (event) {
        // Hentikan perilaku default agar tautan tidak diikuti
        event.preventDefault();

        // Tampilkan SweetAlert untuk konfirmasi logout
        Swal.fire({
            title: 'Logout',
            text: 'Apakah Anda yakin ingin logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout!'
        }).then((result) => {
            // Jika pengguna mengklik "Ya, Logout!"
            if (result.isConfirmed) {
                // Redirect ke halaman logout atau lakukan tindakan logout yang sesuai
                window.location.href = 'logout.php';
                session_destroy();
            }
        });
    });
});
</script>