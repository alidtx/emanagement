<?php

namespace App\Observers;

use App\Models\ExamScore;
use App\Services\FcmService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;

class ExamScoreObserver
{
    public function updated(ExamScore $examScore)
    {       

        $message = [
            "type"                 => "Written Exam Result Notification",
            "subject"              => "Your written exam result score is $examScore->score.",
            "profile_photo"        => null,
            "url"                  => null
        ];
        
        $data = [
            'type' => "COURSE_DETAIL",
            'id' => $examScore->exam->courseExam->course_id
        ];
        (new NotificationService)->notify([$examScore->user_id],$message);
        if($examScore->user->fcm_token){
            (new FcmService)->send([$examScore->user->fcm_token],$message["type"],$message["subject"],true,$data);
        }
    }
}
