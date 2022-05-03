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
        'measurements',
        'is_private',
    ];

    protected $appends = ['model', 'image', 'architect_name'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'measurements' => 'object',
    ];

    public function getArchitectNameAttribute()
    {
        return $this->user->name;
    }

    public function getModelObjectAttribute()
    {
        return $this->attachments()->models()->first();
    }

    public function getImageObjectAttribute()
    {
        return $this->attachments()->images()->first();
    }

    public function getModelAttribute()
    {
        $model = [
            'filename' => $this->modelObject->filename,
            'link' => url(Storage::url("attachments/" . $this->modelObject->filename))
        ];
        return $model;
    }

    public function getImageAttribute()
    {
        $image = [
            'filename' => $this->imageObject->filename,
            'link' => url(Storage::url("attachments/" . $this->imageObject->filename))
        ];
        return $image;
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

    public function scopePrivate($query)
    {
        return $query->where('is_private', true);
    }

    public function scopePublic($query)
    {
        return $query->where('is_private', false);
    }
}
