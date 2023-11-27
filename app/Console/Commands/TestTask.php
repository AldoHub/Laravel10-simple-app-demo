<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

//storage
use Illuminate\Support\Facades\Storage;

class TestTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-task';

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
        //
        $text = date('Y-m-d H:i:s'). " : This is a simple schedule task";
        //add the text into a new file
        Storage::append("archivo.txt", $text);
    }
}
