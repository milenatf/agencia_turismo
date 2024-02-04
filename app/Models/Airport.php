<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'name',
        'latitude',
        'longitude',
        'address',
        'number',
        'zip_code',
        'complement',
    ];

    public function search(City $city, $request, $totalPage = 10)
    {
        $airports = $this->where('name', 'LIKE', "%{$request->key_search}%")
                            ->where('city_id', $city->id)
                            ->paginate($totalPage);
        return $airports;
    }

    public function newAirport($request, $idCity)
    {
        $data = $request->all();
        $data['city_id'] = $idCity;

        return $this->create($data);
    }

    public function updateAirport($request, $idCity)
    {
        $data = $request->all();
        $data['city_id'] = $idCity;

        return $this->update($data);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
