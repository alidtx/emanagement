<?php

namespace App\Observers;

use App\Models\UserCourseEnroll;
use App\Services\FcmService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;

class CourseEnrollmentObserver
{
    public function created(UserCourseEnroll $userCourseEnroll)
    {
        $message = [

            "subject"              => "You have purchased {$userCourseEnroll->course->title}.Now you are eligible to continue this course",
            "type"                 => "Course Enrollment Notification : {$userCourseEnroll->course->title}",
            "profile_photo"        => null,
            "url"                  => route("orders.show",$userCourseEnroll->order_id)
        ];

        $data = [
            'type' => "COURSE_DETAIL",
            'id' => $userCourseEnroll->course_id
        ];

        try {
            Log::info("Course Enrollment Notification");

            (new NotificationService)->notify([$userCourseEnroll->user_id], $message);
            $fcm_token = $userCourseEnroll->user->fcm_token ?? null;
            if ($fcm_token) {
                (new FcmService)->send([$fcm_token], $message["type"], $message["subject"], true, $data);
            } else {
                Log::error("FCM Token invalid");
            }
        } catch (\Exception $e) {
            Log::error("FCM Token exception :" . $e->getMessage());
        }
    }
}
