<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\FileUpload\FacebookVideo;

class Facebook extends Controller
{
    private $fb;
    private $access_token;
    private $pages = [];

    public function __construct()
    {
        if(!isset($_SESSION['token'])) session_start();
        $this->fb = new \Facebook\Facebook([
                'app_id' => '494950387628148',
                'app_secret' => 'cb5b04c854e767a269b1dfd1774c5b2b',
                'default_graph_version' => 'v2.10',
                'default_access_token' => 'EAAHCJ54JOHQBAJLzKJHsy3dh2dGxnw9ZB05Inc1lOjYbZApWeeClDQJo072c547lPJ4ehIVfJcZBSAfp1goAWqHZCHdUwmOvtFf350mVFwBCcjQSgBtXeBDl5CEXPm1MbZC6MaXcx5TLcnVKfXjoKZBuUZAWwWCYSAgQKZCd8gjLvgZDZD', // optional
            ]);
        $this->access_token = 'EAAHCJ54JOHQBAJLzKJHsy3dh2dGxnw9ZB05Inc1lOjYbZApWeeClDQJo072c547lPJ4ehIVfJcZBSAfp1goAWqHZCHdUwmOvtFf350mVFwBCcjQSgBtXeBDl5CEXPm1MbZC6MaXcx5TLcnVKfXjoKZBuUZAWwWCYSAgQKZCd8gjLvgZDZD';
        if(isset($this->access_token)){

            $res =  $this->fb->get('/me/accounts', $this->access_token);
            $res =  $res->getDecodedBody();
//            $i=0;
            foreach ($res['data'] as $page){
                $this->pages[] = [$page['name'], $page['access_token'], $page['id']];
//                echo $i."|".$page['name']." -- ".$page['access_token']." -- ".$page['id']."\n";
//                $i++;
            }

        }
    }

    public function makePost($pageId){
        $page = $this->pages[$pageId];
        $data = ['message' => 'Testing Post for our new tutorial. Graph API.'];

        $this->fb->post($page[2].'/feed/', $data,	$page[1]);
    }
    public function makePostVideo($pageId,$videoId){
        $page = $this->pages[$pageId];
        // Upload a video for a user

        $videoFile = "public\\video\\$videoId.mp4";
//        var_dump($this->fb->videoToUpload($videoFile));
        $data = [
            'title' => 'My awesome video',
            'description' => 'More info about my awesome video.',
            'source' => $this->fb->videoToUpload($videoFile),
        ];
//
        try {
            $response = $this->fb->post($page[2].'/videos', $data,	$page[1]);
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Error: ' . $e->getMessage();
            exit;
        }
        $graphNode = $response->getGraphNode();

        $videoId = $graphNode['id'];
    }
}
