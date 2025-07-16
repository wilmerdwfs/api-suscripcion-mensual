<?php
namespace App\Domain\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;  // IMPORTANTE
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory;

    public static function newFactory()
    {
        return \Database\Factories\UsuarioFactory::new();
    }

    use HasApiTokens, Notifiable;  // USAR HasApiTokens aquí

    protected $fillable = [
        'nombre', 
        'email', 
        'password',
        'empresa_id',
        'es_admin' 
    ];

    public $timestamps = false;  // si no usas created_at, updated_at
    
    public function empresa()
{
    return $this->belongsTo(Empresa::class);
}
}