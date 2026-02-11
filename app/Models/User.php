<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
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

    // ------------------------------------------------------------------------
    // RELACIONES
    //
    // Un usuario puede tener varias evidencias.
    public function evidencias(): HasMany
    {
        return $this->hasMany(Evidencia::class, 'estudiante_id');
    }

    // Un docente imparte uno o varios módulos.
    public function modulosImpartidos(): HasMany
    {
        return $this->hasMany(ModuloFormativo::class, 'docente_id');
    }

    // Un estudiante está matriculado en uno o varios módulos.
    public function modulosMatriculados(): BelongsToMany
    {
        return $this->belongsToMany(ModuloFormativo::class, 'matriculas', 'estudiante_id', 'modulo_formativo_id');
    }

    // ------------------------------------------------------------------------
    // POLÍTICAS
    //
    // Un usuario es un docente si tiene al menos un módulo impartido.
    public function esDocente()
    {
        return $this->modulosImpartidos()->exists();
    }

    // Usuario es docente de un módulo si ese módulo está asociado a él.
    public function esDocenteModulo(ModuloFormativo $modulo)
    {
        return $this->modulosImpartidos()->where('id', $modulo->id)->exists();
    }

    // Un usuario es estudiante si está matriculado en algún módulo.
    public function esEstudiante()
    {
        return $this->modulosMatriculados()->exists();
    }

    // Usuario es estudiante de un módulo si está matriculado en ese módulo.
    public function esEstudianteModulo(ModuloFormativo $modulo)
    {
        return $this->modulosMatriculados()->where('modulo_formativo_id', $modulo->id)->exists();
    }

    // Un usuario es administrador si su email coincide con el email del administrador.
    public function esAdministrador()
    {
        return $this->email === config("app.admin.email");
    }
}
