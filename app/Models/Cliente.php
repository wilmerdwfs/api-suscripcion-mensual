<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model 
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'contacto', 
        'email',
        'telefono',
        'sitio_web',
        'industria',
        'tamano_empresa', 
        'localidad',
        'direccion',
        'notas',
        'origen',
    ];
}