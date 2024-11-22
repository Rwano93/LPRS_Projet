<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = User::query()->with('role');

    if ($request->has('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('id', 'LIKE', "%{$searchTerm}%")
              ->orWhere('nom', 'LIKE', "%{$searchTerm}%")
              ->orWhere('prenom', 'LIKE', "%{$searchTerm}%")
              ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        });
    }

    if ($request->has('role') && $request->role != '') {
        $query->where('ref_role', $request->role);
    }

    $users = $query->paginate(10);
    $roles = Role::all();

    return view('users.index', compact('users', 'roles'));
}

public function create()
{
    $roles = Role::all();
    return view('users.create', compact('roles'));
}

public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'ref_role' => 'required|exists:roles,id',
    ]);

    User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'ref_role' => $request->ref_role,
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}


    public function show(User $user)
    {
        $user->load('role');  
        $roles = Role::all(); 
        return view('users.show', compact('user', 'roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'ref_role' => ['required', 'integer', 'exists:roles,id'],
        ]);

        $user->update($validated);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}