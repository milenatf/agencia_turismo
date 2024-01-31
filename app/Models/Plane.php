<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = ['brand_id', 'qty_passengers', 'class'];

    public function classes($className = null)
    {
        $classes = [
            // '' => 'Escolha a classe',
            'economic' => 'Econômica',
            'luxury' => 'Luxo'
        ];

        if(!$className)
            return $classes;

        return $classes[$className];
    }

    /**
     * Relacionamento entre marcas e aviões (n:1)
     * Uma marca pode ter vários aviões
     * Um avião só tem uma marca
     * Chave estrangeira de marca(brand_id) está na tabela de aviões (planes)
     */

    public function brand()
    {
        return $this->belongsTo(Brand::class); // Faz o relacionamento de muitos para um
    }

    public function search($keySearch, $totalPage = 10)
    {
        return $this->where('id', $keySearch)
                    ->orWhere('qty_passengers', $keySearch)
                    ->orWhere('class', $keySearch)
                    ->paginate($totalPage);
    }
}
