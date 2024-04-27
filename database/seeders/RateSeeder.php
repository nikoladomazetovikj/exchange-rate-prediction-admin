<?php

namespace Database\Seeders;

use App\Imports\RateImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new RateImport, storage_path('app/KursnaLista.xlsx'));
    }
}
