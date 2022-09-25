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


                                        <td class="col-md-8 hide-{{ $loop->index }}">
                                            {{ $content->content }}</td>

                                        <!---- Edit ----->

                                        <td class="col-md-12 showHide-{{ $loop->index }}" style="display: none">
                                            <input type="text" name="contentUpdate" id="content" class="form-control"
                                                value="{{ old('content', $content->content) }}">
                                        </td>

                                        <td>

                                            <div  class="hide-{{ $loop->index }}"
                                                style="display: block">
                                                <a id="editBtn-{{ $loop->index }}" href="{{url('edit/'.$content->id) }}"
                                                    data-id="{{ $loop->index }}" class="btn btn-success">Edit</a>

                                                <a data-id="contentItem-{{ $loop->index }}"
                                                    href="{{ url('delete/' . $content->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </div>

                                            <a class="btn btn-primary showHide-{{ $loop->index }}" type="submit"
                                                style="display: none" href=>Confirm
                                                Edit</a>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" onclick="edit{{$content->id}}">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script>


            function show(id) {
                $.get("{{ url('edit') }}/" + id, {}, function(data, status) {
                    $("#exampleModalLabel").html('Edit')
                    $("#page").html(data);
                    $("#exampleModal").modal('show');
                });
            }

            // function myFunction(e) {

            //     var a = e.getAttribute('data-id');

            //     console.log(a);

            //     [].forEach.call(document.querySelectorAll(".hide-" + a), function(
            //         el) { //loop each class that have .hide-a to hide the class
            //         el.style.display = 'none';
            //     });
            //     [].forEach.call(document.querySelectorAll(".showHide-" + a), function(
            //         el) { //loop each class that have .hide-a to show the class
            //         el.style.display = 'block';
            //     });

            // }
        </script>
    </div>
    </div>
@endsection
