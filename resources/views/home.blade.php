@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success')}}
            </div>

            @endif

            <div class="card">
                <div class="card-header">ADD NEW ITEM</div>



                <div class="form-group m-4">
                <form action="{{route('add')}}" autocomplete="off" id="addItem" name="addItem" method="post">
                        @csrf
                    <label for="task" class="col-control-label mb-2">Task</label>
                    <input type="text" name="content" id="content" class="form-control mb-2">
                    <span style="color:red">@error('content'){{$message}} @enderror</span>
                    <button type="submit" class="btn btn-primary mt-2 ">+ Add</button>
                </form>
                </div>



                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">TO DO LIST</div>


                    <div class="card-body">
                        <table class="table mb-4">
              <thead>
                <tr>
                  <th scope="col">Todo item</th>

                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($contents as $content)
                <tr>

                    <td>{{$content->content}}</td>
                    <td>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="submit" class="btn btn-success ms-1">Done</button>
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
