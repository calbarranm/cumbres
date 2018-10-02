<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Asignatura
 *
 * @package App
 * @property string $nombre
 * @property string $slug
 * @property text $descripcion
 * @property string $imagen_asignatura
 * @property string $fecha_inicio
 * @property tinyInteger $activo
*/
class Asignatura extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre', 'slug', 'descripcion', 'imagen_asignatura', 'fecha_inicio', 'activo'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setFechaInicioAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['fecha_inicio'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['fecha_inicio'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getFechaInicioAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }
    
    public function profesores()
    {
        return $this->belongsToMany(User::class, 'asignatura_user');
    }
    
}
