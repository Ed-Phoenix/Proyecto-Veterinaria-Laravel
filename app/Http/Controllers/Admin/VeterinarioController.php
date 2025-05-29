<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class VeterinarioController extends Controller
{
    public function index()
    {
        $veterinarios = Role::findByName('veterinario')->users()->paginate(10);
        return view('admin.veterinarios.index', compact('veterinarios'));
    }

    public function create()
    {
        return view('admin.veterinarios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('veterinario');

        return redirect()->route('admin.veterinarios.index')
                         ->with('success', 'Veterinario creado correctamente.');
    }

    public function edit(User $veterinario)
    {
        return view('admin.veterinarios.edit', compact('veterinario'));
    }

    public function update(Request $request, User $veterinario)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => "required|email|unique:users,email,{$veterinario->id}",
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $veterinario->name  = $data['name'];
        $veterinario->email = $data['email'];
        if (!empty($data['password'])) {
            $veterinario->password = Hash::make($data['password']);
        }
        $veterinario->save();

        return redirect()->route('admin.veterinarios.index')
                         ->with('success', 'Veterinario actualizado correctamente.');
    }

    public function destroy(User $veterinario)
    {
        $veterinario->removeRole('veterinario');
        $veterinario->delete();

        return redirect()->route('admin.veterinarios.index')
                         ->with('success', 'Veterinario eliminado.');
    }
}
