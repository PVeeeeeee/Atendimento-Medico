<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function isAdmin()
    {
        // Lógica para verificar se o usuário é um administrador
        return $this->tipo === 'admin'; // Certifique-se de ajustar isso conforme sua estrutura de dados
    }

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'data_nasc',
        'password',
        'tipo',
        'funcao'
    ];

    // ...

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
        'password' => 'hashed',
    ];
    public function consultasComum()
    {
        return $this->hasMany(Consulta::class, 'user_comum_id');
    }

    // Relacionamento com consultas como médico
    public function consultasMedico()
    {
        return $this->hasMany(Consulta::class, 'user_medico_id');
    }

    public function consultasComuns()
    {
        return $this->hasMany(Consulta::class, 'user_comum_id');
    }

    public function consultasMedicas()
    {
        return $this->hasMany(Consulta::class, 'user_medico_id');
    }
}
