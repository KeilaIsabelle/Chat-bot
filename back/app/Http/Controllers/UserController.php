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
    // Validação dos dados
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => [
            'required',
            'string',
            'confirmed',
            Password::min(8)
                ->mixedCase()    // Pelo menos 1 letra maiúscula e 1 minúscula
                ->numbers()      // Pelo menos 1 número
                ->symbols()     // Pelo menos 1 símbolo
                ->uncompromised() // Verifica se a senha não foi vazada em breaches
        ],
        'cpf' => 'required|string|size:11|unique:users,cpf',
        'birthday' => 'required|date',
        'phone' => 'required|string|size:11',
        'type_user' => 'required|in:student,staff' // Valores permitidos no enum
    ]);

    // Criptografa a senha antes de salvar
    $validated['password'] = Hash::make($validated['password']);

    // Cria o usuário no banco de dados
    $user = User::create($validated);

    // Retorna resposta formatada (opcional)
    return response()->json([
        'message' => 'Usuário criado com sucesso',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'type_user' => $user->type_user
            // Não retornamos dados sensíveis como password/CPF
        ]
    ], 201); // HTTP 201 - Created
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
