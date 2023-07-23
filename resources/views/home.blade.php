@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="ajax-alert-container"></div>
                <!--- Add New Item Card --->
                <div class="card">
                    <div class="card-header">ADD NEW ITEM</div>
                    <div class="form-group m-4">


                        <label for="task" class="col-control-label mb-2">Task</label>
                        <div class="input-group">
                            <input type="text" autocomplete="off" name="task" id="task"
                                class="form-control mb-2">
                            <button onclick="create()" class="btn btn-primary btn-sm px-4 mb-2 "><i
                                    class="fa fa-plus"></i></button>
                        </div>
                        <div>
                            <span style="color:red">
                                @error('task')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

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

            function create() {
                var name = $("#task").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    url: "{{ url('add') }}",
                    data: "task=" + name,
                    success: function(data) {
                        $("#exampleModal").modal('hide');
                        read();

                        $(".ajax-alert-container").prepend('<div class="alert alert-success">' + data.message +
                            '</div>');
                        // Hide the alert after 5 seconds with fade effect
                        setTimeout(function() {
                            $(".ajax-alert-container .alert").addClass("hide");
                            setTimeout(function() {
                                $(".ajax-alert-container .alert").remove();
                            }, 500);
                        }, 5000);

                    }
                });
            }

            function showDelete(id) {
                $.get("{{ url('showDelete') }}/" + id, {}, function(data, status) {
                    $(".modal-title").html('Delete');
                    $("#page").html(data);
                    $("#exampleModal").modal('show');

                    if (data.message) {
                        $(".ajax-alert-container").prepend('<div class="alert alert-success">' + data.message +
                            '</div>');
                        // Hide the alert after 5 seconds with fade effect
                        setTimeout(function() {
                            $(".ajax-alert-container .alert").addClass("hide");
                            setTimeout(function() {
                                $(".ajax-alert-container .alert").remove();
                            }, 500);
                        }, 5000);
                    }
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
                        if (data.message) {
                            $(".ajax-alert-container").prepend('<div class="alert alert-success">' + data.message +
                                '</div>');
                            // Hide the alert after 5 seconds with fade effect
                            setTimeout(function() {
                                $(".ajax-alert-container .alert").addClass("hide");
                                setTimeout(function() {
                                    $(".ajax-alert-container .alert").remove();
                                }, 500);
                            }, 5000);
                        }
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
                    // data: id,
                    success: function(data) {
                        read();
                        if (data.message) {
                            $(".ajax-alert-container").prepend('<div class="alert alert-success">' + data.message +
                                '</div>');
                            // Hide the alert after 5 seconds with fade effect
                            setTimeout(function() {
                                $(".ajax-alert-container .alert").addClass("hide");
                                setTimeout(function() {
                                    $(".ajax-alert-container .alert").remove();
                                }, 500);
                            }, 5000);
                        }

                    },

                    error: function(xhr, status, error) {
                    console.log("AJAX Error:", error);
        }
                });
            }

            function markAsCompleted(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'get',
                    url: "{{ url('markascompleted') }}/" + id,
                    success: function(data) {
                        read();
                    }
                });
            }
        </script>
    </div>
    </div>
@endsection
