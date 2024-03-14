<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreUpdateFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private $user;
    private $totalPage = 10;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $title = 'usuários';

        $users = $this->user->paginate($this->totalPage);

        return view('panel.users.index', compact('title', 'users'));
    }

    public function create()
    {
        $title = 'Cadastro de usuários';

        return view('panel.users.create', compact('title'));
    }

    public function store(UserStoreUpdateFormRequest $request)
    {
        $fileName = '';

        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            // Define o nome da imagem com a extensão
            $fileName = uniqid(date('HisYmd')).'.'.$request->image->extension();

            if(!$request->file('image')->storeAs('public/users', $fileName))
                return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer o upload da imagem.')
                        ->withInput();
        }

        $update = $this->user->newUser($request, $fileName);

        if($update)
            return redirect()
                ->route('users.index')
                ->with('success', 'Usuário cadastrado com sucesso!');
        else
            return redirect()
            ->back()
            ->with('error', 'Não foi possível cadastrar o usuário!')
            ->withInput();
    }

    public function show(string $id)
    {
        $title = 'Detalhes do usuário';

        $user = $this->user->find($id);

        if(!$user)
            return redirect()
                    ->back()
                    ->with('error', 'Usuário não encontrado');

        return view('panel.users.show', compact('title', 'user'));
    }

    public function edit(string $id)
    {
        $title = 'Alterar usuário';

        $user = $this->user->find($id);

        $isAdmin = $user->is_admin == 1 ? 'true' : 'false';

        if(!$user)
            return redirect()
                    ->back()
                    ->with('error', 'Usuário não encontrado!')
                    ->withInput();

        return view('panel.users.edit', compact('title', 'user', 'isAdmin'));
    }

    public function update(UserStoreUpdateFormRequest $request, string $id)
    {
        $user = $this->user->find($id);

        if(!$user)
            return redirect()->back()->with('error', 'Usuário não encontrado!');

        $fileName = $user->image;

        if($request->hasFile('image') && $request->file('image')->isValid())
        {
            if($user->image)
                $fileName = $user->image;
            else
            // Define o nome da imagem com a extensão
            $fileName = uniqid(date('HisYmd')).'.'.$request->image->extension();

            /**
             * As regras de upload de arquivos ficam dentro do arquivo config/filesystems.php
             */
            if(!$request->file('image')->storeAs('public/users', $fileName))
                return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer o upload da imagem.')
                        ->withInput();
        }

        if($user->userUpdate($request, $fileName))
            return redirect()
                ->route('users.index')
                ->with('success', 'Usuário alterado com sucesso!');
        else
            return redirect()
                ->back()
                ->with('error', 'Não foi possível atualizar os dados do usuário')
                ->withInput();
    }

    public function destroy(string $id)
    {
        $user = $this->user->find($id);

        if(!$user) {
            return redirect()
                ->back()
                ->with('error', 'Usuário não encontrado!');
        }

        if($user->delete())
            return redirect()
                    ->route('users.index')
                    ->with('success', 'Usuário excluído com sucesso!');
        else
            return redirect()
                    ->back()
                    ->with('error', 'Não foi possível excluir o usuário!');

    }

    public function search(Request $request)
    {
        $dataForm = $request->except('_token');
        $users = $this->user->search($request->key_search, $this->totalPage);
        $title = "Usuários filtrados por: {$request->key_search}";

        return view('panel.users.index', compact('title', 'users', 'dataForm'));
    }

    public function myProfile()
    {
        $title = 'Meu Perfil';

        return view('site.users.profile', compact('title'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        if ($request->password)
            $user->password = bcrypt($request->password);

        if ( $request->hasFile('image') && $request->file('image')->isValid() ) {

            if ( $user->image )
                $nameFile = $user->image;
            else
                $nameFile = Str::kebab($user->name).'.'.$request->image->extension();

            $user->image = $nameFile;

            if ( !$request->image->storeAs('public/users', $nameFile) )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload.');

        }
        
        if($user->save())
            return redirect()
                    ->route('my.profile')
                    ->with('success', 'Atualizado com sucesso!');
        else
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao alterar os dados!');
    }

}
