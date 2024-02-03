<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateFlightFormRequest;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Plane;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    private $flight;
    private $totalPage = 20;

    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Voos disponíveis';

        $flights = $this->flight->getItems($this->totalPage);

        $airports = Airport::pluck('name', 'id');
        $airports->prepend('Escolha o aeroporto', ''); // Esse trecho foi adicionado para poder colocar um option no select na busca de voos por origem e destino

        return view('panel.flights.index', compact('title', 'airports', 'flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Cadastrar voos';

        $planes = Plane::pluck('id', 'id');

        $airports = Airport::pluck('name', 'id');

        return view('panel.flights.create', compact('planes', 'airports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateFlightFormRequest $request)
    {
        $newNameFile = '';
        // Verifica se existe arquivo para fazer upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            // Recupera a extensão do aquivo
            $extension = $request->image->extension();

            // Define o nome da imagem
            $nameFile = uniqid(date('HisYmd'));

            // Monta o nome do arquivo com a extensão
            $newNameFile = "{$nameFile}.{$extension}";
            /**
             * As regras de upload de arquivos ficam dentro do arquivo config/filesystems.php
             */
            if(!$request->file('image')->storeAs('public/flights', $newNameFile))
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer o upload do arquivo!')
                    ->withInput();
        }

        if($this->flight->newFlight($request, $newNameFile))
            return redirect()
                    ->route('flights.index')
                    ->with('success', 'Cadastro realizado com sucesso!');
        else
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível realizar o cadastro!')
                    ->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flight = $this->flight->with(['origin', 'destination'])->find($id);

        if(!$flight)
            return redirect()->back()->with('error', 'Voo não encontrado!');

        // dd($flight);

        return view('panel.flights.show', compact('flight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $planes = Plane::pluck('id', 'id');
        $airports = Airport::pluck('name', 'id');

        $flight = $this->flight->with(['origin', 'destination'])->find($id);

        // dd($flight);

        $title = "Alterar Voo {$flight->id}";
        // dd($flight);

        if(!$flight)
            return redirect()->back()->with('error', 'Voo não encontrado!');

        return view('panel.flights.edit', compact('title', 'planes', 'airports', 'flight'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateFlightFormRequest $request, string $id)
    {
        $flight = $this->flight->with(['origin', 'destination'])->find($id);

        if(!$flight)
            return redirect()->back()->with('error', 'Voo não encontrado!');

        $nameFile = $flight->image;

        // Verifica se existe arquivo para fazer upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            if($flight->image)
                $nameFile = $flight->image;
            else
                $nameFile = uniqid(date('HisYmd')).'.'.$request->image->extension(); // Define o nome da imagem com a extensão

            /**
             * As regras de upload de arquivos ficam dentro do arquivo config/filesystems.php
             */
            if(!$request->file('image')->storeAs('public/flights', $nameFile))
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer o upload do arquivo!')
                    ->withInput();
        }

        // dd($request->all());

        if($flight->updateFlight($request, $nameFile))
            return redirect()
                ->route('flights.index')
                ->with('success', 'Voo alterado com sucesso!');
        else
            return redirect()
                ->back()
                ->with('error', 'Não foi possível realizar a alteração do voo')
                ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flight = $this->flight->find($id);

        // dd($flight);
        if(!$flight)
            return redirect()->back()->with('error', 'Voo não encontrado!');

        if($flight->delete())
            return redirect()
                    ->route('flights.index')
                    ->with('success', 'O voo foi excluído com sucesso!');
        else
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível excluir o voo.')
                    ->withInput();
    }

    public function search(StoreUpdateFlightFormRequest $request)
    {
        $title = 'Resultado da busca';

        $dataForm = $request->except('_token');

        $airports = Airport::pluck('name', 'id');

        $flights = $this->flight->search($request, $this->totalPage);

        return view('panel.flights.index', compact('title', 'airports', 'dataForm', 'flights'));
    }
}
