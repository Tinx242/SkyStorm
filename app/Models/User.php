<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Les posts de l'utilisateur.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Les utilisateurs que cet utilisateur suit (ses abonnements).
     */
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 'follows', 'follower_id', 'following_id'
        );
    }

    /**
     * Les utilisateurs qui suivent cet utilisateur (ses abonnés).
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, 'follows', 'following_id', 'follower_id'
        );
    }

    /**
     * Les likes émis par l'utilisateur.
     */
    public function liking(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Les likes reçus par l'utilisateur (relation polymorphe).
     */
    public function liked(): MorphMany
    {
        return $this->morphMany(Like::class, 'liked');
    }
}
