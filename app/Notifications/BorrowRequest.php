<?php

namespace App\Notifications;

use App\Book;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BorrowRequest extends Notification
{
    use Queueable;
    public $id;
    public $product;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $id, Book $product)
    {
        $this->owner_id = $id->id;
        $this->product = $product->title;
        $this->product_id=$product->id;
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
            'title' => $this->product,
            'product_id' => $this->product_id,
            'user_name' => auth::user()->name,
            'user_id' => auth::user()->id,

        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
