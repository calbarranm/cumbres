<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePreguntasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'pregunta' => 'required',
            'imagen_pregunta' => 'nullable|mimes:png,jpg,jpeg,gif',
            'puntos' => 'max:2147483647|required|numeric',
        ];
    }
}
