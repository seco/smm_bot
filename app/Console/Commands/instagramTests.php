<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\Instagram;

class instagramTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ig:t';

    private $ig;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instagram class functions tests';

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
//        $this->ig->login();
//        $this->ig->makePost(3);
//        $userId = $this->ig->getIdByName('4tests4');
//        echo $userId;
//        $userName = $this->ig->getNameById($userId);
//        echo $userName;
    }
}
