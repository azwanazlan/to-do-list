<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContentController extends Controller
{

    public function addContent(Request $request)
    {
        $this->validate($request, [
            'task' => 'required',
        ]);

        $content = new Content;
        $content->content = $request->task;
        $content->user_id = Auth::id();
        $content->save();

        return response()->json(['message' => 'Item has been successfully added']);
    }

    public function showDeleteContent($id)
    {

        $deleteContent = Content::find($id);
        return view('delete', ['deleteItem' => $deleteContent]);
    }

    // if ($deletedItem) {
    //     return back()->with('success', 'Item has been successfully updated');
    // }



    public function deleteContent($id)
    {
        $deletedItem = Content::find($id);

        if (!$deletedItem) {
            // If the item with the specified ID is not found, return an error response
            return response()->json(['error' => 'Item not found'], 404);
        }

        $deletedItem->delete();

        // Return a success response with a message
        return response()->json(['message' => 'Item has been successfully deleted']);
    }

    public function editContent($id)
    {
        $editItem = Content::find($id);
        return view('edit', ['editItem' => $editItem]);
    }

    public function updateContent(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $content->content = $request->task;
        $content->save();

        if (!$content) {
            // If the item with the specified ID is not found, return an error response
            return response()->json(['error' => 'Item not found'], 404);
        }

        return response()->json(['message' => 'Item has successfully updated']);
    }

    public function markAsCompleted($id)
    {
        $content = Content::findOrFail($id);
        $content->completed = true;
        $content->save();
    }
}
