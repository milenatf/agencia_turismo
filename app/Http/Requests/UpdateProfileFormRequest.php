<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileFormRequest extends FormRequest
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
        $idUser = auth()->user()->id;
        return [
            'name' => "required|min:3|max:100|unique:users,name,{$idUser},id",
            'password' => 'max:15',
            'image' => 'image', // Verifica se o tipo dela é image (jpeg, jpg, png e etc...)
        ];
    }
}
