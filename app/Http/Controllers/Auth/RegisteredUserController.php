<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view – apenas para administradores.
     */
    public function create(): View
    {
           // Só permite ver o formulário se for admin (ou se não houver nenhum user)
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Apenas administradores podem criar novos utilizadores.');
        }
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Só administradores podem criar contas
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Apenas administradores podem criar novos utilizadores.');
        }

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'contato'  =>['required', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'in:turista,gestor,admin'], // admin escolhe a role
        ]);

        $user = User::create([
            'name'     => $request->name,
            'contato'     => $request->contato,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        event(new Registered($user));

        // Não faz login automático do novo utilizador (opcional)
         Auth::login($user);  // <-- remover para não trocar de sessão

        return redirect()->route('users.index')
            ->with('success', 'Utilizador criado com sucesso!');
    }
}