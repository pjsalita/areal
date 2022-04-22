<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'filename',
        'type',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getFileAttribute()
    {
        return Storage::url("attachments/" . $this->filename);
    }

    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    public function scopeModels($query)
    {
        return $query->where('type', 'model');
    }
}
