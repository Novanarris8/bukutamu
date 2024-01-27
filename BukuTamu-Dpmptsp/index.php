<?php
session_start();
date_default_timezone_set('Asia/Singapore');

if (isset($_SESSION['login'])) {
  header('Location: admin/index.php');
  exit;
}

require 'koneksi.php';

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $login_terakhir = date("Y-m-d H:i:s");

  $result = mysqli_query($conn, "SELECT * FROM tbl_pengguna WHERE username = '$username'");

  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    if ($row["peran"] == "USER" && $row["konfirmasi"] == 0) {
      // Akun belum diapprove oleh admin, berikan pesan alert
      echo "<meta http-equiv='refresh' content='0 url=?page=user-add'>";
      echo '<script>alert("Akun Anda belum diapprove oleh admin. Harap tunggu konfirmasi.");</script>';
    } else {
      // Lanjutkan proses login jika akun sudah diapprove
      if (password_verify($password, $row["password"])) {
        $_SESSION["login"] = true;
        $_SESSION["peran"] = $row["nama"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["kode_pengguna"] = $row["kode_pengguna"];
        // $_SESSION["id_admin"] = $row["id_admin"];
        $_SESSION["id"] = $row["id"];

        // Update data ke database
        $update = mysqli_query($conn, "UPDATE tbl_pengguna SET login_terakhir = '$login_terakhir' WHERE username = '$username'");

        // Redirect sesuai peran
        if ($row["peran"] == "ADMIN") {
          header("Location: admin/index.php");
        } else if ($row["peran"] == "USER") {
          header("Location: user/index.php");
        }

        exit;
      }
    }
  } else {
    echo '<script>alert("Username Atau Password Salah");</script>';
  }
}

?>
<?php
$kueri = mysqli_query($conn, "SELECT max(id) as kodeTerbesar FROM tbl_pengguna");
$hasil_kueri = mysqli_fetch_array($kueri);
$untukKT = $hasil_kueri['kodeTerbesar'];
$untukKT++;
$huruf = "KT-";
$kode_tamu_up = $huruf . sprintf("%03s", $untukKT);

if (isset($_POST['registrasi'])) {

  $nama_user = "";
  $jk = "";
  $email = "";
  $alamat = "";
  $no_telp = "";
  $foto = "";


  $username = $_POST['username'];
  $pass = $_POST['password'];
  $pass2 = $_POST['password2'];
  $peran = $_POST['peran'];
  $kode_pengguna = $_POST['kode_pengguna'];


  if ($pass !== $pass2) {
    echo '<script>alert("Password konfirmasi salah!");</script>';
    echo "<meta http-equiv='refresh' content='0 url=?page=user-add'>";
    return false;
  }

  $cekUsername = mysqli_query($conn, "SELECT * FROM tbl_pengguna WHERE username = '" . $username . "' ");
  if (mysqli_num_rows($cekUsername) >= 1) {
    echo '<script>alert("username sudah digunakan");</script>';
    echo "<meta http-equiv='refresh' content='0 url=?page=user-add'>";
    return false;
  }

  // merubah karakter password enkripsi hash
  $passHash = password_hash($pass, PASSWORD_DEFAULT);

  // simpan user baru
  $exec = mysqli_query($conn, "INSERT INTO tbl_pengguna (username,password,peran,kode_pengguna) VALUES('$username','$passHash','$peran','$kode_pengguna')");

  $exec2 = mysqli_query($conn, "INSERT INTO tbl_user (id_user,kode_user,nama_user,jk,email,alamat,no_telp,foto) VALUES('', '$kode_pengguna', '$nama_user', '$jk', '$email', '$alamat', '$no_telp', '$foto')");

  if ($exec === true & $exec2 === true) {
    echo '<script>alert("Data Pendaftaran Berhasil ditambahkan! Untuk Sementara akun kamu masih belum diverifikasi admin. Tunggu 1*24 jam");</script>';
  } else {
    '<script>alert("User gagal di tambahkan");</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Membuat Form Login</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!--  icheck bootstrap   -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!--  Theme style   -->
  <!-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> -->
</head>

<body>
  <div class="wrapper">
    <div class="title-text">
      <!--  -->
      <div class="title login">
        <img src="../logo.png" width="50px" height="70px" alt="" />
        <br />
        Form Login
      </div>
      <div class="title signup">
        <img src="../logo.png" width="50px" height="70px" alt="" />
        <br />Form Registrasi
      </div>
    </div>
    <div class="form-container">
      <div class="slide-controls">
        <input type="radio" name="slide" id="login" checked />
        <input type="radio" name="slide" id="signup" />
        <label for="login" class="slide login">Login</label>
        <label for="signup" class="slide signup">Daftar</label>
        <div class="slider-tab"></div>
      </div>
      <div class="form-inner">
        <form action="" method="post" class="login">
          <pre></pre>
          <div class="field">
            <input type="text" name="username" placeholder="Masukan Username " required autocomplete="off" />
          </div>
          <div class="field" id="show_hide_password">
            <input type="password" name="password" placeholder="Masukan Password" required autocomplete="off" />
          </div>
          <!-- <div class="pass-link"><a href="#">Lupa password?</a></div> -->
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" name="login" value="login" />
          </div>
          <div class="kembali" style="text-align: center; margin-top:5px">
            <a href="../index.html ">Kembali ke Home</a>
          </div>
          <div class="signup-link">

            Buat akun <a href="">Daftar sekarang</a>
          </div>
          <!-- <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="login" value="Kembali" />
            </div> -->
        </form>
        <!-- <?php if (isset($error)) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i>Alert!</h5>
                    Username tidak dapat digunakan...!
                </div>
                <?php } ?> -->
        <form action="#" method="POST" class="signup">
          <div class="field">
            <input type="text" name="username" placeholder="Masukan Nama" required autocomplete="off" />
          </div>
          <div class="field">
            <input type="password" name="password" placeholder="Masukan Password" required autocomplete="off" />
          </div>
          <div class="field">
            <input type="hidden" class="form-control" name="kode_pengguna" value="<?= $kode_tamu_up ?>" readonly>
            <input type="password" name="password2" placeholder="Ulangi password" required />
            <input type="hidden" class="form-control" name="peran" value="USER" readonly autocomplete="off">

          </div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" name="registrasi" value="Daftar" />
          </div>
          <div class="signup-link">
            Sudah punya akun? <a href="">Login</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../script.js"></script>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>