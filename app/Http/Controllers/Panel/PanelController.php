<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Brand;
use App\Models\City;
use App\Models\Flight;
use App\Models\Plane;
use App\Models\Reserve;
use App\Models\State;
use App\Models\User;

class PanelController extends Controller
{
    public function index()
    {
        $totalBrands = Brand::count();
        $totalPlanes = Plane::count();
        $totalStates = State::count();
        $totalCities = City::count();
        $totalAirports = Airport::count();
        $totalflights = Flight::count();
        $totalUsers = User::count();
        $totalReserves = Reserve::count();
        return view('panel.home.index', compact(
            'totalBrands',
            'totalPlanes',
            'totalStates',
            'totalCities',
            'totalAirports',
            'totalflights',
            'totalUsers',
            'totalReserves',
        ));
    }
}
