<?php

namespace Database\Seeders;

use App\Models\{Lead, Project, User};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $approvedLeads = Lead::where('status', 'approved')->count();

        for ($i = 1; $i <= 250; $i++) {
            Project::create([
                'lead_id' => rand(1, $approvedLeads),
                'user_id' => rand(2, 11),
                'name' => fake()->unique()->company(),
                'description' => fake()->paragraph(),
                'status' => ['pending', 'approved', 'rejected'][rand(0, 2)],
            ]);
        }
    }
}
