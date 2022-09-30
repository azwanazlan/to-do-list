<div class="form-group">
    <input type="text" name="task" id="editItem" class="form-control mb-2" value="{{ $editItem->content }}">
    <button type="button" onclick="update({{ $editItem->id }})" class="btn btn-primary mt-4">Save
        changes</button>
</div>
