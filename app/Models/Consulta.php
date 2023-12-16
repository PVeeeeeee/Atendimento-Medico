<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'user_comum_id',
        'user_medico_id',
        'data_consulta',
        'hora_consulta',
    ];    

    // Relacionamento com o modelo User para usuário comum

    public function usuarioComum()
    {
        return $this->belongsTo(User::class, 'user_comum_id');
    }
    
    public function usuarioMedico()
    {
        return $this->belongsTo(User::class, 'user_medico_id');
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

    // Adicione mais relações ou métodos conforme necessário