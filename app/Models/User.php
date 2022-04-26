<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Contracts\Likeable;
use App\Models\Like;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'role',
        'email',
        'password',
        'phone_number',
        'position',
        'birthdate',
        'account_type',
        'gender',
        'address',
        'google_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'google_token' => 'array',
    ];

    protected $appends = ['name', 'profile_photo'];

    public function getNameAttribute() {
        $middle_name = $this->middle_name ? "{$this->middle_name} " : "";
        return "{$this->first_name} {$middle_name}{$this->last_name}";
    }

    public function getDesignsAttribute() {
        return $this->posts()->designs()->get();
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class)->orderBy('created_at', 'asc');
    }

    public function clientAppointments()
    {
        return $this->hasMany(Appointment::class, 'user_id')->orderBy('start_date', 'asc');
    }

    public function architectAppointments()
    {
        return $this->hasMany(Appointment::class, 'architect_id')->orderBy('start_date', 'asc');
    }

    public function messages()
    {
        return $this->hasMany(ChMessage::class, 'to_id')->orderBy('created_at', 'desc');
    }

    public static function getFullName($user) {
        return "{$user->first_name} {$user->last_name}";
    }

    public static function getAvatar($user) {
        // return asset('/storage/'.config('chatify.user_avatar.folder').'/'.$user->avatar);
        if ($user->avatar) {
            return Storage::url($user->avatar);
        }

        $initials = "{$user->first_name[0]}+{$user->last_name[0]}";
        $background = $user->gender === "male" ? "4AD2F2" : "FD8DAD";
        return "https://ui-avatars.com/api/?name={$initials}&color=fff&background={$background}";
    }

    public function getProfilePhotoAttribute()
    {
        return self::getAvatar($this);
        // return asset('/storage/'.config('chatify.user_avatar.folder').'/'.$this->avatar);
        $initials = "{$this->first_name[0]}+{$this->last_name[0]}";
        $background = $this->gender === "male" ? "4AD2F2" : "FD8DAD";
        return "https://ui-avatars.com/api/?name={$initials}&color=fff&background={$background}";
    }

    public function scopeArchitects($query)
    {
        return $query->where('account_type', 'architect');
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like(Likeable $likeable)
    {
        if ($this->hasLiked($likeable)) {
            return $this;
        }

        (new Like())
            ->user()->associate($this)
            ->likeable()->associate($likeable)
            ->save();

        return $this;
    }

    public function unlike(Likeable $likeable)
    {
        if (! $this->hasLiked($likeable)) {
            return $this;
        }

        $likeable->likes()
            ->whereHas('user', fn($q) => $q->whereId($this->id))
            ->delete();

        return $this;
    }

    public function hasLiked(Likeable $likeable)
    {
        if (! $likeable->exists) {
            return false;
        }

        return $this->likes->contains(
            fn($like) => $like->likeable_type == get_class($likeable) && $like->likeable_id == $likeable->id
        );
    }
}
