<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
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

        return view('panel.flights.index', compact('title', 'flights'));
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
    public function store(Request $request)
    {
        if($this->flight->newFlight($request))
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

        $title = "Alterar Voo {$flight->id}";
        // dd($flight);

        if(!$flight)
            return redirect()->back()->with('error', 'Voo não encontrado!');

        return view('panel.flights.edit', compact('title', 'planes', 'airports', 'flight'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $flight = $this->flight->with(['origin', 'destination'])->find($id);

        if(!$flight)
            return redirect()->back()->with('error', 'Voo não encontrado!');

        // $flight->update($request);

        if($flight->updateFlight($request))
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

    public function search(Request $request)
    {
        dd('Médoto search');
    }
}
