<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class worldDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('TRUNCATE TABLE countrylanguages CASCADE');
        DB::statement('TRUNCATE TABLE cities CASCADE');
        DB::statement('TRUNCATE TABLE countries CASCADE');

        $sqlPath = database_path('sql/World.sql');
        $sql = file_get_contents($sqlPath);
        DB::unprepared($sql);
    }
}
