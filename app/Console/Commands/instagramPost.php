<?php

namespace App\Console\Commands;

use App\Http\Controllers\Instagram;
use Illuminate\Console\Command;

class instagramPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ig:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instagram post command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->ig = new Instagram();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->ig->login();
        $this->ig->makePost(3);
    }
}
