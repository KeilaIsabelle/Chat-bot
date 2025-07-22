<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
  public function index()
  {
    try {
      $requests = ModelsRequest::all();
      return $requests;
    } catch (\Exception $e) {
      Log::error('Error fetching requests: ' . $e->getMessage());
      return response()->json(['message' => 'Error fetching requests'], 500);
    }
  }

  public function show($id)
  {
    try {
      $request = ModelsRequest::find($id);

      if (!$request) return response()->json(['messege' => 'Request not found.'], 404);
    } catch (\Exception $e) {
      Log::error('Error fetching request: ' . $e->getMessage());
      return response()->json(['message' => 'Error fetching request'], 500);
    }
  }

  public function store(Request $Request)
  {
    $validated = $Request->validate([
      'status',
      'enrollment' => 'required|string|max:255',
      'observations' => 'string|max:1023',
      'protocol' => 'required|string|max:255',
      'req_type' => 'required|string'
    ]);

    try {
      $validated['status'] = 'pedant';

      $request = ModelsRequest::create($validated);

      return response()->json([
        'messege' => 'Request created successfully',
        'request' => [
          'id' => $request->id,
          'status' => $request->status,
          'enrollment' => $request->enrollment,
          'protocol' => $request->protocol,
          'req_type' => $request->req_type,
          'observations' => $request->observations
        ]
      ], 201);
    } catch (\Exception $e) {
      Log::error('Error creating request: ' . $e->getMessage());

      return response()->json([
        'message' => 'Internal error while creating request. Please try again later.'
      ], 500);
    }
  }

  public function destroy($id)
  {
    try {
      $request = ModelsRequest::find($id);

      if (!$request) {
        return response()->json([
          'message' => 'Request not found.'
        ], 404);
      }

      $request->delete();

      return response()->noContent();
    } catch (\Exception $e) {
      Log::error('Error deleting request: ' . $e->getMessage());
      return response()->json([
        'message' => 'Error deleting request.',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}
