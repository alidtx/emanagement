<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use App\Models\UserOtp;
use DB;
use Jenssegers\Agent\Agent;
use App\Notifications\SystemNotification;
use Carbon\Carbon;
use Notification;
use GuzzleHttp\Client;
use App\Models\Setting;

class Helper
{

    static function otp_send($phone, $type)
    {
        try {
            // $code = rand(99999, 10000);
            $code = 12345;

            // if ($phone == '01761864905') {
            //     $code = 12345;
            // }
            date_default_timezone_set('Asia/Dhaka');
            $current_time = time();
            $new_time = $current_time + 2.3 * 60;
            $expie_at = date('h:i:s', $new_time);
            $otp = new UserOtp;
            $otp->code = $code;
            //$otp->code = 12345;
            $otp->user_id = "";
            $otp->phone = $phone;
            $otp->type = $type;
            $otp->expire_at = $expie_at;
            $otp->created_at = date('Y-m-d h:i:s');
            $otp->save();
            Helper::sslSmsGetway($phone, $code);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            $response = [
                'code' => 422,
                'status' => "fail",
                'message' => $e->getMessage(),
            ];
            return $response;
        }
    }
    static function sslSmsGetway($phone, $code)
    {
        try {
            $message = "Dear customer, use this One Time Password " . $code . " to log in to your Legalizedbd account. This OTP will be valid for the next 2.30 mins.";
            $url = Setting::where("key", "sms_url")->first()->value ?? null;
            $data = [
                "api_token" => Setting::where("key", "sms_api_key")->first()->value ?? null,
                "sid" => Setting::where("key", "sms_sid")->first()->value ?? null,
                "csms_id" => time(),
                'sms' => $message,
                'msisdn' => $phone
            ];
            Log::info($url, $data);
            $sslCareClient = new Client([
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]);
            $response = $sslCareClient->request('POST', $url, ['form_params' => $data]);
            if ($response->getStatusCode() == 200) {

                $responseContent = json_decode($response->getBody()->getContents());
                //dd($responseContent);
                if ($responseContent->status_code == 200) {
                    return $responseContent;
                } else {
                    Log::error("SMS Sending faild in " . $phone);
                    Log::error(json_decode($response->getBody(), true));
                    return $responseContent;
                }
            } else {
                Log::error("SMS Sending faild. HTTP Status code" . $response->getStatusCode() . " in " . $phone);
                return null;
            }
        } catch (\Throwable $e) {
            Log::info($e->getMessage());
        }
    }
    static function concatUrl($field_name)
    {
        $concatUrl = DB::raw("CONCAT('" . url('storage/') . "/', $field_name) as $field_name");
        return $concatUrl;
    }

    public static function convertYoutubeUrlToID($field_name)
    {
        return DB::raw("SUBSTRING_INDEX(SUBSTRING_INDEX($field_name, 'v=', -1), '&', 1) as video_key");
    }

    public static function convertYoutubeUrlToEmbedUrl($field_name)
    {
        return  DB::raw("CONCAT('//www.youtube.com/embed/', SUBSTRING_INDEX(SUBSTRING_INDEX($field_name, 'v=', -1), '&', 1)) as video_url");
    }
    static function concatUrlFilePath($field_name)
    {
        $concatUrl = DB::raw("CONCAT('" . url('storage/') . "/', $field_name) as file_path");
        return $concatUrl;
    }

    static function sendSuccessResponse($result = [], $message = null)
    {
        $response = [
            'code' => 200,
            'status' => "success",
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
    static function sendErrorResponse($message, $errors = [], $code = 422)
    {
        $response = [
            'code' => $code,
            'status' => "fail",
            'message' => $message,
            'errors' => $errors
        ];

        return response()->json($response, $code);
    }

    public static function generateUniqueOrder()
    {
        $timestamp = now()->timestamp;
        $randomNumber = mt_rand(1000, 9999); // Generate a random 4-digit number

        return intval("{$timestamp}{$randomNumber}");
    }
    public static function adminNotification($users, $message)
    {
        Notification::send($users, new SystemNotification($message));
    }
    public static  function get_pagination_summary($data)
    {


        $total_item = $data->total();
        $item_per_page = $data->perPage();
        // $current_page = $data->currentPage();

        $pagination_summary = "Showing $item_per_page Records of $total_item";

        return $pagination_summary;
    }
}
