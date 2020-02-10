<?php

namespace App\Notifications;
use App\Book;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;

class ApproveNotification extends Notification
{
    use Queueable;
protected $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $id, Book $product)

     {
        $this->owner_id = $id->id;
        $this->product = $product->title;


    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'data'=>'request is approved',
            'title' => $this->product,
            'user_name' => auth::user()->name,
            'user_id' => auth::user()->id,


        ];
    }   
     public function toArray($notifiable)
    {
        return [
            //
        ];
    }


}
 