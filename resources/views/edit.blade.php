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

                        <form action="{{ url('update/'.$editItem->id)}}" autocomplete="off" id="addItem" name="addItem" method="post">
                            @csrf
                            <label for="task" class="col-control-label mb-2">Task</label>
                            <input type="text" name="content" id="content" class="form-control mb-2" value="{{$editItem->content}}">
                            <span style="color:red">
                                @error('content')
                                    {{ $message }}
                                @enderror
                            </span>
                            <button type="submit" class="btn btn-primary mt-2 ">Update</button>
                            <a href={{route('home')}} class="btn btn-danger mt-2 ">Back</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>





    </div>
@endsection
