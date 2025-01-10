<?php
    session_start();

    // Include koneksi ke database
    include "../database.php";

    if (isset($_SESSION["loggedin"])) {
        header("Location: index.php");
        exit();
    }

    // Cek apakah form login sudah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data yang diinputkan oleh pengguna
        $email = $_POST['Email'];
        $password = $_POST['Password'];

        // Query untuk memeriksa keberadaan admin dengan email yang cocok
        $sql = "SELECT * FROM admin WHERE Email = '$email'";

        // Eksekusi query
        $result = $db->query($sql);

        if ($result && $result->num_rows > 0) {
            // Admin ditemukan, ambil data hash kata sandi dari database
            $row = $result->fetch_assoc();
            $password_hash = $row['Password'];
            $nama_admin = $row['Nama'];

            // Verifikasi kata sandi
            if (password_verify($password, $password_hash)) {
                // Kata sandi cocok, set session dan redirect ke halaman utama
                $_SESSION['loggedin'] = true;
                $_SESSION['Email'] = $email;
                $_SESSION['Nama'] = $nama_admin;
                header("Location: index.php"); // Ganti index.php dengan halaman utama Anda
                exit();
            } else {
                // Kata sandi salah
                $error_message = "Email atau password salah.";
            }
        } else {
            // Admin tidak ditemukan, tampilkan pesan kesalahan
            $error_message = "Email atau password salah.";
        }

    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="login.php">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="Email" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="Password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">Forgot Password?</a>
                                                <button class="btn btn-primary" href="index.php">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Lifedia 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
