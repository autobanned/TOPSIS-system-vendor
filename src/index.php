<?php
$pageTitle = "Home";
include 'header.php';
redirectIfNotLoggedIn();
?>

<!-- Hero Section -->
<div class="hero text-center">
    <div class="container">
        <h1><i class="fas fa-cloud"></i> Sistem TOPSIS Pemilihan Vendor Cloud</h1>
        <p class="lead">Pilih vendor cloud terbaik berdasarkan kriteria yang Anda tentukan.</p>
    </div>
</div>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-list-alt"></i> Daftar Vendor</h5>
                    <p class="card-text">Lihat daftar vendor cloud yang tersedia dan detail kriteria masing-masing.</p>
                    <a href="daftar_vendor.php" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat Daftar</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-balance-scale"></i> Rekomendasi</h5>
                    <p class="card-text">Gunakan metode TOPSIS untuk mendapatkan rekomendasi vendor cloud terbaik.</p>
                    <a href="rekomendasi.php" class="btn btn-primary"><i class="fas fa-calculator"></i> Mulai Analisis</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
