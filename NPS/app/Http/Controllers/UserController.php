<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller

{
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function form()
    {
        return view('users.form');
    }

    public function create(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'Numero' => 'required',
            'adresse' => 'required',
            'image' => 'required',
            'cin' => 'required',
            'role' => 'required',
        ]);

        // Création de l'utilisateur dans la base de données
        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'Numero' => $request->Numero,
            'adresse' => $request->adresse,
            'image' => $request->image,
            'cin' => $request->cin,
            'role' => $request->role,
        ]);

        // Redirection vers la liste des utilisateurs
        return redirect('users');
    }


    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('users');
        }
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required',
            'Numero' => 'required',
            'adresse' => 'required',
            'image' => 'required',
            'cin' => 'required',
            'role' => 'required',
        ]);

        $user->update($request->all());

        return redirect('users');
    }
}
