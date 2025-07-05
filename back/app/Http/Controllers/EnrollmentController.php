<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::all();
        return response()->json($enrollments);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'enrollment' => 'required|string',
            'timetable' => 'required|string',
            'modality' => 'required|string',
            'status' => 'required|in:active,locked,finished',
            'user_id' => 'required|exists:users,id',
        ]);

        $enrollment = Enrollment::create($data);

        return response()->json($enrollment, 201);
    }

    public function show($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return response()->json($enrollment);
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::findOrFail($id);

        $data = $request->validate([
            'enrollment' => 'sometimes|required|string',
            'timetable' => 'sometimes|required|string',
            'modality' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:active,locked,finished',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $enrollment->update($data);

        return response()->json($enrollment);
    }

    public function destroy($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return response()->json(null, 204);
    }
}
