@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <!--- Add New Item Card --->
                <div class="card">
                    <div class="card-header">ADD NEW ITEM</div>
                    <div class="form-group m-4">

                        <form action="{{ route('add') }}" autocomplete="off" id="addItem" name="addItem" method="post">
                            @csrf
                            <label for="task" class="col-control-label mb-2">Task</label>
                            <input type="text" name="content" id="content" class="form-control mb-2">
                            <span style="color:red">
                                @error('content')
                                    {{ $message }}
                                @enderror
                            </span>
                            <button type="submit" class="btn btn-primary mt-2 ">+ Add</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!--- To Do List Card --->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">TO DO LIST (Click an item to edit)</div>


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
                                            <a href="{{ url('edit/' . $content->id) }}" class="btn btn-success">Edit</a>
                                            <a href="{{ url('delete/' . $content->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>



                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
