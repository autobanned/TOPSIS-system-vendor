<?php
$pageTitle = "Hasil Rekomendasi";
include 'header.php';
redirectIfNotLoggedIn();
?>

<!-- Main Content -->
<div class="container mt-4">
    <h2 class="mb-4"><i class="fas fa-chart-bar"></i> Hasil Rekomendasi</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'koneksi.php';

        $harga = $_POST['harga'];
        $sla = $_POST['sla'];
        $waktu_implementasi = $_POST['waktu_implementasi'];
        $jumlah_proyek = $_POST['jumlah_proyek'];
        $uptime = $_POST['uptime'];

        // Ambil data dari database
        $query = mysqli_query($selectdb, "SELECT * FROM data_vendor");
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }

        // Normalisasi
        $normalized = [];
        foreach ($data as $row) {
            $normalized[] = [
                'harga' => $row['harga'] / max(array_column($data, 'harga')),
                'sla' => $row['sla'] / max(array_column($data, 'sla')),
                'waktu_implementasi' => $row['waktu_implementasi'] / max(array_column($data, 'waktu_implementasi')),
                'jumlah_proyek' => $row['jumlah_proyek'] / max(array_column($data, 'jumlah_proyek')),
                'uptime' => $row['uptime'] / max(array_column($data, 'uptime'))
            ];
        }

        // Bobot
        $weights = [
            'harga' => $harga,
            'sla' => $sla,
            'waktu_implementasi' => $waktu_implementasi,
            'jumlah_proyek' => $jumlah_proyek,
            'uptime' => $uptime
        ];

        // Ideal dan Negative-Ideal Solution
        $ideal = [
            'harga' => min(array_column($normalized, 'harga')),
            'sla' => max(array_column($normalized, 'sla')),
            'waktu_implementasi' => min(array_column($normalized, 'waktu_implementasi')),
            'jumlah_proyek' => max(array_column($normalized, 'jumlah_proyek')),
            'uptime' => max(array_column($normalized, 'uptime'))
        ];

        $negative_ideal = [
            'harga' => max(array_column($normalized, 'harga')),
            'sla' => min(array_column($normalized, 'sla')),
            'waktu_implementasi' => max(array_column($normalized, 'waktu_implementasi')),
            'jumlah_proyek' => min(array_column($normalized, 'jumlah_proyek')),
            'uptime' => min(array_column($normalized, 'uptime'))
        ];

        // Hitung jarak dan ranking
        $ranking = [];
        foreach ($normalized as $i => $row) {
            $distance_plus = sqrt(
                pow($row['harga'] - $ideal['harga'], 2) +
                pow($row['sla'] - $ideal['sla'], 2) +
                pow($row['waktu_implementasi'] - $ideal['waktu_implementasi'], 2) +
                pow($row['jumlah_proyek'] - $ideal['jumlah_proyek'], 2) +
                pow($row['uptime'] - $ideal['uptime'], 2)
            );
            $distance_minus = sqrt(
                pow($row['harga'] - $negative_ideal['harga'], 2) +
                pow($row['sla'] - $negative_ideal['sla'], 2) +
                pow($row['waktu_implementasi'] - $negative_ideal['waktu_implementasi'], 2) +
                pow($row['jumlah_proyek'] - $negative_ideal['jumlah_proyek'], 2) +
                pow($row['uptime'] - $negative_ideal['uptime'], 2)
            );
            $ranking[] = [
                'id' => $i,
                'score' => $distance_minus / ($distance_plus + $distance_minus)
            ];
        }

        // Urutkan ranking
        usort($ranking, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });
    }
    ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-trophy"></i> Hasil Rekomendasi</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Rank</th>
                            <th>Nama Vendor</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ranking as $i => $item): ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><?php echo $data[$item['id']]['nama_vendor']; ?></td>
                                <td><?php echo round($item['score'], 4); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <a href="rekomendasi.php" class="btn btn-secondary mt-3"><i class="fas fa-redo"></i> Hitung Lagi</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
