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
            'content' => 'required',
        ]);

        $content = new Content;
        $content->content = $request->content;
        $content->user_id = Auth::id();
        $item = $content->save();

        if ($item) {
            return back()->with('success', 'Item has been successfully added');
        }
    }

    public function deleteContent($id)
    {

        $deletedItem = Content::where('id', $id)->delete();

        if ($deletedItem) {
            return back()->with('success', 'Item has been successfully updated');
        }
    }

    public function editContent($id)
    {
        $editItem = Content::find($id);;
        return view('edit', ['editItem' => $editItem]);
    }

    public function updateContent(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $content->content = $request->content;
        $updatedItem = $content->save();

        if ($updatedItem) {
            return back()->with('success', 'Item has been successfully updated');
        }
    }
}
