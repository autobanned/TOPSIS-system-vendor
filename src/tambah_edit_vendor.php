<?php
$pageTitle = isset($_GET['id']) ? "Edit Vendor" : "Tambah Vendor";
include 'header.php';
redirectIfNotLoggedIn();

// Initialize variables
$id = $nama_vendor = $harga = $sla = $waktu_implementasi = $jumlah_proyek = $uptime = '';
$isEdit = false;

// Check if editing an existing vendor
if (isset($_GET['id'])) {
    $isEdit = true;
    include 'koneksi.php';
    $id = $_GET['id'];
    $query = mysqli_query($selectdb, "SELECT * FROM data_vendor WHERE id = $id");
    $vendor = mysqli_fetch_assoc($query);
    if ($vendor) {
        $nama_vendor = $vendor['nama_vendor'];
        $harga = $vendor['harga'];
        $sla = $vendor['sla'];
        $waktu_implementasi = $vendor['waktu_implementasi'];
        $jumlah_proyek = $vendor['jumlah_proyek'];
        $uptime = $vendor['uptime'];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'koneksi.php';
    $nama_vendor = $_POST['nama_vendor'];
    $harga = $_POST['harga'];
    $sla = $_POST['sla'];
    $waktu_implementasi = $_POST['waktu_implementasi'];
    $jumlah_proyek = $_POST['jumlah_proyek'];
    $uptime = $_POST['uptime'];

    if ($isEdit && isset($_POST['id'])) {
        // Update existing vendor
        $id = $_POST['id'];
        $query = "UPDATE data_vendor SET
                  nama_vendor = '$nama_vendor',
                  harga = $harga,
                  sla = $sla,
                  waktu_implementasi = $waktu_implementasi,
                  jumlah_proyek = $jumlah_proyek,
                  uptime = $uptime
                  WHERE id = $id";
    } else {
        // Insert new vendor
        $query = "INSERT INTO data_vendor
                  (nama_vendor, harga, sla, waktu_implementasi, jumlah_proyek, uptime)
                  VALUES
                  ('$nama_vendor', $harga, $sla, $waktu_implementasi, $jumlah_proyek, $uptime)";
    }

    if (mysqli_query($selectdb, $query)) {
        header("Location: daftar_vendor.php");
        exit;
    } else {
        $error = "Error: " . mysqli_error($selectdb);
    }
}
?>

<!-- Main Content -->
<div class="container mt-4">
    <h2 class="mb-4"><i class="fas <?php echo $isEdit ? 'fa-edit' : 'fa-plus'; ?>"></i> <?php echo $isEdit ? 'Edit' : 'Tambah'; ?> Vendor</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form method="post">
                <?php if ($isEdit): ?>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="nama_vendor"><i class="fas fa-building"></i> Nama Vendor</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="<?php echo $nama_vendor; ?>" required>
                </div>

                <div class="form-group">
                    <label for="harga"><i class="fas fa-money-bill-wave"></i> Harga</label>
                    <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>" required>
                </div>

                <div class="form-group">
                    <label for="sla"><i class="fas fa-percentage"></i> SLA (%)</label>
                    <input type="number" step="0.01" class="form-control" id="sla" name="sla" value="<?php echo $sla; ?>" required>
                </div>

                <div class="form-group">
                    <label for="waktu_implementasi"><i class="fas fa-clock"></i> Waktu Implementasi (bulan)</label>
                    <input type="number" class="form-control" id="waktu_implementasi" name="waktu_implementasi" value="<?php echo $waktu_implementasi; ?>" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_proyek"><i class="fas fa-project-diagram"></i> Jumlah Proyek</label>
                    <input type="number" class="form-control" id="jumlah_proyek" name="jumlah_proyek" value="<?php echo $jumlah_proyek; ?>" required>
                </div>

                <div class="form-group">
                    <label for="uptime"><i class="fas fa-server"></i> Uptime (%)</label>
                    <input type="number" step="0.01" class="form-control" id="uptime" name="uptime" value="<?php echo $uptime; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas <?php echo $isEdit ? 'fa-save' : 'fa-plus'; ?>"></i> <?php echo $isEdit ? 'Simpan Perubahan' : 'Tambah Vendor'; ?>
                </button>

                <a href="daftar_vendor.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
