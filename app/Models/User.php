<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    // Sanctum emite tokens; HasFactory prepara datos de ejemplo y Notifiable habilita avisos.
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // La contraseña se cifra automáticamente al guardar el modelo.
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /** Una cuenta puede tener varios resultados de práctica. */
    public function practiceResults(): HasMany
    {
        return $this->hasMany(PracticeResult::class);
    }
}
