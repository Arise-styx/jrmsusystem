<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchases;

class PurchasesSeeder extends Seeder
{
    public function run()
    {
        // Using the factory to create 20 instances of the 'Purchase' model
        Purchases::factory(20)->create();
    }
}

