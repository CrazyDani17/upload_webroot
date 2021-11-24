@extends('Layouts.main_template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Update Category Information: {{$category->name}}</span>
                    <a href="/categories" class="btn btn-primary btn-sm">Back to category list</a>
                </div>
                <div class="card-body">   
                  @if ( session('alert'))
                    <div class="alert alert-success">{{ session('alert') }}</div>
                  @endif
                  <form action="{{route('category.update',$category->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        @error('name')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Name is required
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        @enderror @if ($errors->has('description'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Description is required
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        @endif
                        <input type="text" name="name" placeHolder="Name" class="form-control mb-2" value="{{$category->name}}">
                        <input type="text" name="description" placeHolder="Description" class="form-control mb-2" value="{{$category->description}}">
                        <button class="btn btn-primary btn-block" type="submit">Edit</button>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection