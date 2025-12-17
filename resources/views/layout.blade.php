<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking System</title>
    
    <!-- Fonts: Outfit (Modern, Clean) -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            /* Premium Color Palette */
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.4);
            --shadow-soft: 0 10px 40px -10px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: #f3f4f6;
            /* Subtle Mesh Gradient Background */
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.15) 0px, transparent 50%);
            background-attachment: fixed;
            min-height: 100vh;
        }

        /* Glassmorphism Navbar */
        .navbar-glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
        }

        /* Modern Card Styling */
        .card-modern {
            background: white;
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px -12px rgba(0,0,0,0.15);
        }

        /* Typography & Utilities */
        .text-gradient {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }

        .btn-gradient {
            background: var(--primary-gradient);
            border: none;
            color: white;
            transition: opacity 0.2s;
        }
        .btn-gradient:hover {
            opacity: 0.9;
            color: white;
        }

        /* Animations */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Form Inputs */
        .form-control, .form-select {
            background-color: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            background-color: white;
            border-color: #818cf8;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-glass fixed-top py-3">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="rounded-circle bg-primary bg-gradient p-2 text-white d-flex justify-content-center align-items-center" style="width: 35px; height: 35px;">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <span class="fs-5 fw-bold text-dark">Luxe<span class="text-primary">Book</span></span>
            </a>
            
            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menu Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    
                    @if(session('user_id'))
                        <!-- LOGGED IN USER -->
                        <li class="nav-item text-muted small fw-medium">
                            Hello, {{ session('name') }}
                        </li>

                        @if(session('role') == 'client')
                            <!-- Client Links -->
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('book') ? 'text-primary fw-bold' : '' }}" href="/book">Book</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('my-appointments') ? 'text-primary fw-bold' : '' }}" href="/my-appointments">History</a>
                            </li>
                        @else
                            <!-- Staff Links -->
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('appointments') ? 'text-primary fw-bold' : '' }}" href="/appointments">Dashboard</a>
                            </li>
                            
                            <!-- ADMIN ONLY Link (New Feature) -->
                            @if(session('role') == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/users') ? 'text-primary fw-bold' : '' }}" href="/admin/users">Manage Users</a>
                                </li>
                            @endif
                        @endif

                        <!-- Logout Button -->
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm rounded-pill px-4 fw-medium">Logout</button>
                            </form>
                        </li>

                    @else
                        <!-- GUEST USER -->
                        <li class="nav-item">
                            <a class="btn btn-gradient rounded-pill px-4 shadow-sm fw-medium" href="/login">Sign In</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Spacer to prevent content hiding behind fixed navbar -->
    <div style="height: 100px;"></div>

    <!-- Main Content Area -->
    <div class="container pb-5">
        
        <!-- Global Success Message -->
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 fade-in-up d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Global Error Message -->
        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 fade-in-up">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Content Injected Here -->
        @yield('content')
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>