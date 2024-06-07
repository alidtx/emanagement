<?php

namespace App\Services;

use App\Models\File;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TelegramService
{

    
    public function TelegramBot($employe, $sdate, $edate, $link) {
    
        $apiToken = "6849169381:AAEEZBTTAU5NVl2ZfEWGjkWQH88TGsfPPu4";
        $text = "this is Ali's birthday Employee: $employe, Start Date: $sdate, End Date: $edate, link: $link";
        $data = [
            'chat_id' => '@alidtx',
            'text' =>  $text  
        ];
        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
    
      }


    public function automaticMs() {
        $apiToken = "6849169381:AAEEZBTTAU5NVl2ZfEWGjkWQH88TGsfPPu4";
        $text = "Please Make payment";
        $data = [
            'chat_id' => '@alidtx',
            'text' =>  $text  
        ];
        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
    

    }  




}