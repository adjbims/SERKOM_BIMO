<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventaris Barang')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background-color: #f4f5f7;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 220px;
            background-color: #2e2e2e;
            padding-top: 50px;
            color: #eaeaea;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 600;
            color: #a9ff9b;
        }

        .sidebar a {
            color: #eaeaea;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        .sidebar a:hover {
            background-color: #444;
            padding-left: 25px;
        }

        .main-content {
            margin-left: 220px;
            padding: 40px 30px;
            background-color: #f4f5f7;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 30px;
            color: #3a3a3a;
        }

        .card-header {
            background-color: #6a8e3f;
            color: white;
        }

        .alert {
            font-size: 14px;
        }

        footer {
            margin-left: 220px;
            background-color: #eaeaea;
            padding: 12px 0;
            text-align: center;
            font-size: 14px;
            border-top: 1px solid #ccc;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4><i class="bi bi-box-fill me-2"></i>INV-Barang</h4>
        <a href="{{ url('/') }}"><i class="bi bi-grid-1x2-fill me-2"></i> Beranda</a>
        <a href="{{ route('items.create') }}"><i class="bi bi-database-add me-2"></i> Tambah Barang</a>
    </div>

    <div class="main-content">
        <div class="container">
            <h2>@yield('header', 'Dashboard Inventaris')</h2>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <footer>
        <p class="mb-0">&copy; {{ date('Y') }} Sistem Inventaris Bimo Adji</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
