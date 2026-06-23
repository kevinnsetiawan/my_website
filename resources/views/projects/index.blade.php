@extends('layouts.app')

@section('content')
    <section class="hero" style="min-height: 40vh; padding-top: 120px; padding-bottom: 2rem;">
        <div class="container" style="text-align: center;">
            <h1 class="hero-title" style="font-size: 3rem;">All Projects</h1>
            <p class="hero-desc">A collection of projects I've worked on.</p>
        </div>
    </section>

    <section id="projects" style="padding-top: 2rem;">
        <div class="container">
            <div class="card-grid">
                @forelse($projects as $project)
                <div class="card">
                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">{{ $project->title }}</h3>
                    <p style="color: var(--text-muted); margin-bottom: 1rem;">{{ Str::limit($project->description, 100) }}</p>
                    <div class="tech-stack" style="margin-bottom: 1.5rem; font-size: 0.9rem; color: var(--primary);">
                        {{ $project->tech_stack }}
                    </div>
                    <a href="{{ $project->url ?? '#' }}" class="btn btn-outline" style="font-size: 0.9rem; padding: 0.5rem 1rem;">Visit Project</a>
                </div>
                @empty
                <div class="card" style="grid-column: 1 / -1; text-align: center;">
                    <p>No projects found yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
