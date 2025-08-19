<?php
$pageTitle = "Daftar Vendor";
include 'header.php';
redirectIfNotLoggedIn();
?>

<!-- Main Content -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-list-alt"></i> Daftar Vendor Cloud</h2>
        <a href="tambah_edit_vendor.php" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah Vendor
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Vendor</th>
                            <th>Harga</th>
                            <th>SLA (%)</th>
                            <th>Waktu Implementasi (bulan)</th>
                            <th>Jumlah Proyek</th>
                            <th>Uptime (%)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';
                        $query = mysqli_query($selectdb, "SELECT * FROM data_vendor");
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($data['nama_vendor']); ?></td>
                                <td><?php echo number_format($data['harga'], 2); ?></td>
                                <td><?php echo $data['sla']; ?></td>
                                <td><?php echo $data['waktu_implementasi']; ?></td>
                                <td><?php echo $data['jumlah_proyek']; ?></td>
                                <td><?php echo $data['uptime']; ?></td>
                                <td>
                                    <a href="tambah_edit_vendor.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="hapus_vendor.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus vendor ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
