<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RegisterController extends Controller
{
    protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    // Assigner un rôle par défaut ou basé sur un champ du formulaire
    $role = Role::where('name', 'etudiant')->first(); // Change selon le contexte
    $user->roles()->attach($role);

    return $user;
}
    
}
