<?php

namespace App\Jobs;

use App\Models\DeviceToken;
use App\Models\Sale;
use App\Services\FirebaseServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class SendSaleReminderJob implements ShouldQueue
{
    use Queueable,Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Sale $sale)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(FirebaseServices $firebase): void
    {
        $title = 'Hurry up!';
        $body = "Only 2 days left for the offer at {$this->sale->place->name}";
        $data = ['sale_id' => $this->sale->id,
        'place_name' => $this->sale->place->name,
        'place_id'=>$this->sale->place->id];
        $tokens=DeviceToken::pluck('token')->toArray();
        
        $firebase->sendNotification($tokens,$title,$body,$data);

    }
}
