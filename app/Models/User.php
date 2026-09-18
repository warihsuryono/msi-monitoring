<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\crudBy;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Privilege;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, crudBy;

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

    public function privilege(): BelongsTo
    {
        return $this->belongsTo(Privilege::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (config("app.env") == "production") {
            return str_ends_with($this->email, "monitoring-msi.test");
        }
        return true;
    }

    public function getFilamentAvatarUrl(): string
    {
        return $this->photo ?? asset('img/monitoring_msi_icon.png');
    }
}
