<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    private $plane;
    protected $totalPage = 20;

    public function __construct(Plane $plane)
    {
        $this->plane = $plane;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Listagem de aviões';

        $planes = $this->plane->paginate($this->totalPage);

        return view('panel.planes.index', compact('title', 'planes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Cadastrar novo avião';

        $classes = $this->plane->classes();

        $brands = Brand::pluck('name', 'id');

        return view('panel.planes.create', compact('title', 'classes', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        dd($request);
    }
}
