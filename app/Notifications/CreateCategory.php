<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateCategory extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

     private $category_id;
     private $category_name;
     private $category_description;
     private $admin_created;

    public function __construct($admin_created  , $category_id , $category_name , $category_description)
    {
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->category_description = $category_description;
        $this->admin_created = $admin_created;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    public function toArray(object $notifiable): array
    {
        return [
            'admin_created' =>$this->admin_created ,
            'category_id' => $this->category_id,
            'category_name' => $this->category_name,
            'category_description' => $this->category_description,


        ];
    }
}
