@extends('master')

@section('content')

<div class="row">
    <br>
    <div class="col-md-12">
        <h3 class="algn-items-center">Add Products</h3>
        <br>
        @if(count($errors) > 0)

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        @if(\Session::has('success'))

            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>

        @endif
        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            
            {{ csrf_field() }}

            <div class="form-group">

                <input type="text" name="title" class="form-control" placeholder="Product Title">

            </div>

            <div class="form-group">

                <input type="text" name="description" class="form-control" placeholder="Product Description">

            </div>

            <div class="form-group">

                <input type="text" name="color" class="form-control" placeholder="Product Color">

            </div>

            <div class="form-group">

                <input type="text" name="price" class="form-control" placeholder="Product Price">

            </div>

            <div class="form-group">

                <input type="file" name="file" placeholder="Choose file">

            </div>

            <div class="form-group">

                <input type="submit" class="btn btn-primary" placeholder="Enter Last Name">

            </div>

        </form>
    </div>

</div>

@endsection