@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-subtitle">Hi, I'm <span class="typing-text"></span></p>
                <h1 class="hero-title">Building Digital <br> Experiences</h1>
                <p class="hero-desc">
                    Saya seorang mahasiswa IT di Telkom University Surabaya.
                    Saya bersemangat dalam membangun pengalaman digital yang luar biasa dan produk yang bermanfaat.
                </p>
                <div class="hero-btns">
                    <a href="#projects" class="btn btn-primary">View Work</a>
                    <a href="#contact" class="btn btn-outline">Contact Me</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="reveal">
        <div class="container">
            <h2 class="section-title">About Me</h2>
            <div class="about-content" style="display: flex; gap: 3rem; align-items: center; justify-content: center;">
                <div class="about-text" style="max-width: 600px; text-align: center; color: var(--text-muted);">
                    <p style="margin-bottom: 1rem;">
                        Hello! My name is Kevin and I enjoy creating things that live on the internet. 
                        My interest in web development started back when I decided to try editing custom Tumblr themes — 
                        turns out hacking together HTML & CSS is pretty fun!
                    </p>
                    <p>
                        Fast-forward to today, and I've had the privilege of working on various projects. 
                        My main focus these days is building accessible, inclusive products and digital experiences 
                        for a variety of clients.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Organization Section -->
    <section id="organization" class="reveal">
        <div class="container">
            <h2 class="section-title">Organizational History</h2>
            <div class="card-grid">
                <!-- Org 3 (Current) -->
                <div class="card">
                    <div style="color: var(--primary); font-size: 1.2rem; margin-bottom: 0.5rem;">Sekarang</div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Ketua Umum</h3>
                    <p style="color: var(--text-muted); font-weight: 600; margin-bottom: 1rem;">Unit Kerohanian Kristen Telkom University Surabaya</p>
                    <p style="color: var(--text-muted);">Memimpin organisasi kerohanian, mengkoordinir pengurus, dan bertanggung jawab atas seluruh kegiatan dan visi misi unit.</p>
                </div>
                
                <!-- Org 2 -->
                <div class="card">
                    <div style="color: var(--primary); font-size: 1.2rem; margin-bottom: 0.5rem;">2025 - 2026</div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Staff Kementrian Agama</h3>
                    <p style="color: var(--text-muted); font-weight: 600; margin-bottom: 1rem;">BEM Telkom University Surabaya</p>
                    <p style="color: var(--text-muted);">Bertanggung jawab dalam memfasilitasi kegiatan keagamaan mahasiswa dan menjaga kerukunan antar umat beragama di lingkungan kampus.</p>
                </div>

                <!-- Org 1 -->
                <div class="card">
                    <div style="color: var(--primary); font-size: 1.2rem; margin-bottom: 0.5rem;">2024 - 2025</div>
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Staff Kementrian Luar Negri</h3>
                    <p style="color: var(--text-muted); font-weight: 600; margin-bottom: 1rem;">BEM Telkom University Surabaya</p>
                    <p style="color: var(--text-muted);">Menjalin hubungan eksternal BEM dengan institusi lain, serta mengelola program kerja yang berkaitan dengan kolaborasi dan diplomasi mahasiswa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="reveal">
        <div class="container">
            <h2 class="section-title">Education History</h2>
            <div class="card-grid">
                <!-- University -->
                <div class="card">
                    <i class="fas fa-graduation-cap" style="font-size: 2rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Telkom University Surabaya</h3>
                    <p style="color: var(--text-muted); font-weight: 600;">Sarjana (S1)</p>
                    <p style="color: var(--text-muted);">Sekarang</p>
                </div>

                <!-- High School -->
                <div class="card">
                    <i class="fas fa-school" style="font-size: 2rem; color: var(--secondary); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">SMAK Setia Bakti Ruteng</h3>
                    <p style="color: var(--text-muted); font-weight: 600;">Sekolah Menengah Atas</p>
                </div>

                <!-- Middle School -->
                <div class="card">
                    <i class="fas fa-book-reader" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">SMPK Immaculata Ruteng</h3>
                    <p style="color: var(--text-muted); font-weight: 600;">Sekolah Menengah Pertama</p>
                </div>

                <!-- Elementary School -->
                <div class="card">
                    <i class="fas fa-child" style="font-size: 2rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">SDK Ruteng 5</h3>
                    <p style="color: var(--text-muted); font-weight: 600;">Sekolah Dasar</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="reveal" style="background: rgba(255,255,255,0.02);">
        <div class="container">
            <h2 class="section-title">Technological Skills</h2>
            <div class="skills-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 2rem; text-align: center;">
                <div class="skill-card card">
                    <i class="fab fa-html5" style="font-size: 3rem; color: #e34c26; margin-bottom: 1rem;"></i>
                    <h3>HTML5</h3>
                </div>
                <div class="skill-card card">
                    <i class="fab fa-css3-alt" style="font-size: 3rem; color: #264de4; margin-bottom: 1rem;"></i>
                    <h3>CSS3</h3>
                </div>
                <div class="skill-card card">
                    <i class="fab fa-js" style="font-size: 3rem; color: #f0db4f; margin-bottom: 1rem;"></i>
                    <h3>JavaScript</h3>
                </div>
                <div class="skill-card card">
                    <i class="fab fa-php" style="font-size: 3rem; color: #8993be; margin-bottom: 1rem;"></i>
                    <h3>PHP</h3>
                </div>
                <div class="skill-card card">
                    <i class="fab fa-laravel" style="font-size: 3rem; color: #ff2d20; margin-bottom: 1rem;"></i>
                    <h3>Laravel</h3>
                </div>
                <div class="skill-card card">
                    <i class="fas fa-database" style="font-size: 3rem; color: #00758f; margin-bottom: 1rem;"></i>
                    <h3>MySQL</h3>
                </div>
                <!-- Data Analyst Skills -->
                <div class="skill-card card">
                    <i class="fas fa-code" style="font-size: 3rem; color: #e34c26; margin-bottom: 1rem;"></i>
                    <h3>Web Development</h3>
                </div>
                <!-- Mobile Developer Skills -->
                <div class="skill-card card">
                    <i class="fas fa-mobile-alt" style="font-size: 3rem; color: #a4ce3a; margin-bottom: 1rem;"></i>
                    <h3>Mobile Development</h3>
                </div>
                <div class="skill-card card">
                    <i class="fab fa-android" style="font-size: 3rem; color: #3ddc84; margin-bottom: 1rem;"></i>
                    <h3>Android</h3>
                </div>
                <div class="skill-card card">
                    <i class="fas fa-bolt" style="font-size: 3rem; color: #42a5f5; margin-bottom: 1rem;"></i>
                    <h3>Flutter</h3>
                </div>
                <div class="skill-card card">
                    <i class="fab fa-python" style="font-size: 3rem; color: #3776ab; margin-bottom: 1rem;"></i>
                    <h3>Python</h3>
                </div>
                <div class="skill-card card">
                    <i class="fas fa-chart-line" style="font-size: 3rem; color: #2ecc71; margin-bottom: 1rem;"></i>
                    <h3>Data Analysis</h3>
                </div>
                <div class="skill-card card">
                    <h3>R Language</h3>
                </div>
                <div class="skill-card card">
                    <i class="fas fa-code" style="font-size: 3rem; color: #555555; margin-bottom: 1rem;"></i>
                    <h3>C</h3>
                </div>
                <div class="skill-card card">
                    <i class="fas fa-code" style="font-size: 3rem; color: #00599C; margin-bottom: 1rem;"></i>
                    <h3>C++</h3>
                </div>
                <div class="skill-card card">
                    <i class="fab fa-golang" style="font-size: 3rem; color: #00ADD8; margin-bottom: 1rem;"></i>
                    <h3>Golang</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects Preview (Static for now, dynamic later) -->
    <section id="projects" class="reveal">
        <div class="container">
            <h2 class="section-title">Some Things I've Built</h2>
            <div class="card-grid">
                @forelse($projects as $project)
                <div class="card">
                     <!-- Image placeholder -->
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">{{ $project->title }}</h3>
                    <p style="color: var(--text-muted); margin-bottom: 1rem;">{{ Str::limit($project->description, 100) }}</p>
                    <div class="tech-stack" style="margin-bottom: 1.5rem; font-size: 0.9rem; color: var(--primary);">
                        {{ $project->tech_stack }}
                    </div>
                    <a href="{{ $project->url ?? '#' }}" class="btn btn-outline" style="font-size: 0.9rem; padding: 0.5rem 1rem;">Visit Project</a>
                </div>
                @empty
                <div class="card" style="grid-column: 1 / -1; text-align: center;">
                    <p>No projects found yet. (Seed the database!)</p>
                </div>
                @endforelse
            </div>
            <div style="text-align: center; margin-top: 3rem;">
                <a href="{{ route('projects.index') }}" class="btn btn-primary">View All Projects</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="reveal">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                
                <!-- Email -->
                <a href="mailto:setiawankevin530@gmail.com" class="card" style="text-decoration: none; text-align: center;">
                    <i class="fas fa-envelope" style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Email</h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">setiawankevin530@gmail.com</p>
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/6282236039191" target="_blank" class="card" style="text-decoration: none; text-align: center;">
                    <i class="fab fa-whatsapp" style="font-size: 2.5rem; color: #25D366; margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">WhatsApp / HP</h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">+62 822-3603-9191</p>
                </a>

                <!-- Instagram -->
                <a href="https://instagram.com/kevinnstwn" target="_blank" class="card" style="text-decoration: none; text-align: center;">
                    <i class="fab fa-instagram" style="font-size: 2.5rem; color: #E1306C; margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">Instagram</h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">@kevinnstwn</p>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/in/kevin-imanuel-setiawan-5b9a46295/" target="_blank" class="card" style="text-decoration: none; text-align: center;"> <!-- Assuming URL based on name, can be adjusted -->
                    <i class="fab fa-linkedin" style="font-size: 2.5rem; color: #0077B5; margin-bottom: 1rem;"></i>
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.5rem;">LinkedIn</h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Kevin Imanuel Setiawan</p>
                </a>

            </div>
        </div>
    </section>
@endsection
