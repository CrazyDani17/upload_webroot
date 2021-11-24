@extends('Layouts.main_template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4">Categories</h1>
            <p>{{date('l jS \of F Y h:i:s A')}}</p>
            <a href="/categories/create" class="btn btn-primary">Add a new category</a>
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
                        <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr id="category_{{$category->id}}">
                        <td scope="row">{{$category->id}}</td>
                        <td scope="row">{{$category->name}}</td>
                        <td scope="row">{{$category->description}}</td>
                        <td>
                            <a href="{{route('category.edit',$category)}}" class="btn btn-warning btn-sm">Edit</a>
                            <button type="submit" class="btn btn-danger btn-sm" value="{{$category->id}}" OnClick='delete_category(this);'>Delete</button>
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

function delete_category(btn){
    var route = "{{ route('category.ajax_delete') }}"
    var token = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN':token},
        type: "DELETE",
        data: {category_id: btn.value},
        dataType: 'json',
        success: function(response) {
                    console.log("Elemento " +  btn.value + " eliminado")
                    $('#category_'+btn.value).fadeOut("slow");
                }
    });
}

</script>

@endsection