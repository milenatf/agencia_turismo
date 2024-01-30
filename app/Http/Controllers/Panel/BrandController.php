<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;
use App\Http\Requests\BrandStoreUpdateFormRequest;


class BrandController extends Controller
{
    private $brand;
    protected $totalPage = 4;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Marcas de aviões';

        $brands = $this->brand::paginate($this->totalPage);

        return view('panel.brands.index', compact('title', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Cadastrar novo aviões';

        return view('panel.brands.create-edit', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreUpdateFormRequest $request)
    {
        // dd($request->all());

        $dataForm = $request->all();

        $insert = $this->brand::create($dataForm);

        if($insert)
            return redirect()
                ->route('brands.index')
                ->with('success', 'Cadastro realizado com sucesso!'); // Adicionando mensagem de sucesso à session flash
        else
            return redirect()
                ->back()
                ->with('error', 'Falha ao cadastrar'); // Adicionando mensagem de erro à session flash
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
        // O método find() recupera um item pelo id
        $brand = $this->brand->find($id);

        // Se o item não existir, é realizado um redirect back
        if(!$brand)
            return redirect()->back()->with('error', 'A marca não foi encontrada!');

        $title = "Editar marca: {$brand->name}";

        return view('panel.brands.create-edit', compact('title', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandStoreUpdateFormRequest $request, string $id)
    {
        // O método find() recupera um item pelo id
        $brand = $this->brand->find($id);

        // Se o item não existir, é realizado um redirect back
        if(!$brand)
            return redirect()->back()->with('error', 'A marca não foi encontrada!');

        $update = $brand->update($request->all()); // Pega os dados da request e faz a atualização

        if($update)
            return redirect()
                ->route('brands.index')
                ->with('success', 'Atualização realizada com sucesso!'); // Adicionando mensagem de sucesso à session flash
        else
            return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar'); // Adicionando mensagem de erro à session flash
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
        $dataForm = $request->except('_token');

        $brands = $this->brand->search($request->key_search, $this->totalPage);

        $title = "Brands, filtros para: {$request->key_search}";

        return view('panel.brands.index', compact('title', 'brands', 'dataForm'));
    }
}
