<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Project::truncate();





        \App\Models\Project::create([
            'title' => 'Portfolio Website',
            'description' => 'A personal portfolio website associated with this project. Designed with a premium look using Vanilla CSS and Laravel.',
            'image' => null,
            'url' => '#',
            'tech_stack' => 'Laravel, Blade, Vanilla CSS'
        ]);

        \App\Models\Project::create([
            'title' => 'Web Absensi SMP GIKI 2 Surabaya',
            'description' => 'Bertindak sebagai Project Manager dalam pembuatan sistem absensi berbasis web untuk SMP GIKI 2 Surabaya. Mengelola tim dan memastikan fitur berjalan sesuai kebutuhan sekolah.',
            'image' => null,
            'url' => 'https://github.com/kevinnsetiawan/Web_Absensi',
            'tech_stack' => 'Project Management, Web Development'
        ]);

        \App\Models\Project::create([
            'title' => 'Sentiment Analysis Goto',
            'description' => 'Menganalisis sentimen publik terhadap ekosistem Goto (Gojek & Tokopedia). Menggunakan teknik NLP untuk mengklasifikasikan ulasan pengguna menjadi positif, negatif, atau netral.',
            'image' => null,
            'url' => 'https://github.com/kevinnsetiawan/GoTo_Sentiment_Analysis',
            'tech_stack' => 'Python, NLP, Machine Learning'
        ]);
        \App\Models\Project::create([
            'title' => 'Restaurant Order App',
            'description' => 'A mobile application for managing restaurant orders, designed to streamline the ordering process and improve customer service efficiency.',
            'image' => null,
            'url' => 'https://github.com/kevinnsetiawan/Restorant_Order_App',
            'tech_stack' => 'Mobile Development, Android'
        ]);
    }
}
