CREATE DATABASE IF NOT EXISTS spk_cloud_vendor;
USE spk_cloud_vendor;

CREATE TABLE IF NOT EXISTS data_vendor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_vendor VARCHAR(255),
    harga DECIMAL(15,2),
    sla DECIMAL(5,2),
    waktu_implementasi INT,
    jumlah_proyek INT,
    uptime DECIMAL(5,2)
);

INSERT INTO data_vendor (nama_vendor, harga, sla, waktu_implementasi, jumlah_proyek, uptime)
VALUES
('Indonesian Cloud', 150000000, 99.5, 12, 75, 99.95),
('IDCloudHost', 250000000, 99.2, 36, 120, 99.92),
('Exabytes', 400000000, 99.3, 1, 40, 99.95),
('Biznet Gio', 600000000, 99.5, 18, 150, 99.95),
('DCloud', 80000000, 96, 1, 20, 99.8);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a default admin user (password: admin123)
INSERT INTO users (username, password) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
