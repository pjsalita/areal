<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;

class LikeNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $title = Str::of($this->post->title)->limit(20);
        return [
            'user_id' => $this->user->id,
            'user_photo' => $this->user->profile_photo,
            'parent_id' => $this->post->id,
            'reference_id' => $this->post->id,
            'reference_link' => route("post.show", $this->post->id),
            'message' => "{$this->user->first_name} liked your post \"{$title}\".",
        ];
    }
}
