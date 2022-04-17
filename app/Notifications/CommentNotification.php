<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Str;

class CommentNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $post;
    protected $comment;
    protected $isFollowing;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post, Comment $comment, $isFollowing = false)
    {
        $this->user = $user;
        $this->post = $post;
        $this->comment = $comment;
        $this->isFollowing = $isFollowing;
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
        $comment = Str::of($this->comment->body)->limit(20);
        $message = $this->isFollowing
            ? "{$this->user->first_name} also commented \"{$comment}\" on post: \"{$title}\"."
            : "{$this->user->first_name} commented \"{$comment}\" your post: \"{$title}\".";

        return [
            'user_id' => $this->user->id,
            'user_photo' => $this->user->profile_photo,
            'reference_id' => $this->comment->id,
            'reference_link' => route("post.show", $this->post->id),
            'message' => $message,
        ];
    }
}
