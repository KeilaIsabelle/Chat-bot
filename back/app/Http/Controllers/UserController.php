<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
  public function index()
  {
    try {
      $users = User::all();
      return response()->json($users, 200);
    } catch (\Exception $e) {
      Log::error('Error fetching users: ' . $e->getMessage());
      return response()->json(['message' => 'Error fetching users'], 500);
    }
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

    try {
      $validated['password'] = Hash::make($validated['password']);

      $user = User::create($validated);

      return response()->json([
        'message' => 'User created successfully',
        'user' => [
          'id' => $user->id,
          'name' => $user->name,
          'email' => $user->email,
          'user_type' => $user->user_type
        ]
      ], 201);
    } catch (\Exception $e) {
      Log::error('Error creating user: ' . $e->getMessage());

      return response()->json([
        'message' => 'Internal error while creating user. Please try again later.'
      ], 500);
    }
  }

  public function show($id)
  {
    try {
      $user = User::find($id);

      if (!$user) {
        return response()->json(['message' => 'User not found.'], 404);
      }

      return response()->json($user, 200);
    } catch (\Exception $e) {
      Log::error('Error fetching user: ' . $e->getMessage());
      return response()->json(['message' => 'Error fetching user'], 500);
    }
  }

  public function update(Request $request, $id)
  {
    try {
      $user = User::find($id);

      if (!$user) {
        return response()->json(['message' => 'User not found.'], 404);
      }

      $validated = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'email' => [
          'sometimes',
          'required',
          'email',
          Rule::unique('users')->ignore($user->id),
        ],
        'password' => [
          'sometimes',
          'required',
          'string',
          'confirmed',
          Password::min(8)
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()
        ],
        'cpf' => [
          'sometimes',
          'required',
          'string',
          'size:11',
          Rule::unique('users')->ignore($user->id),
        ],
        'birthday' => 'sometimes|required|date',
        'phone' => 'sometimes|required|string|size:11',
        'user_type' => 'sometimes|required|in:student,staff'
      ]);

      if (isset($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
      }

      $user->update($validated);

      return response()->json($user, 200);
    } catch (\Exception $e) {
      Log::error('Error updating user: ' . $e->getMessage());
      return response()->json(['message' => 'Error updating user'], 500);
    }
  }

  public function destroy($id)
  {
    try {
      $user = User::find($id);

      if (!$user) {
        return response()->json([
          'message' => 'User not found.'
        ], 404);
      }

      $user->delete();

      return response()->noContent(); // 204 No Content
    } catch (\Exception $e) {
      Log::error('Error deleting user: ' . $e->getMessage());
      return response()->json([
        'message' => 'Error deleting user.',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}
