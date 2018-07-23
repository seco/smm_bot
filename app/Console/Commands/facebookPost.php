<?php

namespace App\Console\Commands;

use App\Http\Controllers\Facebook;
use Illuminate\Console\Command;

class instagramPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Facebook post command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->fb = new Facebook();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->fb->makePostVideo(2,3);
    }
}
