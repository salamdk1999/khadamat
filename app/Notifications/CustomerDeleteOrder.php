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

class CustomerDeleteOrder extends Notification implements ShouldBroadcast
{
    use Queueable;
    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(orders $order)
    {
        $this->order=$order;
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
            'id'=> $this->order->id,
            'order'=> $this->order,
            'service'=>0,
            'user'=> Auth::user()->name,
            'user_id'=>Auth::user()->id,
            'title'=>'قام العميل بإلغاء طلب خدمتك:',
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'order'=> $this->order,
            'service'=>0,
            'user'=> Auth::user()->name,
            'user_id'=>Auth::user()->id,
            'title'=>'قام العميل بإلغاء طلب خدمتك:',
        ]);
    }
}