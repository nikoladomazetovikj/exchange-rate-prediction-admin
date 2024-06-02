<?php

namespace Database\Seeders;

use App\Models\Prediction;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PredictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new Client();

        $client->request('GET', env('PREDICTION_SEED_API_URL'));

    }
}
