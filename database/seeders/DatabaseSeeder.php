<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Frontliner;
use App\Models\Generation;
use App\Models\Labscategory;
use App\Models\Openproject;
use App\Models\Post;
use App\Models\Repositorylabs;
use App\Models\Websiteconfiguration;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'ACES UMN',
            'username' => 'aces_umn',
            'email' => 'aces@umn.ac.id',
            'password' => bcrypt('pintu123'),
            'isadmin' => true
        ]);

        User::create([
            'name' => 'Matthew Brandon Dani',
            'username' => 'matthewbd',
            'email' => 'brandondani33@gmail.com',
            'password' => bcrypt('pintu123')
        ]);

        Category::create([
            'name' => 'Program Kerja',
            'slug' => 'program-kerja'
        ]);

        Category::create([
            'name' => 'Akademik',
            'slug' => 'akademik'
        ]);

        Labscategory::create([
            'name' => 'DevSecOps',
            'slug' => 'devsecops'
        ]);
        
        Labscategory::create([
            'name' => 'Backend Web Development',
            'slug' => 'backend-web-development'
        ]);

        Generation::create([
            'name' => 'ACES Generation 12',
            'periode' => '2021 - 2022',
            'visi' => 'Menjadikan ACES sebagai himpunan yang aktif berkontribusi dan responsif bagi anggota, almamater, dan masyarakat.',
            'misi' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo assumenda quae dolorem voluptates iusto?',
            'slug' => 'aces-generation-12'
        ]);

        Post::factory(15)->create();

        Openproject::factory(6)->create();
        
        Repositorylabs::factory(6)->create();

        Frontliner::factory(6)->create();

        Websiteconfiguration::create([
            'instagram' => 'acesumn',
            'twitter' => 'acesumn',
            'facebook' => 'himasikom',
            'email' => 'aces@umn.ac.id',
            'header_hero' => 'ASSOCIATION OF COMPUTER ENGINEERING STUDENTS',
            'announcement_title' => 'Perprod Teknik Komputer 2022: Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, voluptas.',
            'announcement_link' => 'https://aces.umn.ac.id/go/instagram',
            'generation_slug' => 'aces-generation-12'
        ]);
    }
}
