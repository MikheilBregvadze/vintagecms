@extends('master')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <br>
            <h3 class="text-center">Product Data</h3>
            <br>

            @if($message = Session::get('success'))

            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>

            @endif

            <div class="text-right">
                <a href="{{ route('product.create') }}" class="btn btn-primary">Add</a>
            </div>
            <br>
            <div class="table-wrapper-scroll-y">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Color</th>
                            <th scope="col">Price</th>
                            <th scope="col">File</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $row)
                        <tr>
                            <td>{{ $row['title'] }}</td>
                            <td>{{ $row['description'] }}</td>
                            <td>{{ $row['color'] }}</td>
                            <td>{{ $row['price'] }}</td>
                            <td>{{ $row['file'] }}</td>
                            <td><a href="{{ action('ProductController@edit', $row['id']) }}" class="btn btn-warning">Edit</a></td>
                            <td>
                                <form method="POST" class="delete_form" action="{{ action('ProductController@destroy', $row['id']) }}">
                                    
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- $ composer require intervention/image --}}
    <script>
    $(document).ready(function() {
        $('.delete_form').on('submit', function() {
            if(confirm("Are you sure you want to delete it?")) {
                return true
            }else {
                return false
            }
        });
    });

    </script>

@endsection


