<?php
    session_start();

    include "../database.php";

    if (!isset($_SESSION["loggedin"])) {
        header("Location: login.php");
        exit;
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
        <title>Data Asuransi</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Admin Lifedia</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="exit.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Report</div>
                            <a class="nav-link collapsed" href="laporan.php" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Laporan
                            </a>
                            <a href="member.php" class="nav-link collapsed" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                                Member
                            </a>
                            <div class="sb-sidenav-menu-heading">Content</div>
                            <a class="nav-link collapsed" href="asuransi.php" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Asuransi
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Asuransi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">asuransi</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Detail
                            </div>
                            <div class="card-body">
                                <div class="containerasuransi">
                                    <?php
                                        include "../database.php";

                                        if(isset($_POST['submit'])){
                                            $merek = mysqli_real_escape_string($db,$_POST['merek']);
                                            $paket = mysqli_real_escape_string($db,$_POST['paket']);
                                            $polis = mysqli_real_escape_string($db,$_POST['besaran_polis']);
                                            $tanggungan = mysqli_real_escape_string($db,$_POST['besaran_tanggungan']);
                                            $logo = $_FILES ['logo'];

                                            function uploadFoto($file)
                                                {
                                                    $allowedExtensions = ['jpg', 'jpeg', 'png'];
                                                    $tmpFilePath = $file["tmp_name"];
                                                    $fileParts = pathinfo($file['name']);
                                                    $extension = strtolower($fileParts['extension']);

                                                    if (in_array($extension, $allowedExtensions)) {
                                                        $newFilePath = "logo/" . uniqid() . "." . $extension;
                                                        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                                                            return $newFilePath;
                                                        } else {
                                                            throw new Exception("Gagal memindahkan file");
                                                        }
                                                    } else {
                                                        throw new Exception("Anda hanya bisa memasukkan jpg, png, jpeg");
                                                    }
                                                }

                                            $fileLogoPath = uploadFoto($logo);

                                            try{
                                                $sql = "INSERT INTO penyediaasuransi (namaMerek, paketAsuransi, besaranPolis, besaranTanggungan, logo) 
                                                VALUES ('$merek','$paket','$polis','$tanggungan', '$fileLogoPath')";

                                                $result = mysqli_query($db, $sql);

                                                if ($result){
                                                    echo "<script>alert('Data Tersimpan')</script>";
                                                }
                                                else{
                                                    echo "<script>alert('Data Belum Tersimpan')</script>";
                                                }
                                            }
                                            catch(mysqli_sql_exception $e){
                                                echo "Error: " .$e-> getMessage();
                                            }
                                        }
                                    ?>
                                    <form id="inputForm" method="POST" action="asuransi.php" enctype="multipart/form-data">
                                        <label for="merek">Nama Merek:</label>
                                        <input type="text" id="merek" name="merek" required>
                                        <label for="paket">Paket Asuransi:</label>
                                        <input type="text" id="paket" name="paket" required>
                                        <label for="besaran_polis">Besaran Polis:</label>
                                        <input type="text" id="besaran_polis" name="besaran_polis" required>
                                        <label for="besaran_tanggungan">Besaran Tanggungan:</label>
                                        <input type="text" id="besaran_tanggungan" name="besaran_tanggungan" required>
                                        </br>
                                        <label for="logo">Logo Asuransi:</label>
                                        <input type="file" id="logo" name="logo" accept="image/*">
                                        
                                        <input type="submit" value="Simpan" name="submit">
                                    </form>
                                    </br>
                                     </br>
                                    <table id="dataTable" >
                                    <?php
                                        include "../database.php";
                                    

                                        $sql = "SELECT * FROM penyediaasuransi";
                                        $result = $db->query($sql);

                                        if ($result->num_rows > 0){

                                            echo'<table id="dataTable">';
                                            echo "<thead><tr><th style='text-align: center;'>ID</th><th style='text-align: center;'>Merek</th><th style='text-align: center;'>Paket</th><th style='text-align: center;'>Polis</th><th style='text-align: center;'>Besaran Tanggungan</th><th style='text-align: center;'>Logo</th><th style='text-align: center;'>Aksi</th></tr></thead>";
                                            while ($row = $result->fetch_assoc()) {
                                                
                                                echo "<tr>
                                                <td>".$row["Id"]."</td>
                                                <td>".$row["namaMerek"]."</td>
                                                <td>".$row["paketAsuransi"]."</td>
                                                <td>".$row["besaranPolis"]."</td>
                                                <td>".$row["besaranTanggungan"]."</td>";
                                        
                                        if (!empty($row["Logo"])) {
                                            echo "<td><img src='" . $row["Logo"] . "' alt='Logo' width='100' class='img-thumbnail' data-toggle='modal' data-target='#imageModal' data-image='" . $row["Logo"] . "'></td>";
                                        } else {
                                            echo "<td>Tidak ada logo</td>";
                                        }
                                        
                                        echo "  <td>
                                                    <button class='btn btn-primary' data-toggle='modal' data-target='#editArtikelModal" . $row['Id'] . "'>Edit</button>
                                                    <a href='delete.php?id=" . $row['Id'] . "' class='delete-btn btn'>Delete</a>
                                                </td>
                                              </tr>";
                                        

                                                echo '<div class="modal fade" id="editArtikelModal' . $row['Id'] . '" tabindex="-1" aria-labelledby="editArtikelModalLabel' . $row['Id'] . '" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editArtikelModalLabel' . $row['Id'] . '">Edit Asuransi</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Form untuk mengedit artikel -->
                                                            <form id="editphp" action="edit.php" method="POST">
                                                                <input type="hidden" id="edit-Id" name="Id" value="' . $row['Id'] . '">
                                                                <div class="form-group">
                                                                    <label for="edit-namaMerek">Nama Merek:</label>
                                                                    <input type="text" class="form-control" id="edit-namaMerek" name="namaMerek" value="' . $row['namaMerek'] . '">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit-paketAsuransi">Paket Asuransi</label>
                                                                    <input type="text" class="form-control" id="edit-paketAsuransi" name="paketAsuransi" required value="' . $row['paketAsuransi'] . '">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit-besaranPolis">Besaran Polis:</label>
                                                                    <input class="form-control" id="edit-besaranPolis" name="besaranPolis">' . $row['besaranPolis'] . '</input>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="edit-besaranTanggungan">Besaran Tanggungan:</label>
                                                                    <input class="form-control" id="edit-besaranTanggungan" name="besaranTanggungan">' . $row['besaranTanggungan'] . '</input>
                                                                </div>
                                                                <button type="submit" name="submit2" class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                            } 
                                            echo "</table>";
                                        }

                                    ?>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Logo Asuransi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img id="modalImage" src="" alt="Logo" class="img-fluid">
                    </div>
            </div>
        </div>
    </div>
                </main>
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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#imageModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var imageSrc = button.data('image');
                var modal = $(this);
                modal.find('#modalImage').attr('src', imageSrc);
            });
        });
    </script>
    </body>
</html>
