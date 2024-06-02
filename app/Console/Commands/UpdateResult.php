<?php

namespace App\Console\Commands;

use App\Models\Market;
use App\Models\MatkaResult;
use App\Models\MatkaTemp;
use App\Models\RefreshToken;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Define the API endpoint
        $apiUrl = 'https://matkawebhook.matka-api.online/market-data';
        
        $token = RefreshToken::first();
        // Form data to be sent in the POST request
        $formData = [
            'username' => '9752122747',
            'API_token' => $token->token,
            'markte_name' => '',
            'date' => Carbon::now()->format('Y-m-d'),  
        ];

        try {
            $response = Http::asForm()->post($apiUrl, $formData);
            if ($response->successful()) {
                $data = $response->json();
                Log::info($data);
                $refreshtoken =RefreshToken::first();
                $refreshtoken->token=$data['refresh_token'];
                $refreshtoken->save();
                foreach ($data['old_result'] as $item) {
                   $oldresult = MatkaResult::where('market_name',$item['market_name'])->where('aankdo_date',$item['aankdo_date'])->first();
                    if($oldresult){
                        $matka_result = MatkaResult::where('market_name',$item['market_name'])->where('aankdo_date',$item['aankdo_date'])->first();
                    }else{
                        $matka_result = new MatkaResult;
                    }
                    $matka_result->market_id = $item['market_id'];
                    $matka_result->aankdo_date = $item['aankdo_date'];
                    $matka_result->aankdo_open = $item['aankdo_open'];
                    $matka_result->aankdo_close = $item['aankdo_close'];
                    $matka_result->figure_open = $item['figure_open'];
                    $matka_result->figure_close = $item['figure_close'];
                    $matka_result->jodi = $item['jodi'];
                    $matka_result->updated_at = now();
                    $matka_result->market_id = $item['market_id'];
                    $matka_result->market_id = $item['market_id'];
                    $matka_result->market_id = $item['market_id'];
                    $matka_result->save(); 
                }
                $this->info('Database updated successfully.');
            } else {
                $this->error('Failed to fetch data from the API. Status: ' . $response->status());
            }

        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
