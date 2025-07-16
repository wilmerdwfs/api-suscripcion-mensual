<?php
namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empresa extends Model
{
    use HasFactory;

    public static function newFactory()
    {
        return \Database\Factories\EmpresaFactory::new();
    }

    protected $fillable = ['id','nombre', 'plan_id'];  // si usas plan_id

    public $timestamps = false;  // si no usas created_at, updated_at

    // Relación con usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
    
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}