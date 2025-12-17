<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment System</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
        }
        .navbar {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 600;
            color: #2c3e50 !important;
        }
        .nav-link {
            color: #555 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #0d6efd !important;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 10px 20px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <!-- White Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-calendar-check text-primary"></i> BookEasy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if(session('user_id'))
                        <li class="nav-item me-3 text-muted small">
                            Welcome, <strong class="text-dark">{{ session('name') }}</strong>
                        </li>
                        @if(session('role') == 'client')
                            <li class="nav-item"><a class="nav-link" href="/book">Book</a></li>
                            <li class="nav-item"><a class="nav-link" href="/my-appointments">History</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link text-primary" href="/appointments">Dashboard</a></li>
                        @endif
                        <li class="nav-item ms-3">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm rounded-pill px-3">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="btn btn-primary btn-sm rounded-pill text-white px-4" href="/login">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Spacer for Fixed Navbar -->
    <div style="height: 100px;"></div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                <ul class="mb-0">@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif
        @yield('content')
    </div>

</body>
</html>