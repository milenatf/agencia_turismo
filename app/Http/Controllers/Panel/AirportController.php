<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\AirportsStoreUpdateFormRequest;
use App\Models\Airport;
use App\Models\City;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    private $airport, $city;
    private $totalPage = 20;

    public function __construct(Airport $airport, City $city)
    {
        $this->airport = $airport;
        $this->city = $city;
    }

    public function index($idCity)
    {
        $city = $this->city->with('state')->find($idCity);

        if(!$city)
            return redirect()->back()->with('error', 'Cidade não encontrada');

        $title = "Aeroportos da cidade {$city->name}";

        $airports = $city->airports()->paginate($this->totalPage);

        return view('panel.airports.index', compact('title', 'city', 'airports'));
    }

    public function create($idCity)
    {
        $city = $this->city->with('state')->find($idCity);

        $title = "Cadastrar aeroporto para a cidade: {$city->name}";

        return view('panel.airports.create', compact('title', 'city'));
    }

    public function store(AirportsStoreUpdateFormRequest $request, $idCity)
    {
        $city = $this->city->find($idCity);

        if(!$city)
            return redirect()->back()->with('error', 'Cidade não existe');

        if($this->airport->newAirport($request, $idCity))
            return redirect()
                    ->route('airports.index', $city->id)
                    ->with('success', 'Cadastro realizado com sucesso!'); // Adicionando mensagem de sucesso à session flash
            else
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao cadastrar') // Adicionando mensagem de erro à session flash
                    ->withInput();
    }

    public function show(string $idCity, string $id)
    {
        $airport = $this->airport->with('city')->find($id);

        if(!$airport)
            return redirect()->back()->with('error', 'Aeroporto não existe');

        return view('panel.airports.show', compact('airport'));
    }

    public function edit($idCity, string $id)
    {
        $airport = $this->airport->with('city')->find($id);
        if(!$airport)
            return redirect()->back()->with('error', 'Aeroporto não existe');

        $title = "Alterar aeroporto {$airport->name}";

        return view('panel.airports.edit', compact('title', 'airport'));
    }

    public function update(AirportsStoreUpdateFormRequest $request, string $idCity, string $id)
    {
        $city = $this->city->find($idCity);

        if(!$city)
            return redirect()->back()->with('error', 'Cidade não existe');

        $update = $this->airport->find($id)->updateAirport($request, $city->id);

        if($update)
            return redirect()
                ->route('airports.index', $idCity)
                ->with('success', 'Aeroporto foi alterado com sucesso');
        else
            return redirect()
                ->route('airports.index', $idCity)
                ->with('error', "Não foi possível alterar o registro: {$this->airport->find($id)->name}");

    }

    public function destroy($idCity, string $id)
    {
        $airport = $this->airport->find($id);

        if(!$airport)
            return redirect()->back()->with('error', 'O aeroporto não foi encontrado!');

        if($airport->delete())
            return redirect()
                ->route('airports.index', $idCity)
                ->with('success', 'Aeroporto excluído com sucesso!'); // Adicionando mensagem de sucesso à session flash
            else
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao excluir o aeroporto'); // Adicionando mensagem de erro à session flash
    }

    public function search($idCity, Request $request)
    {
        $dataForm = $request->except('(token');

        $city = $this->city->find($idCity);

        if(!$city)
            return redirect()->back()->with('error', 'Cidade não existe');

        $airports = $this->airport->search($city, $request, $this->totalPage);

        $title = "Aeroportos da cidade {$city->name}";

        return view('panel.airports.index', compact('title', 'city', 'airports', 'dataForm'));
    }
}
