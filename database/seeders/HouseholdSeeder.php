<?php

namespace Database\Seeders;

use App\Models\Household;
use Database\Factories\HouseholdFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Household::factory(100)->create();
    }
}
