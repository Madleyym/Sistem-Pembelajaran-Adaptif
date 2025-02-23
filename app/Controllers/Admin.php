<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Pembelajaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
</head>

<body>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="<?= base_url('admin') ?>">
                                <i class='bx bxs-dashboard'></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('admin/guru') ?>">
                                <i class='bx bxs-user'></i>
                                Manajemen Guru
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('admin/siswa') ?>">
                                <i class='bx bxs-group'></i>
                                Manajemen Siswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('admin/orangtua') ?>">
                                <i class='bx bxs-family'></i>
                                Manajemen Orang Tua
                            </a>
                        </li>
                        <li class="nav-item mt-5">
                            <a class="nav-link text-white" href="<?= base_url('logout') ?>">
                                <i class='bx bx-log-out'></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard Admin</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <span class="btn btn-sm btn-outline-secondary"><?= date('d M Y') ?></span>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-primary text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Total Guru</h6>
                                        <h2 class="mb-0"><?= $total_guru ?></h2>
                                    </div>
                                    <i class='bx bxs-user bx-lg'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-success text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Total Siswa</h6>
                                        <h2 class="mb-0"><?= $total_siswa ?></h2>
                                    </div>
                                    <i class='bx bxs-group bx-lg'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-info text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Total Orang Tua</h6>
                                        <h2 class="mb-0"><?= $total_orangtua ?></h2>
                                    </div>
                                    <i class='bx bxs-family bx-lg'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Users Table -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Pengguna Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Peran</th>
                                        <th>Tanggal Daftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pengguna_terbaru as $user): ?>
                                        <tr>
                                            <td><?= $user['nama_lengkap'] ?></td>
                                            <td><?= $user['username'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><span class="badge bg-primary"><?= ucfirst($user['peran']) ?></span></td>
                                            <td><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>