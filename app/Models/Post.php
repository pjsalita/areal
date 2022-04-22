<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Likeable;
use App\Models\Concerns\Likes;
use Illuminate\Support\Facades\Storage;

class Post extends Model implements Likeable
{
    use HasFactory;
    use Likes;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'type',
    ];

    protected $appends = ['model', 'model_link'];

    public function getModelAttribute()
    {
        return $this->attachments()->models()->first();
    }

    public function getModelLinkAttribute()
    {
        return url(Storage::url("attachments/" . $this->model->filename));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function attachments()
    {
        return $this->hasMany(PostAttachment::class)->orderBy('created_at', 'desc');
    }

    public function scopePosts($query)
    {
        return $query->where('type', 'post');
    }

    public function scopeDesigns($query)
    {
        return $query->where('type', 'design');
    }
}
