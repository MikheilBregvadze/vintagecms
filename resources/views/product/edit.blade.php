@extends('master')

@section('content')

<div class="row">
    <div class="col-md-12">

        <br>
        <h3 class="text-center">Edit Record of Product</h3>
        <br>

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <img  src="/img/product/{{ $product->id .'/'. $product->file }}" alt="image" width="600px">

        <br>
        <br>

        <form method="POST" action="{{ action('ProductController@update', $id) }}" enctype="multipart/form-data">
            
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PATCH">

            <div class="form-group">

                <input type="text" name="title" class="form-control" value="{{ $product->title }}" placeholder="Enter Name">

            </div>
            <div class="form-group">

                <input type="text" name="description" class="form-control" value="{{ $product->description }}" placeholder="Enter Last Name">

            </div>

            <div class="form-group">

                <input type="text" name="color" class="form-control" value="{{ $product->color }}" placeholder="Enter Last Name">

            </div>

            <div class="form-group">

                <input type="text" name="price" class="form-control" value="{{ $product->price }}" placeholder="Enter Last Name">

            </div>

            <div class="form-group">

                <input type="file" name="file" placeholder="Choose file">

            </div>

             <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Edit">
            </div>
        
        </form>

    </div>
</div>

@endsection