<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\CheckAvailableFlight;

class StoreReserveFormRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'flight_id' => [
                'required',
                'exists:flights,id',
                new CheckAvailableFlight
            ],
            'date_reserved' => 'required|date',
            'status' => [
                'required',
                Rule::in(['reserved', 'canceled', 'paid', 'concluded'])
            ]
        ];
    }
}
