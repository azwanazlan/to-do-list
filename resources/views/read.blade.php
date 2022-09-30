
    <div class="card-header">TO DO LIST</div>
    <div class="card-body">
        <table class="table mb-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Todo item</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($contents as $content)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td class="col-md-8">
                            {{ $content->content }}</td>
                        <td>
                            <button onclick="edit({{ $content->id }})" class="btn btn-success">Edit</button>
                            <button onclick="destroy({{ $content->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


