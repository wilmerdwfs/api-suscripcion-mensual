<?php 
namespace App\Modes;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model 
{
    protected $fillable = [
        'nombre',
        'descripcion', 
        'valor_presupuesto',
        'valor_esperado',
        'prioridad',
        'estado',
        'fecha_inicio',
        'fecha_final',
        'responsable_id',
        'cliente_id'
    ];

    public function cliente()
    {
        return $this->belongTo(Cliente::class);
    }
    
    public function responsable()
    {
        return $this->belongTo(Responsable::class);
    }
}