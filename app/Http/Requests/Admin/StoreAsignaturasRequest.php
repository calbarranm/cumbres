<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsignaturasRequest extends FormRequest
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
            'profesores.*' => 'exists:users,id',
            'nombre' => 'required',
            'imagen_asignatura' => 'nullable|mimes:png,jpg,jpeg,gif',
            'fecha_inicio' => 'nullable|date_format:'.config('app.date_format').' H:i:s',
        ];
    }
}
