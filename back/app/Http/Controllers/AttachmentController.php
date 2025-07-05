<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function index()
    {
        $attachments = Attachment::all();
        return response()->json($attachments);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'protocol' => 'required|string|exists:requests,protocol',
            'URL' => 'required|string',
            'type' => 'required|integer|exists:attachment_type,id',
        ]);

        $attachment = Attachment::create($data);

        return response()->json($attachment, 201);
    }

    public function show($id)
    {
        $attachment = Attachment::findOrFail($id);
        return response()->json($attachment);
    }

    public function update(Request $request, $id)
    {
        $attachment = Attachment::findOrFail($id);

        $data = $request->validate([
            'protocol' => 'sometimes|required|string|exists:requests,protocol',
            'URL' => 'sometimes|required|string',
            'type' => 'sometimes|required|integer|exists:attachment_type,id',
        ]);

        $attachment->update($data);

        return response()->json($attachment);
    }

    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachment->delete();

        return response()->json(null, 204);
    }
}
