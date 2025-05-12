<?php

namespace App\Listeners;

use App\Events\PlaceCreated;
use App\Events\SaleCreated;
use App\Models\DeviceToken;
use App\Services\FirebaseServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;


class SendNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PlaceCreated|SaleCreated $event): void
    {
       $tokens=DeviceToken::pluck('token')->toArray();
       $title=$event->title;
       $body=$event->body;
       $data=$event->data;
        // Send to all users
       $firebase=new FirebaseServices();
       $firebase->sendNotification($tokens,$title,$body,$data);
     


    }
    
}
