<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Prueba
 *
 * @package App
 * @property string $asignatura
 * @property string $asignaturas
 * @property text $titulo
 * @property text $descripcion
 * @property tinyInteger $activo
*/
class Prueba extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo', 'descripcion', 'activo', 'asignatura_id', 'asignaturas_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAsignaturaIdAttribute($input)
    {
        $this->attributes['asignatura_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAsignaturasIdAttribute($input)
    {
        $this->attributes['asignaturas_id'] = $input ? $input : null;
    }
    
    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'asignatura_id')->withTrashed();
    }
    
    public function asignaturas()
    {
        return $this->belongsTo(Asignatura::class, 'asignaturas_id')->withTrashed();
    }
    
    public function preguntas()
    {
        return $this->belongsToMany(Pregunta::class, 'pregunta_prueba')->withTrashed();
    }
    
}
