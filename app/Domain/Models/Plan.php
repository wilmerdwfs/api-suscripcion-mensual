<?php
namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domain\ValueObjects\Plan\Caracteristicas;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    public static function newFactory()
    {
        return \Database\Factories\PlanFactory::new();
    }

    protected $table = 'planes'; 

    protected $fillable = ['id','nombre', 'precio_mensual', 'limite_usuarios','caracteristicas'];
    
    public $timestamps = false;

    public function getCaracteristicasVO(): Caracteristicas
    {
        return Caracteristicas::desdeEntero($this->caracteristicas);
    }
}