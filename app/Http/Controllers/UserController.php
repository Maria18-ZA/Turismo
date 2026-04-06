<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Lista todos os utilizadores.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Formulário para criar novo utilizador.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Guardar novo utilizador.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role'     => 'required|in:admin,turista,gestor',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilizador criado com sucesso.');
    }

    /**
     * Detalhe de um utilizador.
     */
    public function show(User $user)
{
    return view('users.show', compact('user'));
}

    /**
     * Formulário para editar utilizador.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Atualizar utilizador.
     */
    public function update(Request $request, User $user)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'email'       => 'required|email|unique:users,email,' . $user->id,
        'role'   => 'required|in:admin,turista,gestor',
        'password'    => 'nullable|min:8|confirmed',
    ]);

    $data = $request->only('name', 'email', 'role');

    // Só adiciona password se foi preenchida
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $user->update($data);

    return redirect()
        ->route('users.index')
        ->with('success', 'Utilizador atualizado com sucesso.');
}
    /**
     * Eliminar utilizador.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilizador eliminado com sucesso.');
    }
}