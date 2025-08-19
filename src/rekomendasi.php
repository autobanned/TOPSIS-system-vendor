<?php
$pageTitle = "Rekomendasi";
include 'header.php';
redirectIfNotLoggedIn();
?>

<!-- Main Content -->
<div class="container mt-4">
    <h2 class="mb-4"><i class="fas fa-balance-scale"></i> Rekomendasi Vendor Cloud</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process the form and calculate TOPSIS
        include 'koneksi.php';

        $harga = $_POST['harga'];
        $sla = $_POST['sla'];
        $waktu_implementasi = $_POST['waktu_implementasi'];
        $jumlah_proyek = $_POST['jumlah_proyek'];
        $uptime = $_POST['uptime'];

        // Redirect to hasil.php with POST data
        echo '<form id="topsisForm" action="hasil.php" method="post">';
        echo '<input type="hidden" name="harga" value="' . $harga . '">';
        echo '<input type="hidden" name="sla" value="' . $sla . '">';
        echo '<input type="hidden" name="waktu_implementasi" value="' . $waktu_implementasi . '">';
        echo '<input type="hidden" name="jumlah_proyek" value="' . $jumlah_proyek . '">';
        echo '<input type="hidden" name="uptime" value="' . $uptime . '">';
        echo '</form>';
        echo '<script>document.getElementById("topsisForm").submit();</script>';
        exit;
    }
    ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-weight"></i> Input Bobot Kriteria</h5>
            <form method="post">
                <div class="form-group">
                    <label for="harga"><i class="fas fa-money-bill-wave"></i> Harga</label>
                    <input type="number" step="0.01" class="form-control" id="harga" name="harga" required>
                </div>
                <div class="form-group">
                    <label for="sla"><i class="fas fa-percentage"></i> SLA (%)</label>
                    <input type="number" step="0.01" class="form-control" id="sla" name="sla" required>
                </div>
                <div class="form-group">
                    <label for="waktu_implementasi"><i class="fas fa-clock"></i> Waktu Implementasi (bulan)</label>
                    <input type="number" class="form-control" id="waktu_implementasi" name="waktu_implementasi" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_proyek"><i class="fas fa-project-diagram"></i> Jumlah Proyek</label>
                    <input type="number" class="form-control" id="jumlah_proyek" name="jumlah_proyek" required>
                </div>
                <div class="form-group">
                    <label for="uptime"><i class="fas fa-server"></i> Uptime (%)</label>
                    <input type="number" step="0.01" class="form-control" id="uptime" name="uptime" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-calculator"></i> Hitung Rekomendasi</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
