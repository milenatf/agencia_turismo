<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    private $state;
    protected $totalPage = 20;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = $this->state->paginate();

        $title = 'Estados brasileiros';

        return view('panel.states.index', compact('title', 'states'));
    }

    // public function show(string $id)
    // {
    //     $state = $this->state->find($id);
    //     $cities = $state->cities()->paginate();

    //     return view('panel.cities.index', compact('state', 'cities'));
    // }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        $states = $this->state->search($request->key_search);
        $title = "Estados filtrados por {$request->key_search}";

        return view('panel.states.index', compact('title', 'states', 'dataForm'));
    }
}
