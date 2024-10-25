<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create(['name' => 'Company Malta', 'bank_account' => 'MT12345678', 'vat_rate' => 18.00]);
        Company::create(['name' => 'Company Cyprus', 'bank_account' => 'BR98765431', 'vat_rate' => 20.00]);
        Company::create(['name' => 'Company Brazil', 'bank_account' => 'BR98765432', 'vat_rate' => 22.00]);
        Company::create(['name' => 'Company Dubai', 'bank_account' => 'AE54321678', 'vat_rate' => 5.00]);
    }
}
