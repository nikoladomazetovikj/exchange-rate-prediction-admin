<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CallPredictionsApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:call-predictions-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calls the prediction endpoint';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new Client();

        try {

            $response = $client->request('GET', env("PREDICTION_API_URL"));

            if ($response->getStatusCode() === 200) {
                $body = $response->getBody()->getContents();
                $data = json_decode($body, true);
                $predictions = $data['predictions'];
                Log::info('predictions', ['predictions' => $predictions]);
                return $predictions;
            } else {
                Log::error($response->getStatusCode());
                $this->error('Failed to fetch predictions. Status code: ' . $response->getStatusCode());
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->error('Error calling predictions API: ' . $e->getMessage());
        }

    }
}
