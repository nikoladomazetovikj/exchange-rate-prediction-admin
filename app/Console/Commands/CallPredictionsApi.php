<?php

namespace App\Console\Commands;

use App\Models\Prediction;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

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
            $response = $client->request('GET', env('PREDICTION_API_URL'));

            if ($response->getStatusCode() === 200) {
                $body = $response->getBody()->getContents();
                $data = json_decode($body, true);
                $predictions = $data['predictions'];
                $dates = $this->getNextWeekDates();
                foreach ($predictions[0] as $index => $prediction) {
                    $date = $dates[$index];
                    Prediction::where('date', $date)->delete();
                    Prediction::create([
                        'rate' => $prediction,
                        'date' => $date,
                    ]);
                }
            } else {
                $this->error('Failed to fetch predictions. Status code: '.$response->getStatusCode());
            }
        } catch (\Exception $e) {
            $this->error('Error calling predictions API: '.$e->getMessage());
        }

    }

    private function getNextWeekDates(): array
    {
        $dates = [];
        $start = Carbon::now()->startOfWeek();
        for ($i = 0; $i < 7; $i++) {
            $dates[] = $start->copy()->addDays($i)->toDateString();
        }

        return $dates;
    }
}
