<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;

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
        $deletedItem->delete();
        // if ($deletedItem) {
        //     return back()->with('success', 'Item has been successfully updated');
        // }

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
    }
}
