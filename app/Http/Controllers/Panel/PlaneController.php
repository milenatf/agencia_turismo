<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaneStoreUpdateFormRequest;
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

        $planes = $this->plane->with('brand')->paginate($this->totalPage);

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
    public function store(PlaneStoreUpdateFormRequest $request)
    {
        // dd($request);
        $dataForm = $request->all();

        // dd($dataForm);

        $insert = $this->plane->create($dataForm);

        if($insert)
            return redirect()
                ->route('planes.index')
                ->with('success', 'Avião cadastrado com sucesso!');
        else
            return redirect()
                ->back()
                ->with('error', 'Não foi possível realizar o cadastro!')
                ->withInput(); // Método que mantém o formulário preenchido após uma falha ao tentar realizar a inclusão do registro

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plane = $this->plane->with('brand')->find($id);

        if(!$plane)
            return redirect()->back()->with('error', 'Registro não encontrado!');

        $title = "Detalhes do avião: {$plane->id}: {$plane->brand->name}";

        // dd($plane);

        return view('panel.planes.show', compact('title', 'plane'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Alterar avião {$id}";

        $plane = $this->plane->with('brand')->find($id);

        $classes = $this->plane->classes();

        $brands = Brand::pluck('name', 'id');

        if(!$plane)
            return redirect()->back()->with('error', 'Avião não foi encontrado!');

        return view('panel.planes.edit', compact('title', 'plane', 'classes', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlaneStoreUpdateFormRequest $request, string $id)
    {
        $plane = $this->plane->find($id);
        // dd($request);

        if(!$plane)
            return redirect()->back()->with('error', 'Avião não encontrado!');

        $update = $plane->update($request->all());

        if($update)
            return redirect()
                ->route('planes.index')
                ->with('success', 'Atualização realizada com sucesso!');
        else
            return redirect()
                ->back()
                ->with('error', 'Não foi possível alterar o registro!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plane = $this->plane->find($id);

        if(!$plane)
            return redirect()->back()->with('error', 'Avião não encontrado!');

        if($plane->delete())
            return redirect()
                    ->route('planes.index')
                    ->with('success', 'O registro foi apagado com sucesso!');
        else
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível deletar o avião!');

    }

    public function search(Request $request)
    {

        $dataForm = $request->except('_token');
        $planes = $this->plane->search($request->key_search, $this->totalPage);
        $title = "Aviões filtrados por: {$request->key_search}";

        return view('panel.planes.index', compact('title', 'planes', 'dataForm'));
    }
}
