<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = ['qty_passengers'];

    public function classes()
    {
        return [
            // '' => 'Escolha a classe',
            'economic' => 'Econômica',
            'luxury' => 'Luxo'
        ];
    }
}
