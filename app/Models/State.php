<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function search($keySearch, $totalPage = 10)
    {
        return $this->where('name', 'LIKE', "%{$keySearch}%")
                    ->orWhere('initials', $keySearch)
                    ->paginate($totalPage);
    }

    public function searchCities($cityName, $totalPage = 10)
    {
        return $this->cities()->where('name', 'LIKE', "%{$cityName}%")
                    ->paginate($totalPage);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
