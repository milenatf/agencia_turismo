<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function search($keySearch, $totalPage = 10)
    {
        return $this->where('name', 'LIKE', "%{$keySearch}%")->paginate($totalPage);
    }

    public function planes()
    {
        // hasMany(): Traz o relacionamento de um para muitos
        return $this->hasMany(Plane::class);
    }
}
