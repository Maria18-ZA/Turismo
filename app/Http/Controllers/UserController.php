<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Lista de utilizadores – APENAS ADMIN
     */

     
public function profile()
{
    $user = auth()->user();

    // Estatísticas base
    $totalReservas = $user->reservas()->count();
    $totalAvaliacoes = $user->avaliacoes()->count();

    // Se for gestor, busca hotéis e estatísticas adicionais
    $hoteis = null;
    $totalHoteis = 0;
    $totalQuartos = 0;
    $totalReservasGestor = 0;

    if ($user->role === 'gestor') {
        $hoteis = $user->hoteis()->withCount('quartos')->get();
        $totalHoteis = $hoteis->count();
        $totalQuartos = $hoteis->sum('quartos_count');
        $totalReservasGestor = \App\Models\Reserva::whereHas('quartos.hotel', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();
    }

    // Últimas reservas do utilizador (se turista) ou últimas reservas dos seus hotéis (se gestor)
    $ultimasReservas = [];
    if ($user->role === 'turista') {
        $ultimasReservas = $user->reservas()->with('hotel')->latest()->take(5)->get();
    } elseif ($user->role === 'gestor') {
        $ultimasReservas = \App\Models\Reserva::whereHas('quartos.hotel', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with('hotel', 'user')->latest()->take(5)->get();
    }

    // Últimas avaliações do utilizador
    $ultimasAvaliacoes = $user->avaliacoes()->with('hotel')->latest()->take(5)->get();

    return view('users.profile', compact(
        'user',
        'totalReservas',
        'totalAvaliacoes',
        'hoteis',
        'totalHoteis',
        'totalQuartos',
        'totalReservasGestor',
        'ultimasReservas',
        'ultimasAvaliacoes'
    ));
}

/**
 * Atualizar perfil do próprio utilizador.
 */
public function updateProfile(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name'     => 'required|string|max:255',
        'contato'  => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8|confirmed',
    ]);

    $data = $request->only(['name', 'contato', 'email']);
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('profile')
        ->with('success', 'Perfil atualizado com sucesso.');
}
    public function index()
    {
            $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Formulário de criação – APENAS ADMIN
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        return view('users.create');
    }

    /**
     * Guardar novo utilizador – APENAS ADMIN
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'contato'  => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:admin,gestor,turista',
        ]);

        User::create([
            'name'     => $request->name,
            'contato'  => $request->contato,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilizador criado.');
    }

    /**
     * Mostrar um utilizador:
     * - Admin pode ver qualquer um.
     * - Gestor só pode ver a si próprio.
     */
    public function show(User $user)
    {
        $this->authorizeView($user);
        return view('users.show', compact('user'));
    }

    /**
     * Formulário de edição:
     * - Admin pode editar qualquer um.
     * - Gestor só pode editar a si próprio.
     */
    public function edit(User $user)
    {
        $this->authorizeEdit($user);
        return view('users.edit', compact('user'));
    }

    /**
     * Atualizar utilizador:
     * - Admin pode alterar todos os campos (incluindo role e password).
     * - Gestor só pode alterar nome, contato, email e password (role fica inalterado).
     */
    public function update(Request $request, User $user)
    {
        $this->authorizeEdit($user);

        $rules = [
            'name'     => 'required|string|max:255',
            'contato'  => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ];

        // Se for admin, pode alterar a role também
        if (auth()->user()->role === 'admin') {
            $rules['role'] = 'required|in:admin,gestor';
        }

        $request->validate($rules);

        $data = $request->only(['name', 'contato', 'email']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Admin pode alterar a role
        if (auth()->user()->role === 'admin' && $request->has('role')) {
            $data['role'] = $request->role;
        }

        $user->update($data);

        $message = 'Perfil atualizado com sucesso.';
        if (auth()->user()->role === 'admin') {
            $message = 'Utilizador atualizado com sucesso.';
        }

        return redirect()->route('users.index')->with('success', $message);
    }

    /**
     * Eliminar utilizador – APENAS ADMIN
     */
    public function destroy(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        // Impedir eliminar gestor que tenha hotéis
        if ($user->role === 'gestor' && $user->hoteis()->exists()) {
            return back()->withErrors(['error' => 'Não é possível eliminar um gestor que possui hotéis.']);
        }
        // Impedir admin de eliminar a própria conta
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Não pode eliminar a sua própria conta.']);
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilizador eliminado.');
    }

    // -------------------- Métodos de autorização privados --------------------

    /**
     * Verifica se o utilizador autenticado pode visualizar o perfil de $user.
     */
    private function authorizeView(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->role === 'admin') {
            return;
        }

        if ($authUser->role === 'gestor' && $authUser->id === $user->id) {
            return;
        }

        abort(403, 'Não autorizado.');
    }

    /**
     * Verifica se o utilizador autenticado pode editar o perfil de $user.
     */
    private function authorizeEdit(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->role === 'admin') {
            return;
        }

        if ($authUser->role === 'gestor' && $authUser->id === $user->id) {
            return;
        }

        abort(403, 'Não autorizado.');
    }
}