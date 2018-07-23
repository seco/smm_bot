<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

\InstagramAPI\Utils::$ffprobeBin = 'c:/ffmpeg/bin/ffprobe';
\InstagramAPI\Media\Video\FFmpeg::$defaultBinary = 'c:/ffmpeg/bin/ffmpeg';

class Instagram extends Controller
{
    private $ig;
    private $login = '4tests4';
    private $pass = '4tests';

    public function __construct()
    {
        $this->ig = new \InstagramAPI\Instagram(true, true, [
            'storage'    => 'mysql',
            'dbhost'     => 'novati01.mysql.tools',
            'dbname'     => 'novati01_smmig',
            'dbusername' => 'novati01_smmig',
            'dbpassword' => 'xgxbfm3p',
        ]);
    }

    public function login(){
        return $this->ig->login($this->login,$this->pass);
    }
    public function makePost($id){
        $metadata = [
            'hashtags' => [
                // Note that you can add more than one hashtag in this array.
                [
                    'tag_name'         => 'test', // NOTE: This hashtag MUST appear in the caption (it does NOT include the '#' here).
                    'x'                => 0.5, // Range: 0.0 - 1.0
                    'y'                => 0.5, // Note that x = 0.5 and y = 0.5 is center of screen.
//                    'width'            => 0.24305555, // Percentage: 0.0 - 1.0
//                    'height'           => 0.07347973, // Percentage: 0.0 - 1.0
                    'rotation'         => 0.0,
                    'is_sticker'       => false, // Don't change this value.
                    'use_custom_title' => false, // Don't change this value.
                ],
                // ...
            ],
            'caption' => "Test post\n\n#test#if",
        ];
        $videoFile = "public\\video\\$id.mp4";

        echo $this->ig->timeline->uploadVideo($videoFile, $metadata);

    }
    public function getIdByName($userName){
        return $this->ig->people->getUserIdForName($userName);
    }
    public function getNameById($userId){
        $response = $this->ig->people->getInfoById($userId);
        return $response->getUser()->getUsername();
    }
}
