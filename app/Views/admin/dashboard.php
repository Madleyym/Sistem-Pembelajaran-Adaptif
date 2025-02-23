<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Pembelajaran Adaptif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
        }

        body {
            background-color: #f8f9fc;
        }

        .sidebar {
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            transition: all 0.3s;
        }

        .sidebar-brand {
            padding: 1.5rem 1rem;
            text-align: center;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-link {
            padding: 1rem;
            color: rgba(255, 255, 255, 0.8) !important;
            border-radius: 0;
            margin-bottom: 0;
            transition: all 0.3s;
        }

        .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            padding-left: 1.25rem;
        }

        .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .nav-link i {
            margin-right: 0.75rem;
            width: 1.25rem;
            text-align: center;
        }

        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .top-header {
            background: white;
            padding: 1rem;
            border-bottom: 1px solid #e3e6f0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
        }

        .stat-card {
            border-left: 4px solid;
            border-radius: 0.35rem;
        }

        .stat-card.primary {
            border-left-color: var(--primary-color);
        }

        .stat-card.success {
            border-left-color: var(--success-color);
        }

        .stat-card.info {
            border-left-color: var(--info-color);
        }

        .stat-card.warning {
            border-left-color: var(--warning-color);
        }

        .activity-feed .activity-item {
            padding: 1rem;
            border-left: 2px solid var(--primary-color);
            margin-bottom: 1rem;
            background: #f8f9fc;
            border-radius: 0.35rem;
        }

        .progress-slim {
            height: 0.5rem;
            border-radius: 0.25rem;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            padding: 0.25rem 0.5rem;
            border-radius: 50%;
            font-size: 0.75rem;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary-color);
            border-radius: 4px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 1100;
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            main {
                margin-left: 0 !important;
            }
        }
    </style>
</head>

<body>
    <!-- Top Header -->
    <!-- Top Header -->
    <div class="top-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-auto d-md-none">
                    <button class="btn btn-link" id="sidebarToggle">
                        <i class='bx bx-menu fs-4'></i>
                    </button>
                </div>

                <div class="col-auto me-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="d-flex align-items-center gap-3">
                        <!-- Notifications -->
                        <div class="position-relative">
                            <button class="btn btn-link text-dark">
                                <i class='bx bx-bell fs-4'></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </button>
                        </div>

                        <!-- Messages -->
                        <div class="position-relative">
                            <button class="btn btn-link text-dark">
                                <i class='bx bx-message fs-4'></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                    5
                                </span>
                            </button>
                        </div>

                        <!-- User Info -->
                        <div class="user-info">
                            <img src="/api/placeholder/45/45" alt="User Avatar">
                            <div>
                                <h6 class="mb-0">Admin</h6>
                                <small class="text-muted">Administrator</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="sidebar-brand">
                    <h5 class="mb-0">Sistem Pembelajaran Adaptif</h5>
                    <small>Admin Dashboard</small>
                </div>
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('admin') ?>">
                                <i class='bx bxs-dashboard'></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/materi') ?>">
                                <i class='bx bxs-book-content'></i>
                                Manajemen Materi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/kelas') ?>">
                                <i class='bx bxs-school'></i>
                                Manajemen Kelas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/guru') ?>">
                                <i class='bx bxs-user'></i>
                                Manajemen Guru
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/siswa') ?>">
                                <i class='bx bxs-group'></i>
                                Manajemen Siswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/orangtua') ?>">
                                <i class='bx bxs-family'></i>
                                Manajemen Orang Tua
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/chatbot') ?>">
                                <i class='bx bxs-bot'></i>
                                Konfigurasi ChatBot
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('admin/evaluasi') ?>">
                                <i class='bx bxs-report'></i>
                                Evaluasi Pembelajaran
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
                                <i class='bx bx-log-out'></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <!-- Welcome Message -->
                <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                    <div>
                        <h1 class="h3">Welcome back, <?= session()->get('username') ?>!</h1>
                        <p class="text-muted">Here's what's happening with your learning system today.</p>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary">
                            <i class='bx bx-calendar'></i> This week
                        </button>
                    </div>
                </div> -->

                <!-- Quick Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card primary h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-1">Total Guru</h6>
                                        <h2 class="mb-0"><?= $total_guru ?></h2>
                                        <small class="text-success">
                                            <i class='bx bx-up-arrow-alt'></i> +5% from last month
                                        </small>
                                    </div>
                                    <div class="icon-shape bg-primary text-white rounded-circle p-3">
                                        <i class='bx bxs-user bx-sm'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card success h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-1">Total Siswa</h6>
                                        <h2 class="mb-0"><?= $total_siswa ?></h2>
                                        <small class="text-success">
                                            <i class='bx bx-up-arrow-alt'></i> +12% from last month
                                        </small>
                                    </div>
                                    <div class="icon-shape bg-success text-white rounded-circle p-3">
                                        <i class='bx bxs-group bx-sm'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card info h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-1">Total Materi</h6>
                                        <h2 class="mb-0"><?= $total_materi ?></h2>
                                        <small class="text-success">
                                            <i class='bx bx-up-arrow-alt'></i> +3% from last month
                                        </small>
                                    </div>
                                    <div class="icon-shape bg-info text-white rounded-circle p-3">
                                        <i class='bx bxs-book-content bx-sm'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card stat-card warning h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title text-muted mb-1">Total Kelas</h6>
                                        <h2 class="mb-0"><?= $total_kelas ?></h2>
                                        <small class="text-success<small class=" text-success">
                                            <i class='bx bx-up-arrow-alt'></i> +2% from last month
                                        </small>
                                    </div>
                                    <div class="icon-shape bg-warning text-white rounded-circle p-3">
                                        <i class='bx bxs-school bx-sm'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-xl-8">
                        <div class="card h-100">
                            <div class="card-header border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Progress Pembelajaran</h5>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class='bx bx-download'></i> Download Report
                                        </button>
                                        <select class="form-select form-select-sm" style="width: auto;">
                                            <option>Minggu Ini</option>
                                            <option>Bulan Ini</option>
                                            <option>Tahun Ini</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="learningChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-4">
                        <div class="card h-100">
                            <div class="card-header border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Statistik ChatBot</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-link" data-bs-toggle="dropdown">
                                            <i class='bx bx-dots-vertical-rounded'></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Download Data</a></li>
                                            <li><a class="dropdown-item" href="#">View Full Report</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Settings</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="chatbotChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities and Performance -->
                <div class="row g-4">
                    <!-- Recent Activities -->
                    <div class="col-12 col-xl-6">
                        <div class="card h-100">
                            <div class="card-header border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                                    <button class="btn btn-sm btn-link text-muted">View All</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="activity-feed">
                                    <?php if (!empty($recent_activities)): ?>
                                        <?php foreach ($recent_activities as $activity): ?>
                                            <?php if (isset($activity['type']) && isset($activity['icon']) && isset($activity['title']) && isset($activity['description']) && isset($activity['time'])): ?>
                                                <div class="activity-item">
                                                    <div class="d-flex align-items-start">
                                                        <div class="activity-icon bg-light-<?= esc($activity['type']) ?> rounded-circle p-2 me-3">
                                                            <i class='bx bxs-<?= esc($activity['icon']) ?> text-<?= esc($activity['type']) ?>'></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1"><?= esc($activity['title']) ?></h6>
                                                            <p class="mb-1 text-muted"><?= esc($activity['description']) ?></p>
                                                            <small class="text-muted">
                                                                <i class='bx bx-time-five'></i> <?= esc($activity['time']) ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="text-center text-muted">
                                            <p>Tidak ada aktivitas terbaru</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Class Performance -->
                    <div class="col-12 col-xl-6">
                        <div class="card h-100">
                            <div class="card-header border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Performa Kelas</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            Filter
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Semua Kelas</a></li>
                                            <li><a class="dropdown-item" href="#">Kelas Aktif</a></li>
                                            <li><a class="dropdown-item" href="#">Kelas Selesai</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Kelas</th>
                                                <th>Rata-rata</th>
                                                <th>Progress</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($class_performance as $class): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light-<?= $class['color'] ?> rounded-circle me-2">
                                                                <?= substr($class['name'], 0, 2) ?>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0"><?= $class['name'] ?></h6>
                                                                <small class="text-muted"><?= $class['teacher'] ?></small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><?= $class['average_score'] ?></td>
                                                    <td style="width: 30%;">
                                                        <div class="progress progress-slim">
                                                            <div class="progress-bar bg-<?= $class['color'] ?>"
                                                                role="progressbar"
                                                                style="width: <?= $class['progress'] ?>%"
                                                                aria-valuenow="<?= $class['progress'] ?>"
                                                                aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-<?= $class['status_color'] ?>-light text-<?= $class['status_color'] ?>">
                                                            <?= $class['status'] ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-icon btn-light">
                                                            <i class='bx bx-chevron-right'></i>
                                                        </button>
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
        // Toggle Sidebar on Mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Learning Progress Chart
        new Chart(document.getElementById('learningChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Progress Rata-rata',
                    data: <?= json_encode($learning_progress) ?>,
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2],
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // ChatBot Usage Chart
        new Chart(document.getElementById('chatbotChart'), {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($chatbot_labels) ?>,
                datasets: [{
                    data: <?= json_encode($chatbot_data) ?>,
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#36b9cc',
                        '#f6c23e'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '70%'
            }
        });
    </script>
</body>

</html>