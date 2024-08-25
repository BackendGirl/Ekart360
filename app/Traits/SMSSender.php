<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\SMSSetting;
use Twilio\Rest\Client;
use Exception;

trait SMSSender {

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
    public function nexmo($message, $recipients)
    {
        $sms = SMSSetting::first();

        $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY", $sms->nexmo_key), getenv("NEXMO_SECRET", $sms->nexmo_secret));

        $client = new \Nexmo\Client($basic);

        if($client == true){
        $message = $client->message()->send([
            'to' => $recipients,
            'from' => $sms->nexmo_sender_name,
            'text' => $message
        ]);
        }
    }

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
    public function twilio($message, $recipients)
    {
        $sms = SMSSetting::first();

        $account_sid = getenv("TWILIO_SID", $sms->twilio_sid);
        $auth_token = getenv("TWILIO_AUTH_TOKEN", $sms->twilio_auth_token);
        $twilio_number = getenv("TWILIO_NUMBER", $sms->twilio_number);

        $client = new Client($account_sid, $auth_token);

        if($client == true){
        $client->messages->create($recipients, 
                [
                    'from' => $twilio_number, 
                    'body' => $message
                ]);
        }
    }

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
    public function sender($message, $recipients)
    {
        $sms = SMSSetting::first();

        if($sms->status == 1){

            $account_sid = getenv("TWILIO_SID", $sms->twilio_sid);
            $auth_token = getenv("TWILIO_AUTH_TOKEN", $sms->twilio_auth_token);
            $twilio_number = getenv("TWILIO_NUMBER", $sms->twilio_number);

            $client = new Client($account_sid, $auth_token);

            if($client == true){
            $client->messages->create($recipients, 
                    [
                        'from' => $twilio_number, 
                        'body' => $message
                    ]);
            }
        }
        elseif($sms->status == 2){

            $basic  = new \Nexmo\Client\Credentials\Basic(getenv("NEXMO_KEY", $sms->nexmo_key), getenv("NEXMO_SECRET", $sms->nexmo_secret));

            $client = new \Nexmo\Client($basic);

            if($client == true){
            $message = $client->message()->send([
                'to' => $recipients,
                'from' => $sms->nexmo_sender_name,
                'text' => $message
            ]);
            }
        }
    }
}