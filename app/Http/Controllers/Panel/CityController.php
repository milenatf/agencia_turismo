<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $totalPage = 20;

    public function index($initials)
    {
        $state = State::where('initials', $initials)
                        ->get()
                        ->first();

        $cities = $state->cities()->paginate($this->totalPage);

        if(!$state)
            return redirect()->back()->with('error', 'Estado não encontrado!');

        $title = "Cidades do estado {$state->name}";

        return view('panel.cities.index', compact('title', 'state', 'cities'));
    }

    public function search(Request $request, $initials)
    {
        $state = State::where('initials', $initials)->get()->first();

        if(!$state)
            return redirect()->back()->with('error', 'O estado não foi encontrado!');

        $dataForm = $request->all();
        $keySearch = $request->key_search;

        $cities = $state->searchCities($keySearch, $this->totalPage);

        $title = "Cidades filtrados por: {$request->key_search}";

        return view('panel.cities.index', compact('title', 'state', 'cities', 'dataForm'));
    }
}
