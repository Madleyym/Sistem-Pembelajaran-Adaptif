CREATE TABLE pengguna (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    peran ENUM('admin', 'guru', 'siswa', 'orangtua') DEFAULT 'siswa',
    nama_lengkap VARCHAR(255),
    foto_profil VARCHAR(255) DEFAULT 'default.jpg',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE kelas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_kelas VARCHAR(50) NOT NULL,
    tingkat INT NOT NULL, -- 4,5,6 (SD)
    deskripsi TEXT,
    guru_id INT,
    tahun_ajaran VARCHAR(20),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (guru_id) REFERENCES pengguna(id)
);

CREATE TABLE siswa_kelas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    siswa_id INT,
    kelas_id INT,
    status ENUM('aktif', 'lulus', 'pindah') DEFAULT 'aktif',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES pengguna(id),
    FOREIGN KEY (kelas_id) REFERENCES kelas(id)
);

CREATE TABLE materi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    konten TEXT,
    tingkat ENUM('pemula', 'menengah', 'lanjutan') DEFAULT 'pemula',
    tipe_materi ENUM('teks', 'video', 'audio', 'dokumen') DEFAULT 'teks',
    file_path VARCHAR(255),
    guru_id INT,
    kelas_id INT,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (guru_id) REFERENCES pengguna(id),
    FOREIGN KEY (kelas_id) REFERENCES kelas(id)
);

CREATE TABLE kuis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    materi_id INT,
    durasi INT DEFAULT 30, -- dalam menit
    minimal_nilai INT DEFAULT 70,
    status ENUM('draft', 'published', 'closed') DEFAULT 'draft',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (materi_id) REFERENCES materi(id)
);

CREATE TABLE soal (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kuis_id INT,
    pertanyaan TEXT NOT NULL,
    tipe ENUM('pilihan_ganda', 'benar_salah', 'isian') DEFAULT 'pilihan_ganda',
    pilihan JSON, -- menyimpan pilihan jawaban dalam format JSON
    jawaban_benar TEXT,
    bobot INT DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kuis_id) REFERENCES kuis(id)
);

CREATE TABLE hasil_kuis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    siswa_id INT,
    kuis_id INT,
    nilai INT,
    jawaban JSON, -- menyimpan jawaban siswa
    waktu_mulai DATETIME,
    waktu_selesai DATETIME,
    status ENUM('berlangsung', 'selesai', 'timeout') DEFAULT 'berlangsung',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES pengguna(id),
    FOREIGN KEY (kuis_id) REFERENCES kuis(id)
);

CREATE TABLE kemajuan_siswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    siswa_id INT,
    materi_id INT,
    status ENUM('belum_mulai', 'sedang_belajar', 'selesai') DEFAULT 'belum_mulai',
    progress INT DEFAULT 0, -- dalam persen
    last_accessed DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES pengguna(id),
    FOREIGN KEY (materi_id) REFERENCES materi(id)
);

CREATE TABLE nilai (
    id INT PRIMARY KEY AUTO_INCREMENT,
    siswa_id INT,
    materi_id INT,
    jenis_nilai ENUM('tugas', 'kuis', 'ujian') NOT NULL,
    nilai INT,
    komentar TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES pengguna(id),
    FOREIGN KEY (materi_id) REFERENCES materi(id)
);

CREATE TABLE notifikasi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pengguna_id INT,
    judul VARCHAR(255) NOT NULL,
    pesan TEXT,
    tipe ENUM('info', 'tugas', 'nilai', 'pengumuman') DEFAULT 'info',
    dibaca BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (pengguna_id) REFERENCES pengguna(id)
);


CREATE TABLE orangtua_siswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    orangtua_id INT,
    siswa_id INT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (orangtua_id) REFERENCES pengguna(id),
    FOREIGN KEY (siswa_id) REFERENCES pengguna(id)
);

-- Admin
INSERT INTO pengguna (username, password, email, peran, nama_lengkap) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@sekolah.id', 'admin', 'Administrator');

-- Guru
INSERT INTO pengguna (username, password, email, peran, nama_lengkap)
VALUES ('guru1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'guru1@sekolah.id', 'guru', 'Guru Bahasa');

-- Siswa
INSERT INTO pengguna (username, password, email, peran, nama_lengkap)
VALUES ('siswa1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa1@sekolah.id', 'siswa', 'Siswa Satu');

-- Orang tua
INSERT INTO pengguna (username, password, email, peran, nama_lengkap)
VALUES ('ortu1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ortu1@sekolah.id', 'orangtua', 'Orang Tua Satu');


-- Menghubungkan ortu1 dengan siswa1
INSERT INTO orangtua_siswa (orangtua_id, siswa_id) 
VALUES (
    (SELECT id FROM pengguna WHERE username = 'ortu1'), -- ID orang tua
    (SELECT id FROM pengguna WHERE username = 'siswa1') -- ID siswa
);