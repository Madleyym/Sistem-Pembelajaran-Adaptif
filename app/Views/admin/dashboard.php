<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Pembelajaran Adaptif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-link i {
            margin-right: 0.5rem;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .top-header {
            background: #f8f9fa;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="top-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="user-info">
                    <img src="<?= base_url('assets/img/avatar.png') ?>" alt="User Avatar">
                    <div>
                        <h6 class="mb-0"><?= session()->get('username') ?></h6>
                        <small class="text-muted"><?= session()->get('peran') ?></small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end">
                        <small class="d-block text-muted">Current Date & Time (UTC)</small>
                        <strong><?= date('Y-m-d H:i:s') ?></strong>
                    </div>
                    <div class="vr"></div>
                    <div class="text-end">
                        <small class="d-block text-muted">Login Time</small>
                        <strong><?= session()->get('login_time') ?></strong>
                    </div>
                    <div class="vr"></div>
                    <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger btn-sm">
                        <i class='bx bx-log-out'></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
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
                            <a class="nav-link text-white" href="<?= base_url('admin/materi') ?>">
                                <i class='bx bxs-book-content'></i>
                                Manajemen Materi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('admin/kelas') ?>">
                                <i class='bx bxs-school'></i>
                                Manajemen Kelas
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
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('admin/chatbot') ?>">
                                <i class='bx bxs-bot'></i>
                                Konfigurasi ChatBot
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url('admin/evaluasi') ?>">
                                <i class='bx bxs-report'></i>
                                Evaluasi Pembelajaran
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard Admin</h1>
                </div>

                <!-- Quick Stats Row -->
                <div class="row">
                    <div class="col-md-3 mb-4">
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
                    <div class="col-md-3 mb-4">
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
                    <div class="col-md-3 mb-4">
                        <div class="card bg-info text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Total Materi</h6>
                                        <h2 class="mb-0"><?= $total_materi ?></h2>
                                    </div>
                                    <i class='bx bxs-book-content bx-lg'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card bg-warning text-white h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title">Total Kelas</h6>
                                        <h2 class="mb-0"><?= $total_kelas ?></h2>
                                    </div>
                                    <i class='bx bxs-school bx-lg'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Progress Pembelajaran</h5>
                                <select class="form-select form-select-sm" style="width: auto;">
                                    <option>Minggu Ini</option>
                                    <option>Bulan Ini</option>
                                    <option>Tahun Ini</option>
                                </select>
                            </div>
                            <div class="card-body">
                                <canvas id="learningChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Statistik Penggunaan ChatBot</h5>
                                <select class="form-select form-select-sm" style="width: auto;">
                                    <option>7 Hari Terakhir</option>
                                    <option>30 Hari Terakhir</option>
                                </select>
                            </div>
                            <div class="card-body">
                                <canvas id="chatbotChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-feed">
                                    <?php foreach ($recent_activities as $activity): ?>
                                        <div class="d-flex mb-3">
                                            <div class="flex-shrink-0">
                                                <i class='bx bxs-circle text-<?= $activity['type'] ?>'></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-0"><?= $activity['description'] ?></p>
                                                <small class="text-muted"><?= $activity['time'] ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Performa Kelas</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Kelas</th>
                                                <th>Rata-rata Nilai</th>
                                                <th>Progress</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($class_performance as $class): ?>
                                                <tr>
                                                    <td><?= $class['name'] ?></td>
                                                    <td><?= $class['average_score'] ?></td>
                                                    <td>
                                                        <div class="progress" style="height: 5px;">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: <?= $class['progress'] ?>%"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-<?= $class['status_color'] ?>">
                                                            <?= $class['status'] ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Learning Progress Chart
        new Chart(document.getElementById('learningChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Progress Rata-rata',
                    data: <?= json_encode($learning_progress) ?>,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // ChatBot Usage Chart
        new Chart(document.getElementById('chatbotChart'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($chatbot_labels) ?>,
                datasets: [{
                    label: 'Interaksi ChatBot',
                    data: <?= json_encode($chatbot_data) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>

</html>