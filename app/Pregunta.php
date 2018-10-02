<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pregunta
 *
 * @package App
 * @property text $pregunta
 * @property string $imagen_pregunta
 * @property integer $puntos
*/
class Pregunta extends Model
{
    use SoftDeletes;

    protected $fillable = ['pregunta', 'imagen_pregunta', 'puntos'];
    protected $hidden = [];
    
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPuntosAttribute($input)
    {
        $this->attributes['puntos'] = $input ? $input : null;
    }
    
}
