<?php

namespace Database\Seeders;

use App\Models\{Customer, Lead};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $approvedLeads = Lead::where('status', 'approved')->count();

        for ($i = 1; $i <= 150; $i++) {
            Customer::create([
                'lead_id' => rand(1, $approvedLeads),
                'product_id' => rand(1, 1000),
            ]);
        }
    }
}
