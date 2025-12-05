<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Bar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create sample bars. Materials are inserted in the materials migration,
        // so pick random existing material IDs when generating bars.
        Bar::factory()->count(50)->create();
    }
}
