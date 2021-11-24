@extends('Layouts.main_template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Add new product</span>
                    <a href="/product" class="btn btn-primary btn-sm">Back to product list</a>
                </div>
                <div class="card-body">   
                  @if ( session('alert') )
                    <div class="alert alert-success">{{ session('alert') }}</div>
                  @endif
                  <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
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

                    @if ($errors->has('category_id'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Category is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif

                    @if ($errors->has('price'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Price is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif

                    @if ($errors->has('image'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Image is required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    @endif
                    <input type="text" name="name" placeHolder="Name" class="form-control mb-2" value="{{ old('name') }}">
                    <input type="text" name="description" placeHolder="Description" class="form-control mb-2" value="{{ old('description') }}">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control mb-2">
                        <option value="">Select</option>
                        @foreach ($categories as $row)
                        <option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="price" placeHolder="Price" class="form-control mb-2" value="{{ old('price') }}">
                    <label for="image">Product Image</label>
                    <input type="file" name="image" class="form-control mb-2" value="{{ old('image') }}">
                    <button class="btn btn-primary btn-block" type="submit">Add</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection