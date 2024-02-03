<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFlightFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'plane_id' => 'required|exists:planes,id', // Obrigatório | Verifica se ele existe na tabela planes,o campo que eu quero verificar na tabela planes
            'origin' => 'required|exists:airports,id', // Obrigatório | Verifica se ele existe na tabela airports,o campo que eu quero verificar na tabela airports
            'destination' => 'required|exists:airports,id', // Obrigatório | Verifica se ele existe na tabela airports,o campo que eu quero verificar na tabela airports
            'date' => 'required|date|after:today', // Obrigatório | formato tipo data | depois de hoje
            'time_duration' => 'required',
            'hour_output' => 'required',
            'arrival_time' => 'required',
            'old_price' => 'required',
            'price' => 'required',
            'total_plots' => 'required|numeric|min:1|max:12', // Obrigatório | Com dígitos entre 1 e 12
            'is_promotion' => 'boolean',
            'image' => 'image', // Verifica se o tipo dela é image (jpeg, jpg, png e etc...)
            'qts_stops' => 'numeric',
            'description' => 'min:3|max:1000',
        ];
    }
}
