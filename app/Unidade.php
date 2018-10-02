<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

/**
 * Class Unidade
 *
 * @package App
 * @property string $unidad
 * @property string $nombre
 * @property string $slug
 * @property string $imagen_unidad
 * @property text $texto_corto
 * @property text $texto_largo
 * @property integer $posicion
 * @property tinyInteger $activo
*/
class Unidade extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['nombre', 'slug', 'imagen_unidad', 'texto_corto', 'texto_largo', 'posicion', 'activo', 'unidad_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUnidadIdAttribute($input)
    {
        $this->attributes['unidad_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPosicionAttribute($input)
    {
        $this->attributes['posicion'] = $input ? $input : null;
    }
    
    public function unidad()
    {
        return $this->belongsTo(Asignatura::class, 'unidad_id')->withTrashed();
    }
    
}
