<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OpcionesPregunta
 *
 * @package App
 * @property string $pregunta
 * @property text $texto_opcion
 * @property tinyInteger $correcto
*/
class OpcionesPregunta extends Model
{
    use SoftDeletes;

    protected $fillable = ['texto_opcion', 'correcto', 'pregunta_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setPreguntaIdAttribute($input)
    {
        $this->attributes['pregunta_id'] = $input ? $input : null;
    }
    
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class, 'pregunta_id')->withTrashed();
    }
    
}
