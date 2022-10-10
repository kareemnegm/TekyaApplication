<?php
namespace App\Services;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class FcmCloudMessage
{
    /**
     * Handle the FCM Cloud Message Notfication "creating" event.
     *
     * 
     * @return object
     */
    public function sendMessageViaFcm($title,$message,$fcmTokens)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($message)
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
   
         FCM::sendTo($fcmTokens, $option, $notification, $data);
    }
}


