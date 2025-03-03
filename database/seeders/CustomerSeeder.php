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
        $approvedLeads = Lead::where('status', 'approved')->get();

        foreach ($approvedLeads as $lead) {
            for ($i = 1; $i <= 5; $i++) {
                Customer::create([
                    'lead_id' => $lead->id,
                    'product_id' => rand(1, 1000),
                ]);
            }
        }
    }
}
