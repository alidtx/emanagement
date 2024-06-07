<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    // use MailMessage;

    public function __construct()
    {

    }

    public function getUsers($user_ids){
        return User::whereIn("id",$user_ids)->get(["id","email"]);
    }

    public function notifyUsers($users,$message){
        Notification::send($users, new SystemNotification($message));
    }

    public function findProfilePhoto($user_id){
        return User::where('id',$user_id)->select('profile_image')->first();
    }

    public function notify($recipientIds,$message){

        $users = $this->getUsers($recipientIds);

        $this->notifyUsers($users,$message);
    }   

}
