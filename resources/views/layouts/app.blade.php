<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kevin Setiawan | Portfolio</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="cursor"></div>
    <div class="cursor2"></div>

    <header class="header">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="logo">Kevin<span>.dev</span></a>
            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#skills">Skills</a></li>
                    <li><a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">Projects</a></li>
                    <li><a href="#contact" class="btn btn-primary">Contact Me</a></li>
                </ul>
                <div class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; {{ date('Y') }} Kevin Setiawan. All rights reserved.</p>
                <div class="social-links">
                    <a href="https://github.com" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/kevin-imanuel-setiawan-5b9a46295/" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://instagram.com/kevinnstwn" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/vanilla-tilt.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
