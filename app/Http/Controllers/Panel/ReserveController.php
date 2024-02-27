<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReserveFormRequest;
use App\Models\Flight;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    private $reserve, $user, $flight;
    private $totalPage = 20;

    public function __construct(Reserve $reserve, User $user, Flight $flight)
    {
        $this->reserve = $reserve;
        $this->user = $user;
        $this->flight = $flight;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Reservas de passagens aéreas';

        $reserves = $this->reserve->with(['user'])->paginate($this->totalPage);

        return view('panel.reserves.index', compact('title', 'reserves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Cadastro de reservas';

        $users = $this->user->pluck('name', 'id');
        $flights = $this->flight->pluck('id', 'id');
        $status = $this->reserve->status();

        return view('panel.reserves.create', compact('title', 'users', 'flights', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReserveFormRequest $request)
    {
        if($this->reserve->create($request->all()))
            return redirect()
                ->route('reserves.index')
                ->with('suceess', 'Reserva foi concluída com sucesso!');

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Não foi possível realizar a reserva!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reserve = $this->reserve->find($id);

        if(!$reserve)
            return redirect()
                    ->back()
                    ->with('error', 'Reserva não existe');

        $title = 'Alterar reserva';
        $status = $this->reserve->status();

        return view('panel.reserves.edit', compact('title', 'reserve', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reserve = $this->reserve->find($id);

        if(!$reserve)
            return redirect()
                    ->back()
                    ->with('error', 'Reserva não existe');

        if($reserve->changeStatus($request->status))
            return redirect()
                    ->route('reserves.index')
                    ->with('success', 'Status da reserva foi alterado com sucesso!');

        return redirect()
                ->back()
                ->with('error', 'Não foi possível alterar o status da reserva');
    }

    public function search(Request $request)
    {
        $reserves = $this->reserve->search($request, $this->totalPage);

        $title = "Resultado da pesquisa";

        $dataForm = $request->except('_token');

        return view('panel.reserves.index', compact('title', 'reserves', 'dataForm'));
    }
}
