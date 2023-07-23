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
                        <div class="btn-group">
                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        onclick="markAsCompleted({{ $content->id }})"href="#"><i
                                            class="fa fa-check p-2"></i>Mark as Completed</a></li>
                                {{-- <li><a class="dropdown-item" href="{{route('mark', $content->id) }}"href="#">Mark as Completed</a></li> --}}
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" onclick="destroy({{ $content->id }})" href="#"><i
                                            class="fa fa-trash p-2"></i>Delete</a></li>
                            </ul>
                        </div>
                        {{-- <button onclick="destroy({{ $content->id }})" class="btn btn-danger">Delete</button> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
