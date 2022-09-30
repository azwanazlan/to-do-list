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
                            <input type="text" name="task" id="content" class="form-control mb-2">
                            <div>
                                <span style="color:red">
                                    @error('task')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2 ">+ Add</button>

                        </form>

                    </div>
                </div>
                <!--- Add New Item Card Ends Here --->
            </div>
        </div>

        <!--- To Do List Card --->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">

                <div class="card">
                    <div id="read"></div>
                </div>


            </div>
        </div>

        <!--- To Do List Card Ends Here --->


        <!--- Modal Starts Here --->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="page"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--- Modal Ends Here --->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>



        <script>
            $(document).ready(function() {
                read();
            });

            function showDelete(id) {
                $.get("{{ url('showDelete') }}/" + id, {}, function(data, status) {
                    $(".modal-title").html('Delete');
                    $("#page").html(data);
                    $("#exampleModal").modal('show');
                });
            }

            function read() {
                $.get("{{ url('read') }}", {}, function(data, status) {
                    $("#read").html(data);
                });
            }

            function edit(id) {
                $.get("{{ url('edit') }}/" + id, {}, function(data, status) {
                    $(".modal-title").html('Edit');
                    $("#page").html(data);
                    $("#exampleModal").modal('show');

                });
            }



            function update(id) {
                var name = $("#editItem").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'put',
                    url: "{{ url('update') }}/" + id,
                    data: "task=" + name,
                    success: function(data) {
                        $("#exampleModal").modal('hide');
                        read();
                    }
                });
            }

            function destroy(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'get',
                    url: "{{ url('delete') }}/" + id,
                    data: id,
                    success: function(data) {
                        $("#exampleModal").modal('hide');
                        read();
                    }
                });
            }




        </script>
    </div>
    </div>
@endsection
