<?php

namespace App\Listeners;

use App\Events\TestEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
//storage
use Illuminate\Support\Facades\Storage;

class TestListener
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
    public function handle(TestEvent $event): void
    {

        //ddd($event);
        //
        //Do whatever is needed -- in this case create and update a new file for testing
        $eventText = "New Twxt added - : " . json_encode($event);
        //add the text into a new file
        Storage::append("listener.txt", $eventText);

    }
}
