<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function search($keySearch, $totalPage = 10)
    {
        return $this->where('name', 'LIKE', "%{$keySearch}%")
                    ->paginate($totalPage);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Uma cidade tem muitos aeroportos
     *
     * relacionamento um para muitos
     * @return void
     */
    public function airports()
    {
        return $this->hasMany(Airport::class);
    }
}
