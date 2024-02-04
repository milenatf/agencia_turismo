<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AirportsStoreUpdateFormRequest extends FormRequest
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
        $id = $this->segment(5);

        return [
            'name' => "required|min:3|max:100|unique:airports,name,{$id},id",
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'address' => 'required|min:3|max:100',
            'number' => 'required|integer',
            'zip_code' => "required|numeric|unique:airports,zip_code,{$id},id",
            'complement' => 'max:190',

        ];
    }
}
