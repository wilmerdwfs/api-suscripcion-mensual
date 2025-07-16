<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanesSuscripcion extends Model
{
    use HasFactory;

    public static function newFactory()
    {
        return \Database\Factories\PlanesSuscripcionFactory::new();
    }
    
    protected $table = 'planes_suscripciones';

    public $timestamps = false; // ya que la tabla no tiene created_at / updated_at

    protected $fillable = [
        'empresa_id',
        'plan_anterior_id',
        'plan_nuevo_id',
        'estado',
        'fecha',
    ];
}