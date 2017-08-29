@extends('app')

@section('content')
    <div class="container-fluid">
        <h1>Images of {{ $product->name }}</h1>

        <br/>
        <a href="{{ route('products.images.create',['id' => $product->id]) }}" class="btn btn-success">New Image</a>
        <br/>
        <br/>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Extension</th>
                <th>Action</th>
            </tr>

            @foreach($product->images as $image)
            <tr>
                <td>{{ $image->id }}</td>
                <td>
                    <img src="{{ url('https://s3-us-west-2.amazonaws.com/bucket-curso-laravel/'.$image->id.'.'.$image->extension) }}" width="100px" />
                </td>
                <td>{{ $image->extension }}</td>
                <td>
                   <a href="{{ route('products.images.destroy',['id' => $image->id]) }}">
                       Delete
                   </a>
                </td>
            </tr>
            @endforeach
        </table>

        <a href="{{ route('products') }}" class="btn btn-default">Voltar</a>

    </div>


@endsection