<?php

namespace Database\Seeders;

use App\Models\Letter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Letter::factory(30)->create();
    }
}
