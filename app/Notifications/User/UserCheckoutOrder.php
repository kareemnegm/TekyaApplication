<?php

namespace App\Notifications\User;

use App\Notifications\FirebaseChannel;
use App\Services\FcmCloudMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCheckoutOrder extends Notification implements ShouldQueue
{
    use Queueable;

    protected $title;
    protected $message;
    protected $fcmTokens;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title,$message,$fcmTokens)
    {

        $this->title = $title;
        $this->message = $message;
        $this->fcmTokens = $fcmTokens;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FirebaseChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\FireBaseeChannel
     */
    public function toFirebase($notifiable)
    {
        return (new FcmCloudMessage)
            ->sendMessageViaFcm($this->title, $this->message ,$this->fcmTokens);
        
    }


}
