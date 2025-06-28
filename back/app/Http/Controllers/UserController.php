<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
  public function index()
  {
    return User::all();
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => [
        'required',
        'string',
        'confirmed',
        Password::min(8)
          ->mixedCase()
          ->numbers()
          ->symbols()
          ->uncompromised()
      ],
      'cpf' => 'required|string|size:11|unique:users,cpf',
      'birthday' => 'required|date',
      'phone' => 'required|string|size:11',
      'user_type' => 'required|in:student,staff'
    ]);

    $validated['password'] = Hash::make($validated['password']);

    $user = User::create($validated);

    return response()->json([
      'message' => 'Usuário criado com sucesso',
      'user' => [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'user_type' => $user->type_user
      ]
    ], 201);
  }

  public function show(User $user)
  {
    return $user;
  }

  public function update(Request $request, User $user)
  {
    $user->update($request->all());
    return $user;
  }

  public function destroy(User $user)
  {
    $user->delete();
    return response()->noContent();
  }
}
