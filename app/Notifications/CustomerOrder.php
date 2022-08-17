<?php

namespace App\Notifications;

use App\orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Support\Facades\Auth;

class CustomerOrder extends Notification implements ShouldBroadcast
{
    use Queueable;
    public $orders;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(orders $orders)
    {
        $this->orders=$orders;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable):array
    {
        return ['broadcast','database'];
    }




    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // كل البيانات يلي هون حتنحط بعمود الداتا
    public function toArray($notifiable)
    {
        return [
            'id'=> $this->orders->id,
            'order'=> $this->orders,
            'service'=>0,
            'user'=> Auth::user()->name,
            'user_id'=>Auth::user()->id,
            'title'=>'تم اضافة طلب جديد بواسطة :',
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'order'=> $this->orders,
            'service'=>0,
            'user'=> Auth::user()->name,
            'user_id'=>Auth::user()->id,
            'title'=>'تم اضافة طلب جديد بواسطة :',
        ]);
    }
}