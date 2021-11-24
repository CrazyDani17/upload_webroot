@extends('Layouts.main_template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4">Products</h1>
            <p>{{date('l jS \of F Y h:i:s A')}}</p>
            <a href="/product/create" class="btn btn-primary">Add a new product</a>
            <div class="card-body">
                @if ( session('alert') )
                <div class="alert alert-success">{{ session('alert') }}</div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr id="product_{{$product->id}}">
                        <td scope="row">{{$product->id}}</td>
                        <td scope="row">{{$product->name}}</td>
                        <td scope="row">{{$product->description}}</td>
                        <td scope="row">{{$product->category->name}}</td>
                        <td scope="row">{{$product->price}}</td>
                        <td scope="row">
                            <img src="{{ asset('storage/products/' . $product->image) }}" width="100px" height="100px" alt="{{ $product->name }}">
                        </td>
                        <td>
                            <a href="{{route('product.edit',$product)}}" class="btn btn-warning btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm" value="{{$product->id}}" OnClick='delete_product(this);'>Delete</button>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_code')

<script type = "text/javascript">

function delete_product(btn){
    var route = "{{ route('product.delete') }}"
    var token = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN':token},
        type: "DELETE",
        data: {product_id: btn.value},
        dataType: 'json',
        success: function(response) {
                    console.log("Elemento " +  btn.value + " eliminado")
                    $('#product_'+btn.value).fadeOut("slow");
                }
    });
}

</script>

@endsection